<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Model\Miembro;
use App\Model\Roles;
use Illuminate\Support\Facades\Redirect;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    // protected $usuario = new Request();

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }


    public function index(Request $request)
    {

        if ($request->session()->has('id'))
        {
            return redirect::to('sesion');
            //return view('welcome');
        }

    }

    public function showLoginForm(Request $request)
    {
        // $request->session()->forget('id'); //Elimina el valor del id
        if ($request->session()->has('id'))
        {
            return redirect::to('sesion');
        }
        else
        {
            return view('auth.login');
        }
    }

    // Función que permite loguearse con la firma digital.
    public function loginFirmaDigital(Request $request){
        $nombre = $_COOKIE['nombre'];
        dd($nombre . ': ' ); // Esto es equivalente a un var_dump (es sólo para debugging, luego se debe quitar).
        return view('auth.login');
    }

    public function login(Request $request){
        // $request->session()->forget('id'); //Elimina el valor del id
        if (!$request->session()->has('id'))
        {



            $usuario = $request->post('email');
            $contrasenna = $request->post('password');
            $miembro = new Miembro();
            $listaMiembros = $miembro->mostrar();
            // echo "Usuario: " . $usuario . "</br> Contraseña: " . $contrasenna . "</br></br>" . $listaMiembros;
            foreach ($listaMiembros as $member)
            {
                // echo "Nombre: " . $member->nombremiembro;
                // echo "</br>Correo: " . $member->correo;
                if ($member->correo == $usuario)
                {
                    if ($member->contrasenna == $contrasenna)
                        // idmiembro
                    {
                        // echo "</br></br>Logueado xD</br></br>";
                        $request->session()->put('id', $member->idmiembro);
                        $request->session()->put('nombre', $member->nombremiembro . " " . $member->apellido1miembro . " " . $member->apellido2miembro);
                        $request->session()->put('roleNombre', $member->descripcionrole);


                        $request->session()->put('role', $member->rol);
                        $request->session()->put('agregarMiembro', $member->agregarmiembro);
                        $request->session()->put('eliminarMiembro', $member->eliminarmiembro);//Funciona también para editar y visualizar
                        $request->session()->put('administrarPuntos', $member->administrarpuntos);
                        $request->session()->put('proponerPuntos', $member->proponerpuntos);
                        $request->session()->put('puntos_agenda', $member->puntos_agenda);
                        $request->session()->put('aceptar_ausencias', $member->aceptar_ausencias);
                        $request->session()->put('iniciar_sesion', $member->iniciar_sesion);
                        // return view('welcome');
                        /*if($member->role == 1){
                            return view('/home', ['rol' => 1]);
                        }
                        return view('/home', ['rol' =>2]);*/
                         return redirect::to('sesion');
                    }
                    else
                    {
                        // echo "</br></br>Contraseña incorrecta</br></br>";
                        return Redirect::back()->with('password', 'The Message');
                    }
                }
            }
            // echo "</br></br>Correo Incorrecto</br></br>";
            return Redirect::back()->with('email', 'The Message');
        }
        else
        {
            // $request->session()->forget('id'); //Elimina el valor del id
            // echo "Ya estás loggeado";
            return redirect::to('sesion');
        }
    }
    public function logOut(Request $request)
    {
        $request->session()->forget('id');
        $request->session()->forget('role');
        $request->session()->forget('agregarMiembro');
        $request->session()->forget('eliminarMiembro');
        $request->session()->forget('administrarPuntos');
        $request->session()->forget('proponerPuntos');
        $request->session()->forget('aceptar_ausencias');
        $request->session()->forget('iniciar_sesion');
        $request->session()->forget('nombre');
        $request->session()->forget('roleNombre');
        return redirect::to('/home');
    }

    public function check(Request $request)
    {
        $usuario = $request->email;
        $contrasenna = $request->password;

        $miembro = new Miembro();
        $listaMiembros = $miembro->mostrar();

        foreach ($listaMiembros as $member)
        {
            if ($member->correo == $usuario && $member->contrasenna == $contrasenna)
            {
                return "true";
            }
        }

        return "false";
    }
}
