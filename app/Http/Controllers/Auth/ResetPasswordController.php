<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Model\Miembro;
use App\Model\Token;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $token;
    public function __construct()
    {
        
        $this->middleware('guest');
    }

    public function update()
    {
        echo "Hola";
    }

    public function reset(Request $request)
    {
        $token = $request->post('token');
        $miembro = new Miembro();
        $correoAnterior = $request->post('correoAnterior');
        $correo = $request->post('email');
        $contrasenna =  $request->post('password');
        $correoNuevo = $request->post('emailnew');
        $contrasennaConform =  $request->post('password_confirmation');
        if ($correo == $correoAnterior)
        {//Sí puede modificarlos
            if ($contrasennaConform == $contrasenna)
            {
                if ($correoNuevo == "")
                {
                    $miembro->actualizarContrasenna($correo,$contrasenna);
                }
                else
                {
                    $miembro->actualizarContrasennaCorreo($correo,$contrasenna,$correoNuevo);
                }
                $TokenObjeto = new Token();
                $TokenObjeto->eliminar($correo);
                return redirect::to('/home');
            }
            else
            {
                return Redirect::back()->with('password', 'Contraseña incorrecta');
            }
        }
        else
        {
            return Redirect::back()->with('email', 'Email incorrecto');
        }
        
    }
    public function showResetForm($token)
    {
        $this->token = $token;
        $TokenObjeto = new Token();
        $tokenRegistrado = $TokenObjeto->buscar($token);

        if (count($tokenRegistrado) > 0)

        {//Sí hay un token en la base de datos
            $correoAnterior = $tokenRegistrado[0]->correo;
            // echo $correoAnterior;
            return view('auth.passwords.reset',['token'=>$token,'correoAnterior'=>$correoAnterior]);
        }
        else
        {
            return redirect::to('/home');
        }
        
    }
}
