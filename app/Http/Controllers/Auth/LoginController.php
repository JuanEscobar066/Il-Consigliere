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

        // Primero, hay que verificar que la persona no esté logueada.
        if (!$request->session()->has('id')) {

            // Ya que es algo relacionado con conectividad a redes externas, es mejor meterlo en un try-catch.
            try{

                // Con la cookie del lector, obtenemos el nombre del usuario.
                $nombre = $_COOKIE['nombreUsuario'];

                // Luego, verificamos que está en la base de datos.
                // Para esto, creamos un miembro auxiliar.
                $miembro = new Miembro();

                // Obtenemos los usuarios de la base de datos.
                $listaMiembros = $miembro->mostrar();

                // Es importante comparar los datos en un mismo estándar, es decir, ambas van a estar
                // en mayúscula y sin tildes.
                $nombreUsuarioFirmaDigitalSinTildes = $this->quitarTildes($nombre);

                // Hay un detalle, en la base de datos está de la siguiente forma:
                // Primer nombre, primer apellido y segundo apellido.
                // Por lo que, vamos a eliminar el segundo nombre del usuario, en caso de tenerlo.
                $cantidadPalabras = explode(" ", $nombreUsuarioFirmaDigitalSinTildes);

                // Mediante el siguiente "slicing" del nombre, podemos obtener solo lo que nos interesa.
                $nombreSinSegundoNombre     = array();
                $nombreSinSegundoNombre[0]  = $cantidadPalabras[0];  // Primer nombre.
                $nombreSinSegundoNombre[1]  = $cantidadPalabras[count($cantidadPalabras) - 2];   // Primer apellido.
                $nombreSinSegundoNombre[2]  = $cantidadPalabras[count($cantidadPalabras) - 1];   // Segundo apellido.

                // Ahora, buscamos en la base de datos el Usuario que tenga la misma configuración.
                foreach ($listaMiembros as $cadaMiembroEnBase){

                    // Puede que el nombre en el registro, esté escrito con segundo nombre, por lo que
                    // lo vamos a omitir.
                    $nombreEnBase = explode(" ", $cadaMiembroEnBase->nombremiembro);

                    // Se obtiene la información de cada miembro, quitándole tildes y haciéndolo mayúscula.
                    $primerNombre       = strtoupper($this->quitarTildes($nombreEnBase[0]));
                    $primerApellido     = strtoupper($this->quitarTildes($cadaMiembroEnBase->apellido1miembro));
                    $segundoApellido    = strtoupper($this->quitarTildes($cadaMiembroEnBase->apellido2miembro));

                    // ¡Está en la base!
                    if($primerNombre    == $nombreSinSegundoNombre[0] &&
                       $primerApellido  == $nombreSinSegundoNombre[1] &&
                       $segundoApellido == $nombreSinSegundoNombre[2]){

                        // Setea el id, el nombre y su rol.
                        $request->session()->put('id', $cadaMiembroEnBase->idmiembro);
                        $request->session()->put('nombre', $cadaMiembroEnBase->nombremiembro .
                            " " . $cadaMiembroEnBase->apellido1miembro . " " . $cadaMiembroEnBase->apellido2miembro);
                        $request->session()->put('roleNombre', $cadaMiembroEnBase->descripcionrole);

                        // Setea toda su configuración y privilegios.
                        $request->session()->put('role', $cadaMiembroEnBase->rol);
                        $request->session()->put('agregarMiembro', $cadaMiembroEnBase->agregarmiembro);

                        //Funciona también para editar y visualizar
                        $request->session()->put('eliminarMiembro', $cadaMiembroEnBase->eliminarmiembro);

                        $request->session()->put('administrarPuntos', $cadaMiembroEnBase->administrarpuntos);
                        $request->session()->put('proponerPuntos', $cadaMiembroEnBase->proponerpuntos);
                        $request->session()->put('puntos_agenda', $cadaMiembroEnBase->puntos_agenda);
                        $request->session()->put('aceptar_ausencias', $cadaMiembroEnBase->aceptar_ausencias);
                        $request->session()->put('iniciar_sesion', $cadaMiembroEnBase->iniciar_sesion);

                        // Por aquello, es importante señalar que se logueó con el firmador.
                        $request->session()->put("tipoDeInicioDeSesion", "FirmaDigital");

                        // Finalmente, redireccione.
                        return redirect::to('sesion');
                    }
                }

                // Si sale del ciclo y no loguea, es que no está en la base de datos :(.
                return Redirect::back()->withErrors(['usuarioNoEncontrado',
                    'El usuario no se encuentra dentro del sistema.']);

            }
            catch (Exception $e){
                return $e->getMessage();
            }
        }

        // Significa que ya está logueado.
        else{

            // Nada más redireccionar de forma común y corriente.
            return redirect::to('sesion');
        }
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

                        // Para diferenciar los dos login.
                        $request->session()->put("tipoDeInicioDeSesion", "CorreoYContraseña");
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

    // Esta pequeña función auxiliar, recibe un string y le quita todas las tildes.
    // Tomada de: https://www.macosas.com/archives/funcion-php-para-quitar-las-tildes-de-una-cadena/
    function quitarTildes($cadena) {
        $no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬"
        ,"Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
        $permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
        $texto = str_replace($no_permitidas, $permitidas ,$cadena);
        return $texto;
    }
}
