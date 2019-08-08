<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use DB;

class Token extends Model
{
    protected $table = 'reseteo_contrasennas';
    
    protected $primarykey = 'idreseteo';
    
    public $timestamps = false;
    
    protected $fillable = ['correo', 'tokenreseteo'];


    
    public function insertar($correo,$tokenReseteo){      
        DB::table('reseteo_contrasennas')->insert(
            ['correo' => $correo,
            'tokenreseteo' => $tokenReseteo]);
    }
    //protected $fillable = ['nombreMiembro', 'apellido1Miembro', 'apellido2Miembro', 'correo', 'contrasenna', 'rol'];
    
    public function eliminar($correo)
    {
        DB::table('reseteo_contrasennas as r')->where('r.correo', '=', $correo)->delete();
    }

    // public function mostrar(){       
    //     $miembro = DB::table('tokenReseteo as r')
    //         ->select('r.correo', 'r.tokenReseteo')
    //         ->get();
    //     return $miembro;
    // }
    
    public function buscar($tokenReseteo){
        $token = DB::table('reseteo_contrasennas as r')
                ->select('r.correo', 'r.tokenreseteo')
                ->where('r.tokenreseteo', '=', $tokenReseteo)
                ->get();
        return $token;
    }
}