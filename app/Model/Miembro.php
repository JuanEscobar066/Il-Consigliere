<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use DB;

use App\Model\Ausencia;
class Miembro extends Model
{
    protected $table = 'miembro';

    protected $primaryKey = 'idmiembro';

    public $timestamps = false;

    protected $fillable = ['nombreMiembro', 'apellido1Miembro', 'apellido2Miembro', 'correo', 'rol'];

//     idMiembro int primary key GENERATED ALWAYS AS IDENTITY,
//     nombreMiembro varchar(50),
//     apellido1Miembro varchar(50),
//     apellido2Miembro varchar(50),
//     correo varchar(200),
//     contrasenna varchar(200),
//     rol int


    public function insertar($nombreMiembro,$apellido1Miembro,$apellido2Miembro,$correo,$contrasenna,$rol){
        // $miembro = new Miembro();

        // $miembro->nombreMiembro = $nombreMiembro;
        // $miembro->apellido1Miembro = $apellido1Miembro;
        // $miembro->apellido2Miembro = $apellido2Miembro;
        // $miembro->correo = $correo;
        // $miembro->contrasenna = $contrasenna;
        // $miembro->rol = $rol;

        DB::table('miembro')->insert(
            ['nombremiembro' => $nombreMiembro,
            'apellido1miembro' => $apellido1Miembro,
            'apellido2miembro' => $apellido2Miembro,
            'correo' => $correo,
            'contrasenna' => $contrasenna,
            'rol' => $rol]);
    }
    //protected $fillable = ['nombreMiembro', 'apellido1Miembro', 'apellido2Miembro', 'correo', 'contrasenna', 'rol'];

    public function eliminar($id)
    {
        DB::table('miembro as m')->where('idmiembro', '=', $id)->delete();
    }

    public function mostrar(){
        $miembro = DB::table('miembro as m')
            ->join('roles as r','m.rol','=','r.idrole')
            ->select('m.idmiembro', 'm.nombremiembro', 'm.apellido1miembro', 'm.apellido2miembro', 'm.correo', 'm.contrasenna', 'm.rol', 'r.descripcionrole', 'r.agregarmiembro','r.eliminarmiembro','r.administrarpuntos','r.proponerpuntos','r.puntos_agenda', 'r.aceptar_ausencias', 'r.iniciar_sesion')
            ->get();
        return $miembro;
    }

    public function convocarSinAusencias($fecha)
    {
        $miembros = DB::table('miembro as m')
            ->join('roles as r','m.rol','=','r.idrole')
            ->select('m.idmiembro', 'm.nombremiembro', 'm.apellido1miembro', 'm.apellido2miembro', 'm.correo', 'm.contrasenna', 'm.rol', 'r.descripcionrole', 'r.agregarmiembro','r.eliminarmiembro','r.administrarpuntos','r.proponerpuntos','r.puntos_agenda')

            ->get();
        $au = new Ausencia();
        $ausencias = $au->obtenerAusenciasDentroFecha($fecha);

        $listaAsiste = [];
        foreach ($miembros as $miembro)
        {
            $member = $miembro->idmiembro;
            //Para buscar si tiene una ausencia
            $asiste = true;
            foreach ($ausencias as $ausencia)
            {
                if ($ausencia->idmiembro == $member)
                {
                    $asiste = false;
                }
            }
            /*for($i=0;$i<sizeof($ausencias);$i++)
            {
                if ($ausencias[$i]->idmiembro == $member)
                {
                    $asiste = false;
                }
            }*/
            if ($asiste)
            {
                array_push($listaAsiste,$miembro);
            }
        }
        return $listaAsiste;

    }

    public function buscar($id){
        $member = DB::table('miembro as m')
                ->join('roles as r','m.rol','=','r.idrole')
                ->select('m.idmiembro', 'm.nombremiembro', 'm.apellido1miembro', 'm.apellido2miembro', 'm.correo', 'm.rol', 'r.descripcionrole','r.puntos_agenda')
                ->where('m.idmiembro', '=', (int)$id)
                ->get();
        return $member;
    }

    // public function actualizar($id, $tipo_sesion, $fecha, $hora, $lugar){
    //     $sesion = Sesion::findOrFail($id);

    //     $sesion->lugar = $lugar;
    //     $sesion->hora = $hora;
    //     $sesion->fecha = $fecha;
    //     $sesion->tipo_sesion = $tipo_sesion;

    //     $sesion->update();
    // }

    public function actualizar($ident,$nombreMiembro,$apellido1Miembro,$apellido2Miembro,$correo,$rol){

        DB::table('miembro')
            ->where('idmiembro', $ident)
            ->update(
                ['nombremiembro' => $nombreMiembro,
                'apellido1miembro' => $apellido1Miembro,
                'apellido2miembro' => $apellido2Miembro,
                'correo' => $correo,
                'rol' => $rol]);
    }

    public function actualizarContrasenna($correo,$contrasenna){

        DB::table('miembro')
            ->where('correo', $correo)
            ->update(
                ['contrasenna' => $contrasenna]);
    }

    public function actualizarContrasennaCorreo($correo,$contrasenna,$correoNuevo){

        DB::table('miembro')
            ->where('correo', $correo)
            ->update(
                ['contrasenna' => $contrasenna, 'correo' => $correoNuevo]);
    }
    public function mostrarCorreosRegistrados($idMiembro){
        $correos = DB::table('correos_registrados as c')
            ->select('id_miembro', 'correo', 'id_correo_registrado')
            ->where('id_miembro', $idMiembro)
            ->get();
        return $correos;
    }

    public function insertarCorreoNuevo($idmiembro,$correo){

        DB::table('correos_registrados')->insert(
            ['id_miembro' => $idmiembro,
            'correo' => $correo]);
    }

    public function actualizar_perfil($ident,$nombreMiembro,$apellido1Miembro,$apellido2Miembro){

        DB::table('miembro')
            ->where('idmiembro', $ident)
            ->update(
                ['nombremiembro' => $nombreMiembro,
                'apellido1miembro' => $apellido1Miembro,
                'apellido2miembro' => $apellido2Miembro]);
    }

    public function eliminarCorreo($idCorreo)
    {
        DB::table('correos_registrados')->where('id_correo_registrado', '=', $idCorreo)->delete();
    }
}
