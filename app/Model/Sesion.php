<?php

namespace App\Model;

// Esto quiere decir que lo crearon desde la temrinal de Laravel, mediante el comando:
// php artisan make:model Sesion
// Exactamente, utilizan Eloquent para hacer el CRUD de la base de datos.
use Illuminate\Database\Eloquent\Model;

use DB;

use App\Model\Miembro;

class Sesion extends Model
{
    protected $table = 'events';

    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable = ['lugar', 'hora', 'fecha', 'tipo_sesion', 'punto_activo', 'estaactivo'];
 /*
    public function insertar($tipo_sesion, $fecha, $hora, $lugar){
        $sesion = new Sesion();

        $sesion->lugar = $lugar;
        $sesion->hora = $hora;
        $sesion->fecha = $fecha;
        $sesion->tipo_sesion = $tipo_sesion;
        $sesion->punto_activo = 0;
        $sesion->estaactivo = 0;

        $sesion->save();

        $this->ConvocarMiembros($fecha);
    }
*/
    // Ni siquiera está recibiendo la fecha.
    public function insertar($tipo_sesion, $hora, $lugar){
        $sesion = new Sesion();

        $sesion->lugar = $lugar;
        $sesion->hora = $hora;

        // Obtiene la fecha del JavaScript. 
        $sesion->fecha = $_GET["fecha"];
        
        $sesion->tipo_sesion = $tipo_sesion;
        $sesion->punto_activo = 0;
        $sesion->estaactivo = 0;

        $sesion->save();

        $this->ConvocarMiembros($fecha);
    }

    public function insertarAsistencia($lista)
    {
        DB::table('asistencia_a_evento')->insert($lista);
    }

    public function asistenciaPorEvento($idEvento)
    {
        $miembros = DB::table('asistencia_a_evento as a')
            ->join('miembro as m','a.id_usuario','=','m.idmiembro')
            ->join('roles as r','m.rol','=','r.idrole')
            ->select('r.idrole', 'a.id_asistencia_a_evento', 'a.id_usuario', 'a.id_evento', 'a.estado', 'm.nombremiembro', 'm.apellido1miembro', 'm.apellido2miembro')
            ->orderBy('a.id_asistencia_a_evento', 'asc')
            ->where('id_evento', $idEvento)
            ->get();
        return $miembros;
    }

    public function sesionInicioHoraActualizar($idEvento)
    {
         DB::table('events')
            ->where('id', $idEvento)
            ->update(['hora' => 'NOW()']);
    }

    public function modificarNombreArchivo($idEvento,$nombreArchivo)
    {
         DB::table('events')
            ->where('id', $idEvento)
            ->update(['direccion_archivo' => $nombreArchivo]);
    }

    public function obtenerHoraInicioFinEvento($idEvento)
    {
        $horas = DB::table('events as s')
            ->select('s.hora', 's.horafin')
            ->where('id', $idEvento)
            ->get();
        return $horas;
    }


    public function sesionFinHoraActualizar($idEvento)
    {
         DB::table('events')
            ->where('id', $idEvento)
            ->update(['horafin' => 'NOW()']);
    }


    public function insertarBitacora($lista)
    {
        DB::table('bitacora')->insert($lista);
    }

    public function actualizarArchivo($idEvento, $direccion)
    {
        DB::table('events')
            ->where('id', $idEvento)
            ->update(['direccion_archivo' => $direccion]);
    }

    public function actualizarTodosMiembrosConvocados($idEvento)
    {
        DB::table('miembrosconvocados')
            ->where('ideventoconvocado', $idEvento)
            ->update(['convocado' => 0]);
    }
    public function actualizarMiembrosConvocadosSi($idEvento,$listaMiembros)
    {
        $query = DB::table('miembrosconvocados')
            ->where('idmiembroconvocado', '=', 0);

        foreach ($listaMiembros as $miembro) {
            //echo "mmd, :" . $miembro;
            $query->orWhere('idmiembroconvocado', '=', (int)$miembro);
        }
        $query->update(['convocado' => 1]);

    }

    public function actualizarMiembrosPresentesNo($idEvento)
    {
        DB::table('asistencia_a_evento')
            ->where('id_evento', $idEvento)
            ->update(['estado' => 0]);
    }
    public function actualizarMiembrosPresentesSi($idEvento,$listaMiembros)
    {
        $query = DB::table('asistencia_a_evento');

        foreach ($listaMiembros as $miembro) {
            //echo "mmd, :" . $miembro;
            $query->orWhere('id_asistencia_a_evento', '=', (int)$miembro);
        }
        $query->update(['estado' => 1]);

    }

    public function obtenerUltimoIdSesion()
    {
        $sesion = DB::table('events as s')
            ->join('tipo_sesion as ts','s.tipo_sesion','=','ts.id')
            ->select('s.id', 's.lugar', 's.fecha', 's.hora', 'ts.nombre as tipo')
            ->orderBy('id', 'desc')
            ->take(1)
            ->get();
        return (int)$sesion[0]->id;
    }

