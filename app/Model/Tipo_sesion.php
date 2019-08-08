<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use DB;

class Tipo_sesion extends Model
{
    protected $table = 'tipo_sesion';
    
    public $timestamps = false;
    
    protected $fillable = ['nombre'];    
    
    public function mostrar(){        
        $tipo_sesion = DB::table('tipo_sesion as ts')         
            ->select('ts.id', 'ts.nombre')
            ->get();

        return $tipo_sesion;
    }
}
