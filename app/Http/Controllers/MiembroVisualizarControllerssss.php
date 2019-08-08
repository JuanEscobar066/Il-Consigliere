<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Model\Miembro;
use App\Model\Roles;
//use App\Model\Tipo_sesion;
use App\Http\Requests\MiembroFormRequest;


class MiembroController extends Controller
{
    public function __construct(){

    }

    public function index(Request $request){
        if ($request){
            $roles = new Roles();
            $listaRoles = $roles->mostrar();
            return view ('members.annadirMiembro',['roles'=>$listaRoles]);
        }
        //return view ('members.annadirMiembro');
    }
    
    public function create(){
        /*$tipo_sesion = new Tipo_sesion();
        $tipo_sesion = $tipo_sesion->mostrar();
        return view('sesion.create', ['tipo_sesion'=>$tipo_sesion]);*/
    }
    
    public function store(Request $request){
        /*$sesion = new Sesion;        
        $sesion->insertar($request->get('tipo_sesion'), $request->get('fecha'),$request->get('hora'),$request->get('lugar'));
		return Redirect::to('/sesion');*/
    }
    
    public function show($id){
    	
    }
    
    public function edit($id){
        /*$sesion = new Sesion;
        $sesion = $sesion->buscar($id);
        $tipo_sesion = new Tipo_sesion();
        $tipo_sesion = $tipo_sesion->mostrar();
    	return view("sesion.edit",["sesion"=>$sesion, 'tipo_sesion'=>$tipo_sesion]);*/
    }

    public function update(Request $request, $id){
        /*$sesion = new Sesion;
        $sesion->actualizar($id, $request->get('tipo_sesion'), $request->get('fecha'),$request->get('hora'),$request->get('lugar'));*/
		//return Redirect::to('/sesion');
    }
    
     public function destroy($id){
    	/*$sesion = Sesion::findOrFail($id);
        $sesion->delete();
        //Mejorar redirect
        $sesion = new Sesion();
        $listaSesiones= $sesion->mostrar();
        return view ('sesion.index',['sesiones'=>$listaSesiones]);*/
    }
}
