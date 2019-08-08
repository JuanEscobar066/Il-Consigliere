<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Model\Token;
use App\Mail\sendMail;
use Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function email(Request $request)
    {
        echo "hola";
    }
    public function sendResetLinkEmail(Request $request)
    {
        //Realizar if si correo existe.
        $token = $request->post('_token');
        $token = str_random(60);
        $correo = $request->post('email');
        $TokenObjeto = new Token();
        $TokenObjeto->eliminar($correo);//Para eliminar si tiene más de una solicitud.
        $TokenObjeto->insertar($correo,$token);
        $objetoMail = new sendMail($correo,$token);
        Mail::to($correo)->send($objetoMail->Contrasenna());
        return redirect::to('/home');
    }
}
