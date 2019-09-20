<?php

namespace App\Http\Controllers;

use App\Model\PuntoAgenda;
use App\Model\AdjuntosPunto;
use Illuminate\Http\Request;
use App\Model\Sesion;
use App\Model\Miembro;
use Illuminate\Support\Facades\Redirect;
use \Pandoc\Pandoc;

// Permite usar autentificación.
use Auth;

class PuntoAgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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

    public function crearActa(){
        $pdf = \PDF::loadView('puntoAgenda.acta');
        return $pdf->stream('acta.pdf');
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
     * @return \Illuminate\Http\Response
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
     * @param  \App\Model\PuntoAgenda  $puntoAgenda
     * @return \Illuminate\Http\Response
     */
    public function show(PuntoAgenda $puntoAgenda)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\PuntoAgenda  $puntoAgenda
     * @return \Illuminate\Http\Response
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\PuntoAgenda  $puntoAgenda
     * @return \Illuminate\Http\Response
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
     * @param  \App\Model\PuntoAgenda  $puntoAgenda
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     	PuntoAgenda::destroy($id);
    	return redirect('puntoAgenda')->with('message', 'Punto eliminado exitosamente');
    }
}
