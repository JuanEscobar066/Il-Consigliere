<?php

namespace App\Http\Controllers;

use App\Model\PuntoAgenda;
use App\Model\AdjuntosPunto;
use Illuminate\Http\Request;
use App\Model\Sesion;
use App\Model\Miembro;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

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
    public function update(Request $request,$id)
    {
        if($this->acceso($request))
        {
        	$punto = PuntoAgenda::find($id);
        	$punto->titulo = $request->titulo_punto;
        	$punto->considerando = $request->considerando_punto;
        	$punto->acuerda = $request->se_acuerda_punto;
        	$punto->miembro = 25;


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