    public function crearListaInsertar($listaMiembros,$idSesion)
    {   //return $listaMiembros;
        $listaRetorno = [];
        foreach($listaMiembros as $miembro)
        {
            $listaRetorno2 = ['ideventoconvocado' => $idSesion, 'idmiembroconvocado' => (int)$miembro->idmiembro, 'convocado' => 1];
            array_push($listaRetorno,$listaRetorno2);
            //$listaRetorno = ['ideventoconvocado' => (int)$miembro->idmiembro];
        }
        return $listaRetorno;
    }
    public function obtenerMiembrosConvocadosCorreo($idEvento)
    {
        // $miembro = new Miembro();
        // $listaMiembros = $miembro->mostrar();
        $listaMiembros = DB::table('miembrosconvocados as c')
            ->join('miembro as m','c.idmiembroconvocado','=','m.idmiembro')
            ->select('m.idmiembro','m.correo','c.idmiembroconvocado', 'c.ideventoconvocado', 'c.convocado', 'm.nombremiembro', 'm.apellido1miembro', 'm.apellido2miembro')
            ->orderBy('m.apellido1miembro', 'asc')
            ->where('c.ideventoconvocado', '=', $idEvento)
            ->get();
        return $listaMiembros;
    }
    public function obtenerMiembrosConvocados($idEvento)
    {
        // $miembro = new Miembro();
        // $listaMiembros = $miembro->mostrar();
        $listaMiembros = DB::table('miembrosconvocados as c')
            ->join('miembro as m','c.idmiembroconvocado','=','m.idmiembro')
            ->select('m.idmiembro','c.idmiembroconvocado', 'c.ideventoconvocado', 'c.convocado', 'm.nombremiembro', 'm.apellido1miembro', 'm.apellido2miembro')
            ->orderBy('m.apellido1miembro', 'asc')
            ->where('c.ideventoconvocado', '=', $idEvento)
            ->get();
        return $listaMiembros;
    }


    public function eliminarPuntosEvento($idEvento)
    {
        DB::table('punto_agenda as p')->where('punto_para_agenda', '=', $idEvento)->delete();
    }


    public function eliminarMiembrosConvocados($idEvento)
    {
        DB::table('miembrosconvocados as c')->where('ideventoconvocado', '=', $idEvento)->delete();
    }


    public function ConvocarMiembros($fecha)
    {
        $idSesion = $this->obtenerUltimoIdSesion();
        $miembro = new Miembro();

        $listaMiembros = $miembro->convocarSinAusencias($fecha);
        //$listaMiembros = $miembro->mostrar();
        //$listaMiembros = $this->obtenerMiembrosConvocados($idSesion);
        $listaInsertar = $this->crearListaInsertar($listaMiembros,$idSesion);

        DB::table('miembrosconvocados')->insert($listaInsertar);
        //echo $listaMiembros;
        //return $listaInsertar;
    }


    public function mostrarPorUsuario($idUsuario){
        $sesion = DB::table('events as s')
            ->join('tipo_sesion as ts','s.tipo_sesion','=','ts.id')
            ->join('miembrosconvocados as m','m.ideventoconvocado','=','s.id')
            ->where('m.idmiembroconvocado', $idUsuario)
            ->select('s.id', 's.lugar', 's.fecha', 's.hora', 'ts.nombre as tipo', 's.estaactivo')
            ->orderBy('s.fecha', 'asc')
            ->get();
        return $sesion;
    }

    public function mostrar()
    {
        $sesion = DB::table('events as s')
            ->join('tipo_sesion as ts','s.tipo_sesion','=','ts.id')
            ->select('s.id', 's.lugar', 's.fecha', 's.hora', 'ts.nombre as tipo', 's.estaactivo')
            ->orderBy('s.fecha', 'asc')
            ->get();
        return $sesion;
    }

    public function mostrarFiltrado($id)
    {
        $sesion = DB::table('events as s')
            ->join('tipo_sesion as ts','s.tipo_sesion','=','ts.id')
            ->select('s.id', 's.lugar', 's.fecha', 's.hora', 'ts.nombre as tipo', 's.estaactivo')
            ->orderBy('s.fecha', 'asc')
            ->where('s.id',$id)
            ->get();
        return $sesion;
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


    public function iniciarSesion($idSesion)
    {
        DB::table('events as e')
            ->where('id', $idSesion)
            ->update(['estaactivo' => 1]);
    }

    public function cerrarSesion($idSesion)
    {
        DB::table('events as e')
            ->where('id', $idSesion)
            ->update(['estaactivo' => 2]);
    }


    public function anteriorPunto($id,$punto)
    {
        DB::table('events as e')
            ->where('id', $id)
            ->update(['punto_activo' => $punto]);
    }
    public function siguientePunto($id,$punto)
    {
        DB::table('events as e')
            ->where('id', $id)
            ->update(['punto_activo' => $punto]);
    }
    public function actualizarEstaActivo($id,$valor)
    {
        DB::table('events as e')
            ->where('id', $id)
            ->update(['estaactivo' => $valor]);
    }




}
