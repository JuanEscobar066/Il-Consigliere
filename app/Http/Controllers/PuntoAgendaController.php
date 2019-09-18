<?php

namespace App\Http\Controllers;

use App\Model\PuntoAgenda;
use App\Model\AdjuntosPunto;
use Illuminate\Http\Request;
use App\Model\Sesion;
use App\Model\Miembro;
use Illuminate\Support\Facades\Redirect;

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

    public function generateDocx()

    {

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();


        $description = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod

                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,

                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo

                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse

                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non

                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
        
        $data = file_get_contents(resource_path('views/puntoAgenda/acta.blade.php'));
        $dom = new \DOMDocument();
        $dom->loadHTML($data);
        $description = $dom->getElementById('acta')->nodeValue;
        $section->addText($description);
        /*\PhpOffice\PhpWord\Shared\Html::addHtml($section, $description);
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment;filename="test.docx"');*/
    

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

        try {

            $objWriter->save(storage_path('Acta Consejo.docx'));

        } catch (Exception $e) {

        }


        return response()->download(storage_path('helloWorld.docx'));

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
     * @param  \App\Model\PuntoAgenda  $puntoAgenda
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     	PuntoAgenda::destroy($id);       
    	return redirect('puntoAgenda')->with('message', 'Punto eliminado exitosamente');
    }
}
