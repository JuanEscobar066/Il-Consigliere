<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Model\Ausencia;
use App\Model\Roles;
use Illuminate\Support\Facades\Redirect;
//use App\Model\Tipo_sesion;
use App\Http\Requests\MiembroFormRequest;

use App\Model\Token;
use App\Mail\sendMail;
use Mail;

class AusenciaController extends Controller
{

    public function __construct(){
        return view ('ausencias.index');
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

    public function administrarAusencias(Request $request)
    {
        if($this->acceso($request))
        {
            $ausencia = new Ausencia();
            //$idMiembro = (int)$request->session()->get('id');
            $listaausencias = $ausencia->mostrar();
            return view ('ausencias.administrar',['ausencias'=>$listaausencias]);
        }
        else
        {
            return redirect::to('/login');
        }
    }

    public function index(Request $request){
        if($this->acceso($request))
        {
            if ($request){
                $ausencia = new Ausencia();
                $idMiembro = (int)$request->session()->get('id');
                $listaausencias = $ausencia->buscarTodas($idMiembro);
                return view ('ausencias.index',['ausencias'=>$listaausencias]);
            }
            return view ('ausencias.index');
        }
        else
        {
            return redirect::to('/login');
        }
    }

    public function store(Request $request){
        if($this->acceso($request))
        {
            $idMiembro = (int)$request->session()->get('id');
            $motivo = $request->post('motivo');
            $inicio = $request->post('fechaI');
            $fin = $request->post('fechaF');
            $ausencia = new Ausencia();
            //$fechaInicio, $fechaFin, $motivo, $idMiembro
            $ausencia->insertar($inicio, $fin, $motivo, $idMiembro);

            //$idMiembro = (int)$request->session()->get('id');
            $listaausencias = $ausencia->buscarTodas($idMiembro);
            //return $inicio . ", " . $fin . ", " . $motivo . " ";
            //return view ('ausencias.index',['ausencias'=>$listaausencias]);
            return Redirect::to('/ausencias');
        }
        else
        {
            return redirect::to('/login');
        }
        
    }

    public function showOwns(Request $request)
    {

    }

    public function create(Request $request){
        if($this->acceso($request))
        {
            return view ('ausencias.create');
        }
        else
        {
            return redirect::to('/login');
        }

    }

    public function destroy($id){
        //Falta hacer el código para eliminarlo
        $ausenciaE = new Ausencia();
        $ausenciaE->eliminar($id);
        return Redirect::to('/ausencias');
    }

    public function update(Request $request){
        if($this->acceso($request))
        {
            $id = $request->post('id');
            $motivo = $request->post('motivo');
            $inicio = $request->post('fechaI');
            $fin = $request->post('fechaF');
            $ausenciaE = new Ausencia();
            $ausenciaE->actualizar($id,$motivo,$inicio,$fin);
            return Redirect::to('/ausencias');
            //return "Id: " . $id . ", Motivo: " . $motivo . ", inicio: " . $inicio . ", fin: " . $fin;
        }
        else
        {
            return redirect::to('/login');
        }
    }

    public function show(Request $request){

        
    }

    public function edit($ausencia)
    {
        $ausenciaE = new Ausencia();
        $elemento = $ausenciaE->buscar($ausencia);
        return view ('ausencias.edit',['ausencias'=>$elemento]);
    }
    public function ausenciaAceptar($ausencia)
    {
        $ausenciaE = new Ausencia();
        $ausenciaE->actualizarEstado($ausencia, true);
        //$ausencia = $request->get('ausencia');
        return Redirect::to('/administrarAusencias');
    }
    public function ausenciaRechazar($ausencia)
    {
        $ausenciaE = new Ausencia();
        $ausenciaE->actualizarEstado($ausencia, false);
        //$ausencia = $request->get('ausencia');
        return Redirect::to('/administrarAusencias');
    }
}
