<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Model\Miembro;
use App\Model\Roles;
use Illuminate\Support\Facades\Redirect;
//use App\Model\Tipo_sesion;
use App\Http\Requests\MiembroFormRequest;

use App\Model\Token;
use App\Mail\sendMail;
use Mail;


class MiembroController extends Controller
{
    public function __construct(){
        
    }

    public function index(Request $request){
        if ($request){
            $miembro = new Miembro();
            $listaMiembros = $miembro->mostrar();
            return view ('members.index',['miembros'=>$listaMiembros]);
        }
    }
    
    public function create(Request $request){
        
        if ($request){
            $roles = new Roles();
            $listaRoles = $roles->mostrar();
            return view ('members.create',['roles'=>$listaRoles]);
        }

    }
    

    
    public function show(Request $request){
        if ($request){
            $miembro = new Miembro();
            $listaMiembros = $miembro->mostrar();
            return view ('members.index',['miembros'=>$listaMiembros]);
        }
    	
    }

    public function store(Request $request){
        $miembro = new Miembro();
        $nombre = $request->post('nombre');
        $primerApellido = $request->post('primerApellido');
        $segundoApellido = $request->post('segundoApellido');
        $correo = $request->post('correo');
        $ocupacion = $request->post('ocupacionS');
        $contrasenna = $request->post('contrasenna');
        $contrasenna2 = $request->post('contrasenna2');
        if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            if ($contrasenna==$contrasenna2 and $contrasenna!="" and $nombre != "" and $primerApellido != "" and $segundoApellido != "")
            {
                //El correo es válido y las contraseñas son iguales
                $miembro->insertar($nombre,$primerApellido,$segundoApellido,$correo,bcrypt($contrasenna),$ocupacion);
                $miembro = new Miembro();
                $listaMiembros = $miembro->mostrar();
                // return view ('members.index',['miembros'=>$listaMiembros]);


                $token = str_random(60);
                $TokenObjeto = new Token();
                $TokenObjeto->insertar($correo,$token);
                $ma = new sendMail($correo,$token);
                Mail::to($correo)->send($ma->contrasenna());
                // return redirect::to('/home');

                return Redirect::to('/miembro/show');
            }
            else
            {//Contraseñas no son iguales
                return Redirect::back()->with('msg', 'The Message');
            }
            
        }
        
        else
        {//Correo inválido
            return Redirect::back()->with('msg', 'The Message');

        }
        
    }

    public function delete(Request $request){
        if ($request){
            $miembro = new Miembro();
            $listaMiembros = $miembro->mostrar();
            return view ('members.eliminarmiembro',['miembros'=>$listaMiembros]);
        }
        
    }
    public function search($id)
    {
        $miembro = new Miembro();
        $listaMiembros = $miembro->buscar($id);
        return $listaMiembros->nombremiembro;
    }


    public function deleteButton($parameter)
    {
        $miembro = new Miembro();
        $miembro->eliminar($parameter);
        $miembro = new Miembro();
        $listaMiembros = $miembro->mostrar();
        // return view ('members.index',['miembros'=>$listaMiembros]);
        return Redirect::to('/miembro/show');
    }
    
    public function edit($parameter)
    {
        $miembro = new Miembro();
        $resultado = $miembro->buscar($parameter);
        $roles = new Roles();
        $listaRoles = $roles->mostrar();
        return view ('members.edit',['miembros'=>$resultado, 'roles'=>$listaRoles]);
    }



    public function deleteData(Request $request){
        $miembro = new Miembro();
        $member = (int)$request->post('miembro');
        $miembro->eliminar($member);
        $miembro = new Miembro();
        $listaMiembros = $miembro->mostrar();
        // return view ('members.index',['miembros'=>$listaMiembros]);
        return Redirect::to('/miembro/show');
    }

    public function update(Request $request){
        $miembro = new Miembro();
        $nombre = $request->post('nombre');
        $primerApellido = $request->post('primerApellido');
        $segundoApellido = $request->post('segundoApellido');
        $correo = $request->post('correo');
        $ocupacion = $request->post('ocupacionS');
        $ident = $request->post('ident');
        $miembro->actualizar($ident,$nombre,$primerApellido,$segundoApellido,$correo,$ocupacion);
        $miembro = new Miembro();
        $listaMiembros = $miembro->mostrar();
        return Redirect::to('/miembro/show');
        // return view ('members.index',['miembros'=>$listaMiembros]);
    }
    
    public function destroy($id){
        $miembro = new Miembro();
        $miembro->eliminar($id);
        $miembro = new Miembro();
        $listaMiembros = $miembro->mostrar();
        return Redirect::to('/miembro/show');
        // return view ('members.index',['miembros'=>$listaMiembros]);
    }

    public function perfilUsuario(Request $request)
    {
        $idMiembro = (int)$request->session()->get('id');
        $miembro = new Miembro();
        $resultado = $miembro->buscar($idMiembro);

        $correos = $miembro->mostrarCorreosRegistrados($idMiembro);
        
        return view ('members.profileEdit',['miembro'=>$resultado, 'correos'=>$correos]);
        //return view ('members.profileEdit');
    }
    public function perfilAlmacenar(Request $request)
    {

        $miembro = new Miembro();
        $nombreMiembro = $request->post('nombre');
        $primerApellido = $request->post('primerApellido');
        $segundoApellido = $request->post('segundoApellido');
        $correoNuevo = $request->post('correoN');
        $idMiembro = $request->post('ident');
        $miembro->actualizar_perfil($idMiembro,$nombreMiembro,$primerApellido,$segundoApellido);
        if($correoNuevo!="")
        {
            $miembro->insertarCorreoNuevo($idMiembro,$correoNuevo);
        }

        return Redirect::to('sesion');
    }
    public function eliminarCorreo($idCorreo,Request $request)
    {
        $miembro = new Miembro();
        $miembro->eliminarCorreo($idCorreo);
        return Redirect::to('perfil/edit');
    }
}
