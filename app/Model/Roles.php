<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use DB;

class Roles extends Model
{
    protected $table = 'miembro';
    
    protected $primarykey = 'idrole';
    
    public $timestamps = false;
    
    protected $fillable = ['descripcionrole'];

//     idMiembro int primary key GENERATED ALWAYS AS IDENTITY,
//     nombreMiembro varchar(50),
//     apellido1Miembro varchar(50),
//     apellido2Miembro varchar(50),
//     correo varchar(200),
//     contrasenna varchar(200),
//     rol int

    
    public function insertar($nombreMiembro,$apellido1Miembro,$apellido2Miembro,$correo,$contrasenna,$rol){            
        $miembro = new Miembro();
        
        $miembro->nombreMiembro = $nombreMiembro;
        $miembro->apellido1Miembro = $apellido1Miembro;
        $miembro->apellido2Miembro = $apellido2Miembro;
        $miembro->correo = $correo;
        $miembro->contrasenna = $contrasenna;
        $miembro->rol = $rol;
        
        $miembro->save();
    }
    //protected $fillable = ['nombreMiembro', 'apellido1Miembro', 'apellido2Miembro', 'correo', 'contrasenna', 'rol'];
    
    public function mostrar(){        
        $role = DB::table('roles as r')
            //->join('roles as r','m.idMiembro','=','r.idRole')  
            ->select('r.idrole', 'r.descripcionrole')
            ->get();
        return $role;
    }
    
    public function buscar($id){
        $sesion = new Sesion;
        $sesion = Sesion::find($id);
        return $sesion;
    }
    
    public function actualizar($id, $tipo_sesion, $fecha, $hora, $lugar){
        $sesion = Sesion::findOrFail($id);
        
        $sesion->lugar = $lugar;
        $sesion->hora = $hora;
        $sesion->fecha = $fecha;
        $sesion->tipo_sesion = $tipo_sesion;
        
        $sesion->update();
    }
}