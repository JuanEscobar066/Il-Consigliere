<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Model\PuntoAgenda;
// use App\Model\PuntoAgenda;
//use App\Model\Miembro;
use App\Model\Sesion;

class sendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $correo;
    public $token;
    public $listaPuntos;
    public $miembros;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $correo, string $token)
    {
        //
        $this->correo = $correo;
        $this->token = $token;
        //return $this->view('mail');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('mail');
    }

    public function Contrasenna()
    {
        return $this->view('mail');
    }

    public function enviarCorreoPuntos()
    {
        return $this->view('mail_points');
    }

    public function obtenerTodosCorreosLista($listaMiembros)
    {
        $listaRetorno = [];
        foreach ($listaMiembros as $miembro)
        {
            array_push($listaRetorno,$miembro->correo);
        }
        return $listaRetorno;
    }
    public function obtenerTodosCorreos($idEvento)
    {
        $sesion = new Sesion;
        $miembros =  $sesion->obtenerMiembrosConvocadosCorreo($idEvento);
        //$puntos = PuntoAgenda::all();
        $correos = $this->obtenerTodosCorreosLista($miembros);
        return $correos;
    }

    public function obtenerPuntos($idEvento)
    {
        $puntos = PuntoAgenda::all();
    }
    // public function enviarPuntosAceptados($idEvento)
    // {
    //     $sesion = new Sesion;
    //     $miembros =  $sesion->obtenerMiembrosConvocadosCorreo($idEvento);
    //     $puntos = PuntoAgenda::all();
    //     $correos = $this->obtenerTodosCorreos($miembros);
    //     return $correos;

    // }
}
