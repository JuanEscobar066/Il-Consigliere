<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use DB;

class Ausencia extends Model
{
    //protected $table = 'miembro';
    
    //protected $primarykey = 'idMiembro';
    
    public $timestamps = false;
    
    //protected $fillable = ['nombreMiembro', 'apellido1Miembro', 'apellido2Miembro', 'correo', 'rol'];

//     idMiembro int primary key GENERATED ALWAYS AS IDENTITY,
//     nombreMiembro varchar(50),
//     apellido1Miembro varchar(50),
//     apellido2Miembro varchar(50),
//     correo varchar(200),
//     contrasenna varchar(200),
//     rol int

    /*$users = DB::table('users')->where([
    ['status', '=', '1'],
    ['subscribed', '<>', '1'],
])->get();*/
    
    public function insertar($fechaInicio, $fechaFin, $motivo, $idMiembro){            
        // $miembro = new Miembro();
        
        // $miembro->nombreMiembro = $nombreMiembro;
        // $miembro->apellido1Miembro = $apellido1Miembro;
        // $miembro->apellido2Miembro = $apellido2Miembro;
        // $miembro->correo = $correo;
        // $miembro->contrasenna = $contrasenna;
        // $miembro->rol = $rol;
        
        DB::table('ausencias')->insert(
            ['fechainicio' => $fechaInicio,
            'fechafin' => $fechaFin,
            'motivo' => $motivo,
            'idmiembro' => $idMiembro,
            'estado'=>false]);
    }
    //protected $fillable = ['nombreMiembro', 'apellido1Miembro', 'apellido2Miembro', 'correo', 'contrasenna', 'rol'];
    
    public function eliminar($id)
    {
        DB::table('ausencias as a')->where('idausencia', '=', $id)->delete();
    }

    public function mostrar(){        
        $ausencias = DB::table('ausencias as a')
            ->join('miembro as m','m.idmiembro','=','a.idmiembro')  
            ->select('a.estado','a.idausencia','m.idmiembro', 'm.nombremiembro', 'm.apellido1miembro', 'm.apellido2miembro', 'a.fechainicio', 'a.fechafin', 'a.motivo')
            ->get();
        return $ausencias;
    }

    public function buscarTodas($id){
        $ausencias = DB::table('ausencias as a')
            ->join('miembro as m','m.idmiembro','=','a.idmiembro')  
            ->select('a.estado','a.idausencia','m.idmiembro', 'm.nombremiembro', 'm.apellido1miembro', 'm.apellido2miembro', 'a.fechainicio', 'a.fechafin', 'a.motivo')
            ->where('a.idmiembro', '=', (int)$id)
            ->get();
        return $ausencias;
    }
    
    // Busca los miembros cuyas ausencias se presenten durante un periodo de sesión.
    public function buscarAusenciaPorRango($fechaSesion){
        $ausencias = DB::select( DB::raw(
            "select a.estado, a.idausencia , m.idmiembro, m.nombremiembro, m.apellido1miembro, m.apellido2miembro, a.fechainicio, a.fechafin, a.motivo, c.convocado
             FROM public.ausencias as a
             JOIN miembro as m ON m.idmiembro = a.idmiembro
             JOIN miembrosconvocados as c ON c.idmiembroconvocado = a.idmiembro
             JOIN events as e ON e.id = c.ideventoconvocado
             WHERE c.convocado = 1 AND e.fecha between a.fechainicio AND a.fechafin AND a.estado = 1 AND e.fecha = " . "'" . $fechaSesion . "'" . ";"));   

        return $ausencias; 
    }

    public function buscar($id){
        $member = DB::table('ausencias as a')
                ->join('miembro as m','m.idmiembro','=','a.idmiembro')  
                ->select('a.estado','a.idausencia','m.idmiembro', 'm.nombremiembro', 'm.apellido1miembro', 'm.apellido2miembro', 'a.fechainicio', 'a.fechafin', 'a.motivo')
                ->where('a.idausencia', '=', (int)$id)
                ->get();
        return $member;
    }

    public function actualizarEstado($idAusencia, $valor)
    {
        DB::table('ausencias as a')
            ->where('idausencia', $idAusencia)
            ->update(
                ['estado' => $valor]);
    }


    public function actualizar($ident,$motivo,$fechaI,$fechaF){            

        DB::table('ausencias as a')
            ->where('idausencia', $ident)
            ->update(
                ['motivo' => $motivo,
                'fechainicio' => $fechaI,
                'fechafin' => $fechaF]);
    }

    public function obtenerAusenciasDentroFecha($fecha)
    {
        $ausencias = DB::table('ausencias as a')
        ->where(
            [['a.fechainicio', '<=', $fecha],
            ['a.fechafin', '>=', $fecha],
            ['a.estado','=',1]])//Para que está aprobada
        ->get();
        return $ausencias;
    }
}