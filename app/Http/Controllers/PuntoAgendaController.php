<?php

namespace App\Http\Controllers;

use App\Model\PuntoAgenda;
use App\Model\AdjuntosPunto;
use Illuminate\Http\Request;
use App\Model\Sesion;
use App\Model\Miembro;
use Illuminate\Http\Response;
use App\Model\Ausencia;
use Illuminate\Support\Facades\Redirect;

// Permite usar autentificación.
use Auth;

class PuntoAgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $puntos = PuntoAgenda::all();
        foreach ($puntos as $p){
          $m = Miembro::find($p->miembro);
          $nombre = "$m->nombremiembro $m->apellido1miembro";
          $p->miembro = $nombre;
        }
        return view('puntoAgenda.index',['puntosPropuestos' => $puntos]);
    }

    private function acceso(Request $request)
    {
        if (($request->session()->has('id')) and ((int)$request->session()->get('id')!=0))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function solicitudPuntos(Request $request, $idEvento){
        $datos = $this->obtenerDatos($request, $idEvento);
        $puntosPropuestos = $datos[0];
        $nombre = $datos[1];
        $sesion = $datos[2];

        $pdf = \PDF::loadView('puntoAgenda.solicitud_puntos', ['puntosPropuestos' => $puntosPropuestos, 'miembro' => $nombre,'sesion' => $sesion]);
        return $pdf->stream('Solicitud de puntos ' . $sesion->fecha . '.pdf');
    }

    // Esta función permite firmar la solicitud de puntos.
    public function firmaSolicitudPuntos(Request $request, $idEvento){

        // Se hace un llamado a la información de la solicitud de puntos.
        $datos = $this->obtenerDatos($request, $idEvento);

        // Aquí se encuentran todos los datos.
        $puntosPropuestos = $datos[0];
        $nombre = $datos[1];
        $sesion = $datos[2];

        // Se forma el PDF como tal.
        $pdf = \PDF::loadView('puntoAgenda.solicitud_puntos', ['puntosPropuestos' => $puntosPropuestos, 'miembro' => $nombre,'sesion' => $sesion]);

        // Aquí se obtiene el contenido del PDF y luego se convierte a base64, esto para efectuar el proceso de firma digital
        // para el documento en cuestión.
        $contenidoPDF = $pdf->download()->getOriginalContent();
        $documentoEnBase64 = chunk_split(base64_encode($contenidoPDF));

        // Seteamos la cookie con el archivo.
        $_COOKIE["archivoBase64"] = $documentoEnBase64;

        // Ahora, se hace un llamado a las funciones de firmado en javascript.
        echo
        '<script type="text/javascript">',
        'jsfunction();',
        '</script>'
        ;

        //return Redirect::back()->with(['puntosPDF' => $pdf]);
    }

    public function crearDocSolicitudPuntos(Request $request, $idEvento){
        $datos = $this->obtenerDatos($request, $idEvento);
        $puntosPropuestos = $datos[0];
        $nombre = $datos[1];
        $sesion = $datos[2];

        return view('puntoAgenda.solicitud_puntos', ['puntosPropuestos' => $puntosPropuestos, 'miembro' => $nombre,'sesion' => $sesion]);
    }

    public function obtenerDatos(Request $request, $idEvento){
        $idMiembro = (int)$request->session()->get('id'); // Obtiene el id del usuario que está logueado en el momento.
        $sesion = new Sesion();
        $sesion = $sesion->buscar($idEvento);
        $fecha = $sesion->fecha;
        $sesion->fecha = date("d-m-Y", strtotime($fecha));

        if($sesion->tipo_sesion == 1){
            $sesion->tipo_sesion = "ordinaria";
        }
        else{
            $sesion->tipo_sesion = "extraordinaria";
        }

        $puntos = new PuntoAgenda();
        $puntosPropuestos = $puntos->obtenerPuntosPorUsuario($idMiembro, $idEvento);
        $miembro = Miembro::find($idMiembro);
        $nombre = "$miembro->nombremiembro $miembro->apellido1miembro $miembro->apellido2miembro";

        foreach ($puntosPropuestos as $p){
            $p->miembro = $nombre;
        }

        $datos = array();
        array_push($datos, $puntosPropuestos, $nombre, $sesion);

        return $datos;
    }

    public function indexAdmin(Request $request)
    {
    //    $pun = new PuntoAgenda();
    //    $puntos = $pun->obtenerPuntosTodos();
        //
        if($this->acceso($request))
        {
        	$puntos = PuntoAgenda::all();
        	return view('puntoAgenda.indexAdmin',['puntosPropuestos' => $puntos]);
        }
        else
        {
            return redirect::to('/login');
        }
    }

    public function crearActa($idEvento){
        $datos = $this->obtenerDatosActa($idEvento);
        $puntosPropuestos = $datos[0];
        $sesion = $datos[1];
        $miembros = $datos[2];
        $estudiantes = $datos[3];
        $ausentes = $datos[4];
        $presidentes = $datos[5];
        $secretarios = $datos[6];

        $pdf = \PDF::loadView('puntoAgenda.acta', ['puntosPropuestos' => $puntosPropuestos, 'sesion' => $sesion,
                              'miembrosPresentes' =>  $miembros, 'estudiantesPresentes' =>  $estudiantes,
                              'miembrosAusentes' =>  $ausentes, 'presidentes' => $presidentes, 'secretarios' => $secretarios]);
        return $pdf->stream('Acta de Consejo.pdf');
    }

    public function crearDocumentoActa($idEvento){
        $datos = $this->obtenerDatosActa($idEvento);
        $puntosPropuestos = $datos[0];
        $sesion = $datos[1];
        $miembros = $datos[2];
        $estudiantes = $datos[3];
        $ausentes = $datos[4];
        $presidentes = $datos[5];
        $secretarios = $datos[6];

        return view('puntoAgenda.acta', ['puntosPropuestos' => $puntosPropuestos, 'sesion' => $sesion,
                              'miembrosPresentes' =>  $miembros, 'estudiantesPresentes' =>  $estudiantes,
                              'miembrosAusentes' =>  $ausentes, 'presidentes' => $presidentes, 'secretarios' => $secretarios]);
    }

    public function obtenerDatosActa($idEvento){
        $sesion = new Sesion();
        $sesion = $sesion->buscar($idEvento);
        $fecha = $sesion->fecha;
        $ausencia = new Ausencia();
        $miembrosAusentes = $ausencia->buscarAusenciaPorRango($fecha, "Miembro");
        $sesion->fecha = date("d-m-Y", strtotime($fecha));

        if($sesion->tipo_sesion == 1){
            $sesion->tipo_sesion = "ordinaria";
        }
        else{
            $sesion->tipo_sesion = "extraordinaria";
        }
        $puntos = new PuntoAgenda();
        $puntosPropuestos = $puntos->obtenerPuntosTodos();
        $presidente = $sesion->obtenerMiembrosPorRol($idEvento, "Presidente");
        $miembrosPresentes = $sesion->obtenerMiembrosPorRol($idEvento, "Miembro");
        $estudiantesPresentes = $sesion->obtenerMiembrosPorRol($idEvento, "Estudiante");
        $secretario = $sesion->obtenerMiembrosPorRol($idEvento, "Administrativo");
        $presidentes = array();
        $miembros = array();
        $estudiantes = array();
        $secretarios = array();
        $ausentes = array();

        foreach ($presidente as $p){
            array_push($presidentes, $p->nombremiembro . ' ' . $p->apellido1miembro . ' ' . $p->apellido2miembro);
        }
        foreach ($miembrosPresentes as $m){
            array_push($miembros, $m->nombremiembro . ' ' . $m->apellido1miembro . ' ' . $m->apellido2miembro);
        }
        foreach ($estudiantesPresentes as $e){
            array_push($estudiantes, $e->nombremiembro . ' ' . $e->apellido1miembro . ' ' . $e->apellido2miembro);
        }
        foreach ($secretario as $s){
            array_push($secretarios, $s->nombremiembro . ' ' . $s->apellido1miembro . ' ' . $s->apellido2miembro);
        }
        foreach ($miembrosAusentes as $m){
            $nombreCompleto = $m->nombremiembro . ' ' . $m->apellido1miembro . ' ' . $m->apellido2miembro;
            array_push($ausentes, $nombreCompleto);
            $miembros = array_diff($miembros, array($nombreCompleto));
        }

        $datos = array();

        array_push($datos, $puntosPropuestos, $sesion, $miembros, $estudiantes, $ausentes, $presidentes, $secretarios);

        return $datos;
    }

    public function accept($id){
    	$punto = PuntoAgenda::find($id);
    	$punto->estado = true;
    	$punto->save();
    	return redirect('indexAdmin');
    }

    public function deny($id){
    	$punto = PuntoAgenda::find($id);
    	$punto->estado = false;
    	$punto->save();
    	return redirect('indexAdmin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $sesion = new Sesion;
        $listaAgendas = $sesion->mostrar();
       return view('puntoAgenda.create',['agendas'=>$listaAgendas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        if($this->acceso($request))
        {
    	    $punto = new PuntoAgenda;
    	    $punto->titulo = $request->titulo_punto;
    	    $punto->considerando = $request->considerando_punto;
    	    $punto->acuerda = $request->se_acuerda_punto;

            //$user = Auth::user();
    	    $punto->miembro = (int)$request->session()->get('id');//Para obtener el id de la persona que está loggeada
            $punto->punto_para_agenda = (int)$request->post('agenda');
    	    $punto->save();
    	    $key = $punto->getKey();

    	    if(!empty($request->file('files'))){
    		    foreach($request->file('files') as $file){
    			    $name = $file->getClientOriginalName();
    			    if($file->move("{$key}/", $name)){
    				    $adjunto = new AdjuntosPunto;
    				    $adjunto->nombre = $name;
    				    $adjunto->id_punto = $key;
    				    $adjunto->ruta = "public/{$key}/{$name}";
    				    $adjunto->save();
    			    }
    		    }
    	    }

    	    return redirect('puntoAgenda')->with('success', 'Punto solicitado exitosamente');
        }
        else
        {
            return redirect::to('/login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param PuntoAgenda $puntoAgenda
     * @return Response
     */
    public function show(PuntoAgenda $puntoAgenda)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PuntoAgenda $puntoAgenda
     * @return Response
     */
    public function edit(PuntoAgenda $puntoAgenda)
    {
    }

    public function download($ruta)
    {
	    $r = substr($ruta,7);
	    return response()->download($r);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param PuntoAgenda $puntoAgenda
     * @return Response
     */

    // Permite hacer un update en la tabla punto agenda.
    // Esta le hace "requests" al HTML de la vista para poder obtener los datos que necesita.
    public function update(Request $request, $id)
    {
        if($this->acceso($request))
        {
            // Esta sección le solicita al HTML todos esos valores mediante las etiquetas.
            // En cada input:  <input type="text" name="NOMBRE_QUE_SE_QUIERE".
        	$punto = PuntoAgenda::find($id);
        	$punto->titulo = $request->titulo_punto;
        	$punto->considerando = $request->considerando_punto;
        	$punto->acuerda = $request->se_acuerda_punto;

            // Se obtiene su ID.
        	$punto->miembro = (int)$request->session()->get('id');

        	// Se guarda la información.
        	$punto->save();

        	$key = $punto->getKey();

        	if(!empty($request->file('files'))){
        		foreach($request->file('files') as $file){
        			$name = $file->getClientOriginalName();
        			if($file->move("{$key}/", $name)){
        				$adjunto = new AdjuntosPunto;
        				$adjunto->nombre = $name;
        				$adjunto->id_punto = $key;
        				$adjunto->ruta = "public/{$key}/{$name}";
        				$adjunto->save();
        			}

        		}
        	}

        	return redirect('puntoAgenda')->with('success', 'Punto solicitado exitosamente');
        }
        else
        {
            return redirect::to('/login');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PuntoAgenda $puntoAgenda
     * @return Response
     */
    public function destroy($id)
    {
     	PuntoAgenda::destroy($id);
    	return redirect('puntoAgenda')->with('message', 'Punto eliminado exitosamente');
    }
}
