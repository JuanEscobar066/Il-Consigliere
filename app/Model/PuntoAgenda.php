<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class PuntoAgenda extends Model
{
	const CREATED_AT = 'fecha';
	const UPDATED_AT = 'fecha';

	protected $table = 'punto_agenda';
	protected $primaryKey = 'id_punto';

	protected $attributes = [
		'estado' => true,
	];

	public function adjuntos()
	{
		return $this->hasMany('App\Model\AdjuntosPunto','id_punto');
	}

	public function obtenerPuntosTodos()
	{
		$puntos = DB::table('punto_agenda as p')
                ->join('miembro as m','m.idmiembro','=','p.miembro')
                ->select('m.nombremiembro', 'm.apellido1miembro', 'm.apellido2miembro', 'p.titulo', 'p.considerando', 'p.acuerda', 'p.fecha')

                ->get();
        return $puntos;
	}

	public function obtenerPuntosPorUsuario($idMiembro, $idEvento)
	{
		$puntos = DB::table('punto_agenda as p')
                ->join('miembro as m','m.idmiembro','=','p.miembro')
                ->select('p.id_punto','m.nombremiembro', 'm.apellido1miembro', 'm.apellido2miembro', 'p.titulo', 'p.considerando', 'p.acuerda', 'p.miembro', 'p.id_punto')
                ->where('p.punto_para_agenda', '=', (int)$idEvento, 'and', 'm.idmiembro', '=', (int)$idMiembro)
                ->get();
        return $puntos;
	}

	public function obtenerPuntosPorEvento($idEvento)
	{
		$puntos = DB::table('punto_agenda as p')
                ->join('miembro as m','m.idmiembro','=','p.miembro')
                ->select('p.id_punto','m.nombremiembro', 'm.apellido1miembro', 'm.apellido2miembro', 'p.titulo', 'p.considerando', 'p.acuerda', 'p.miembro', 'p.id_punto')
                ->where('p.punto_para_agenda', '=', (int)$idEvento)
                ->get();
        return $puntos;
	}
	public function obtenerPuntosPorEventoAceptados($idEvento)
	{
		$puntos = DB::table('punto_agenda as p')
                ->join('miembro as m','m.idmiembro','=','p.miembro')
                ->select('m.nombremiembro', 'm.apellido1miembro', 'm.apellido2miembro', 'p.titulo', 'p.considerando', 'p.acuerda')
                ->where('p.punto_para_agenda', '=', (int)$idEvento, 'and', 'estado', '=', true)
                ->get();
        return $puntos;
	}

    public function obtenerPuntoActivo()
    {
        $puntos = DB::table('votaciones_puntos as vp')
                ->join('punto_agenda as pa', 'pa.id_punto', '=', 'vp.idpunto')
                ->select('pa.id_punto', 'pa.titulo', 'vp.idvotacionespuntos')
                ->where('vp.estaactivo', '=', 1)
                ->get();
        return $puntos;
    }

    public function aceptarPunto(Request $request) {
        $voto = DB::table('votaciones_puntos as vp')
              ->select('vp.favor')
              ->where('vp.idvotacionespuntos', '=', (int)$request->post('idVote'))
              ->get();

        DB::table('votaciones_puntos as vp')
            ->where('vp.idvotacionespuntos', '=', (int)$request->post('idVote'))
            ->update([
                'favor' => $voto + 1
            ]);
    }

    public function rechazarPunto(Request $request) {
        $voto = DB::table('votaciones_puntos as vp')
              ->select('vp.contra')
              ->where('vp.idvotacionespuntos', '=', (int)$request->post('idVote'))
              ->get();

        DB::table('votaciones_puntos as vp')
            ->where('vp.idvotacionespuntos', '=', (int)$request->post('idVote'))
            ->update([
                'contra' => $voto + 1
            ]);
    }

	public function iniciarVotacion($idPunto)
	{
		DB::table('votaciones_puntos')->insert(
            ['idpunto' => $idPunto,
            'estaactivo' => 1,
            'favor' => 0,
            'contra' => 0,
            'abstinencia' => 0]);
	}

	public function cerrarVotacion($idPunto)
	{
		DB::table('votaciones_puntos as v')
			->where('v.idpunto', '=', (int)$idPunto)
			->update(
                ['estaactivo' => 0,]);
	}

	public function reiniciarVotacion($idPunto)
	{
		DB::table('votaciones_puntos as v')
			->where('v.idpunto', '=', (int)$idPunto)
			->update(
                ['estaactivo' => 1,]);
	}

	public function buscarVotacion($idPunto)
	{
		$puntos = DB::table('votaciones_puntos as v')
                ->select('v.idpunto', 'v.estaactivo', 'v.favor', 'v.contra', 'v.abstinencia')
                ->where('v.idpunto', '=', (int)$idPunto)
                ->get();
        return $puntos;
	}

	public function votoFavor($idPunto)
	{
		DB::table('votaciones_puntos as v')
			->where('v.idpunto', '=', (int)$idPunto)
			->update(
                ['favor' => DB::raw('favor + 1'),]);

	}

	public function votoContra($idPunto)
	{
		DB::table('votaciones_puntos as v')
			->where('v.idpunto', '=', (int)$idPunto)
			->update(
                ['contra' => DB::raw('contra + 1'),]);
	}

	public function votoAbstinencia($idPunto)
	{
		DB::table('votaciones_puntos as v')
			->where('v.idpunto', '=', (int)$idPunto)
			->update(
                ['abstinencia' => DB::raw('abstinencia + 1'),]);
	}

	public function votoFavor_Miembro($idPunto,$idMiembro)
	{
		DB::table('votaciones_por_miembro')->insert(
            ['id_punto' => $idPunto,
            'idmiembro' => $idMiembro,
            'estado' => 0,]);

	}

	public function votoContra_Miembro($idPunto,$idMiembro)
	{
		DB::table('votaciones_por_miembro')->insert(
            ['id_punto' => $idPunto,
            'idmiembro' => $idMiembro,
            'estado' => 1,]);
	}

	public function votoAbstinencia_Miembro($idPunto,$idMiembro)
	{
		DB::table('votaciones_por_miembro')->insert(
            ['id_punto' => $idPunto,
            'idmiembro' => $idMiembro,
            'estado' => 2,]);
	}

	public function votoPrivado_Miembro($idPunto,$idMiembro)
	{
		DB::table('votaciones_por_miembro')->insert(
            ['id_punto' => $idPunto,
            'idmiembro' => $idMiembro,
            'estado' => 3,]);
	}

	public function obtenerVotos_Miembros($idPunto)
	{
		$votos = DB::table('votaciones_por_miembro as v')
				->join('miembro as m','m.idmiembro','=','v.idmiembro')
                ->select('m.nombremiembro', 'm.apellido1miembro', 'm.apellido2miembro', 'v.estado')
                ->where('v.id_punto', '=', (int)$idPunto)
                ->get();
        return $votos;
	}

	public function obtenerVotosUsuarioPunto($idPunto,$idMiembro)
	{

        $votos = DB::table('votaciones_por_miembro as v')
                ->select('v.id_punto','v.idmiembro', 'v.estado')
                ->where('v.id_punto', '=', (int)$idPunto, 'and', 'idmiembro', '=', (int)$idMiembro)
                ->get();
        return $votos;
	}





}



