<?php

namespace App\Http\Controllers;

// Todas las bibliotecas a utilizar.
use DateTime;
use Illuminate\Http\Request;
use App\Model\Sesion;
use App\Model\Tipo_sesion;
use App\Event;
use App\Model\Miembro;
use App\Mail\sendMail;
use App\Model\PuntoAgenda;
use Illuminate\Support\Facades\Mail;
use Calendar;
use Illuminate\Support\Facades\Redirect;
use PhpOffice\PhpWord\TemplateProcessor;

class SesionController extends Controller
{
    private $miembrosConvocados = [];
    //Request $requestA;
    public function __construct()
    { }

    private function acceso(Request $request)
    {
        if (($request->session()->has('id')) and ((int) $request->session()->get('id') != 0)) {
            return true;
        } else {
            return false;
        }
    }




    public function index(Request $request)
    {

        if ($this->acceso($request)) {
            $events = [];
            $data = Event::all();

            $tipo_sesion = new Tipo_sesion();
            $tipo_sesion = $tipo_sesion->mostrar();

            if ($data->count()) {

                foreach ($data as $key => $value) {
                    $events[] = Calendar::event(
                        $tipo_sesion[0]->nombre,
                        false,
                        new DateTime($value->fecha . $value->hora),
                        new DateTime($value->fecha),
                        $value->id,
                        [
                            'url' => 'http://localhost:8000/puntoAgenda',
                            //any other full-calendar supported parameters
                        ]
                    );
                }
            }
            $calendar = Calendar::addEvents($events);

            if ($request) {
                $usuario = (int) $request->session()->get('id');
                $sesion = new Sesion();
                $listaSesiones = $sesion->mostrarPorUsuario($usuario);

                // Primero, hace una consulta a la base y trae los puntos necesarios.
                $puntos = PuntoAgenda::all();

                // Luego, por cada punto
                foreach ($puntos as $punto) {

                    // Busca el miembro al que pertenece.
                    $miembro = Miembro::find($punto->miembro);

                    // Obtiene el nombre del punto.
                    $nombre = "$miembro->nombremiembro $miembro->apellido1miembro";

                    // Asigna el nombre al punto.
                    $punto->miembro = $nombre;
                }
                
                return view('sesion.index', ['sesiones' => $listaSesiones, 'puntosPropuestos' => $puntos], compact('calendar'));
            }
        } else {
            return redirect::to('/login');
        }
    }    

    public function crearConFecha(Request $request, $fecha)
    {
        return $fecha;
    }

    public function create(Request $request)
    {
        if ($this->acceso($request)) {
            $tipo_sesion = new Tipo_sesion();
            $tipo_sesion = $tipo_sesion->mostrar();
            $miembro = new Miembro();
            $listaMiembros = $miembro->mostrar();

            return view("sesion.create", ['tipo_sesion' => $tipo_sesion, "listaMiembros" => $listaMiembros]);
        } else {
            return redirect::to('/login');
        }
    }



    public function store(Request $request)
    {
        if ($this->acceso($request)) {
            $events = [];
            $data = Event::all();

            $tipo_sesion = new Tipo_sesion();
            $tipo_sesion = $tipo_sesion->mostrar();

            if ($data->count()) {

                foreach ($data as $key => $value) {
                    //$events[] = Calendar::event(
                    //    $value->title,
                    //    true,
                    //    new \DateTime($value->start_date),
                    //    new \DateTime($value->end_date.' +1 day')
                    //);

                    $events[] = Calendar::event(
                        $tipo_sesion[0]->nombre,
                        false,
                        new DateTime($value->fecha . $value->hora),
                        new DateTime($value->fecha),
                        $value->id
                    );
                }
            }
            $calendar = Calendar::addEvents($events);

            $sesion = new Sesion;
            //Al llamae a insertar se insertan los convocados.
            $sesion->insertar($request->get('tipo_sesion'), $request->get('hora'), $request->get('lugar'));
            //$sesion->insertar($request->get('tipo_sesion'), $request->get('fecha'),$request->get('hora'),$request->get('lugar'));
            $listaSesiones = $sesion->mostrar();
            //return view ('sesion.index',['sesiones'=>$listaSesiones], compact('calendar'));
            return redirect::to('/sesion');
        } else {
            return redirect::to('/login');
        }
    }

    public function show($id)
    { }




    /*
        $id va a ser el id de la sesion a la que se va a mandar todos los puntos.
    */
    public function enviarPuntos(Request $request, $id)
    {
        if ($this->acceso($request)) {
            $ma = new sendMail('nada', 'na');
            $correos = $ma->obtenerTodosCorreos($id);
            $a = new PuntoAgenda();

            $puntos = $a->obtenerPuntosPorEvento($id);
            $ma->listaPuntos = $puntos;
            Mail::to($correos)->send($ma->enviarCorreoPuntos());
            return Redirect::to('sesion');
        } else {
            return redirect::to('/login');
        }
    }

    public function edit(Request $request, $id)
    {
        if ($this->acceso($request)) {
            $sesion = new Sesion;
            $sesion = $sesion->buscar($id);
            $tipo_sesion = new Tipo_sesion();
            $tipo_sesion = $tipo_sesion->mostrar();
            $listaMiembros = $sesion->obtenerMiembrosConvocados((int) $id);

            return view("sesion.edit", ["sesion" => $sesion, 'tipo_sesion' => $tipo_sesion, "listaMiembros" => $listaMiembros]);
        } else {
            return redirect::to('/login');
        }
    }

    public function update(Request $request, $id)
    {
        if ($this->acceso($request)) {
            $events = [];
            $data = Event::all();

            $tipo_sesion = new Tipo_sesion();
            $tipo_sesion = $tipo_sesion->mostrar();

            if ($data->count()) {

                foreach ($data as $key => $value) {
                    $events[] = Calendar::event(
                        $tipo_sesion[0]->nombre,
                        false,
                        new DateTime($value->fecha . $value->hora),
                        new DateTime($value->fecha),
                        $value->id
                    );
                }
            }
            $calendar = Calendar::addEvents($events);

            $sesion = new Sesion;
            $listaMiembros = $sesion->obtenerMiembrosConvocados($id);
            $lista = []; //Va a estar todos los que están convocados y los que no, no hay problema.
            foreach ($request->get('values') as $value) {
                array_push($lista, (int) $value);
                echo $value . ", ";
            }

            foreach ($lista as $el) {
                echo ", " . $el;
            }

            $sesion->actualizarTodosMiembrosConvocados($id); //Pasa todos a no convocados
            $sesion->actualizarMiembrosConvocadosSi($id, $lista); //Pasa todos a convocados
            $sesion->actualizar($id, $request->get('tipo_sesion'), $request->get('fecha'), $request->get('hora'), $request->get('lugar'));

            $listaSesiones = $sesion->mostrar();
            return view('sesion.index', ['sesiones' => $listaSesiones], compact('calendar'));
        } else {
            return redirect::to('/login');
        }
    }

    public function destroy(Request $request, $id)
    {
        if ($this->acceso($request)) {
            $events = [];
            $data = Event::all();

            $tipo_sesion = new Tipo_sesion();
            $tipo_sesion = $tipo_sesion->mostrar();

            if ($data->count()) {

                foreach ($data as $key => $value) {
                    $events[] = Calendar::event(
                        $tipo_sesion[0]->nombre,
                        false,
                        new DateTime($value->fecha . $value->hora),
                        new DateTime($value->fecha),
                        $value->id
                    );
                }
            }
            $sesionO = new Sesion();
            $sesionO->eliminarPuntosEvento($id);
            $sesionO->eliminarMiembrosConvocados($id);
            $calendar = Calendar::addEvents($events);
            $sesion = Sesion::findOrFail($id);
            $sesion->delete();
            return redirect::to("sesion");
        } else {
            return redirect::to('/login');
        }
    }


    public function siguientePunto($id, Request $request)
    {
        if ($this->acceso($request)) {

            $sesion = new Sesion;
            $sesion = $sesion->buscar($id);
            $puntoActivo = (int) $sesion->punto_activo + 1;
            $puntos = PuntoAgenda::all();
            $largoPuntos = sizeof($puntos);
            if ($puntoActivo >= $largoPuntos) {
                return redirect::to("sesion/iniciar/" . $id);
            } else {
                $sesion->siguientePunto($id, $puntoActivo);
                return redirect::to("sesion/iniciar/" . $id);
            }
        } else {
            return redirect::to('/login');
        }
    }

    public function anteriorPunto($id, Request $request)
    {
        if ($this->acceso($request)) {
            $sesion = new Sesion;
            $sesion = $sesion->buscar($id);
            $puntoActivo = (int) $sesion->punto_activo - 1;
            if ($puntoActivo < 0) {
                return redirect::to("sesion/iniciar/" . $id);
            } else {
                $sesion->anteriorPunto($id, $puntoActivo);
                return redirect::to("sesion/iniciar/" . $id);
            }
        } else {
            return redirect::to('/login');
        }
    }

    public function crearListaInsertarAsistencia($listaMiembros, $idEvento)
    {
        $listaRetorno = [];
        foreach ($listaMiembros as $miembro) {
            $listaRetorno2 = [
                'id_usuario' => (int) $miembro->idmiembro,
                'id_evento' => $idEvento, 'estado' => 0
            ];
            array_push($listaRetorno, $listaRetorno2);
            //$listaRetorno = ['ideventoconvocado' => (int)$miembro->idmiembro];
        }
        return $listaRetorno;
    }

    public function verificarDiferencias($antes, $despues, $idEvento, Request $request)
    {
        $i = 0;
        $cambios = [];
        for ($i = 0; $i < sizeof($antes); $i++) {
            if ((int) $antes[$i]->estado != (int) $despues[$i]->estado) {
                array_push($cambios, $despues[$i]);
            }
        }
        $lista = [];
        for ($i = 0; $i < sizeof($cambios); $i++) {
            if ((int) $cambios[$i]->estado == 0) {
                //Salió
                array_push($lista, [
                    'descripcion' => 'El usuario ' . $cambios[$i]->nombremiembro . ' ' . $cambios[$i]->apellido1miembro . ' ' .  $cambios[$i]->apellido2miembro . ' salio del evento con id ' . $idEvento,
                    'identificadorusuario' => (int) $request->session()->get('id'), 'hora' => 'NOW()'
                ]);
            } else {
                //Entró
                array_push($lista, [
                    'descripcion' => 'El usuario ' . $cambios[$i]->nombremiembro . ' ' . $cambios[$i]->apellido1miembro . ' ' . $cambios[$i]->apellido2miembro . ' entro al evento con id ' . $idEvento,
                    'identificadorusuario' => (int) $request->session()->get('id'), 'hora' => 'NOW()'
                ]);
            }
        }

        $sesion = new Sesion();
        $sesion->insertarBitacora($lista);
        return $lista;
    }

    public function actualizarAsistencia(Request $request, $idEvento)
    {
        // $lista = [];//Va a estar todos los que están convocados, los que no no hay problema.
        // foreach ($request->get('values') as $value) {
        //     array_push($lista,(int)$value);

        // }
        // return $lista;
        $sesion = new Sesion();

        $cameraVideo = $request->input('values'); //Las que están en check
        $asistentes = $sesion->asistenciaPorEvento($idEvento);


        $sesion->actualizarMiembrosPresentesNo((int) $idEvento);
        $sesion->actualizarMiembrosPresentesSi((int) $idEvento, $cameraVideo);

        $asistentes2 = $sesion->asistenciaPorEvento($idEvento);

        $a = $this->verificarDiferencias($asistentes, $asistentes2, $idEvento, $request);


        // return $cameraVideo;
        //return $a;
        return redirect::to("sesion/iniciar/" . $idEvento);
    }

    public function iniciarSesion($id, Request $request)
    {
        if ($this->acceso($request)) {
            $sesion = new Sesion;
            $sesion2 = $sesion->buscar($id);
            $obPuntos = new PuntoAgenda();
            $puntos = $obPuntos->obtenerPuntosPorEvento($id);
            //$listaMiembrosConvocados = $sesion->obtenerMiembrosConvocados((int)$id);



            $asistentes = $sesion->asistenciaPorEvento($id);
            if (sizeof($asistentes) == 0) {
                //No se han insertado, es la primera vez que se ingresa
                $listaMiembrosConvocados = $sesion->obtenerMiembrosConvocados((int) $id); //Obteniendo los convocados
                $listaAsistencia = $this->crearListaInsertarAsistencia($listaMiembrosConvocados, $id); //Formar la lista para insertar
                $sesion->insertarAsistencia($listaAsistencia);
                $asistentes = $sesion->asistenciaPorEvento($id);
                $sesion->sesionInicioHoraActualizar($id);
            }
            //$asistentes = $sesion->asistenciaPorEvento($id);


            if (sizeof($puntos) > 0) {
                //$sesion->iniciarSesion($id);

                //$puntos = PuntoAgenda::all();
                $puntoActivo = (int) $sesion2->punto_activo;
                $largoPuntos = sizeof($puntos);
                $miembro = new Miembro();

                $votacion = $obPuntos->buscarVotacion($puntos[$puntoActivo]->id_punto);

                $valorConsultaVotacion = sizeof($votacion);


                //estaactivo
                $valorMandar = 0;
                if ($valorConsultaVotacion > 0) {
                    if ($votacion[0]->estaactivo == 0) {
                        $valorMandar = 1; //Está desactivada
                    }
                }



                $idPunto = (int) $puntos[$puntoActivo]->id_punto;
                $idMiembro = (int) $request->session()->get('id');
                $votosMiembro = sizeof($obPuntos->obtenerVotosUsuarioPunto($idPunto, $idMiembro));
                $listaMiembros = $miembro->buscar($puntos[$puntoActivo]->miembro)[0];
                $listaVotos = $obPuntos->obtenerVotos_Miembros($idPunto);
                // return $puntoActivo;
                $listaMiembrosConvocados = $sesion->obtenerMiembrosConvocados((int) $id);
                return view('sesion.inicioSesion', [
                    'sesion' => $sesion2, 'puntosAgenda' => $puntos, 'puntoActivo' => $puntoActivo, 'largoPuntos' => $largoPuntos, 'miembro' => $listaMiembros, 'votacionAbierta' => $valorConsultaVotacion, 'abierta' => $valorMandar, 'votacion' => $votacion,
                    'listaVotos' => $listaVotos, 'votosMiembro' => $votosMiembro, 'miembrosAsistentes' => $asistentes
                ]);
            } else {
                return Redirect::back()->with('puntos', 'The Message');
            }
            //return $puntos;
        } else {
            return redirect::to('/login');
        }
    }

    public function crearFile($idSesion)
    {

        $sesion = new Sesion;

        $sesion = $sesion->buscar($idSesion);
        $elemento = $sesion->mostrarFiltrado($idSesion);
        $horas = $sesion->obtenerHoraInicioFinEvento($idSesion);


        $asistentes = $sesion->asistenciaPorEvento($idSesion);

        $obPuntos = new PuntoAgenda();

        $puntos = $obPuntos->obtenerPuntosPorEvento($idSesion);

        //Con una plantilla

        $templateProcessor = new TemplateProcessor('files/Templates/Template.docx');


        $templateProcessor->setValue('HoraFinalizaSesion', (string) date('h:i a', strtotime($horas[0]->horafin)));
        $templateProcessor->setValue('horaInicioSesion', (string) date('h:i a', strtotime($horas[0]->horainicio)));


        $templateProcessor->setValue('dia', (string) date('d', strtotime($sesion->fecha)));
        $templateProcessor->setValue('mes', (string) date('M', strtotime($sesion->fecha)));
        $templateProcessor->setValue('hora', (string) date('h:i a', strtotime($sesion->hora)));
        $templateProcessor->setValue('anno', (string) date('Y', strtotime($sesion->fecha)));
        $templateProcessor->setValue('lugar', $sesion->lugar);

        $templateProcessor->setValue('TipoSesion', $elemento[0]->tipo);


        $asistentes = $sesion->asistenciaPorEvento($idSesion);

        $presidente = null;
        $secretario = null;
        $profesores = [];
        $estudiantes = [];

        $profesores2 = "";
        $estudiantes2 = "";

        foreach ($asistentes as $asistente) {
            if ((int) $asistente->idrole == 1) {
                //Presidente

                $templateProcessor->setValue('Presidente', "$asistente->nombremiembro $asistente->apellido1miembro $asistente->apellido2miembro");
            } else if ((int) $asistente->idrole == 2) {
                //Secretario

                $templateProcessor->setValue('Secretaria', "$asistente->nombremiembro $asistente->apellido1miembro $asistente->apellido2miembro");
            } else if ((int) $asistente->idrole == 3) {
                //Profesor

                array_push($profesores, $asistente);

                $profesores2 = $profesores2 . "$asistente->nombremiembro $asistente->apellido1miembro $asistente->apellido2miembro, ";
            } else if ((int) $asistente->idrole == 4) {
                //Estudiante
                array_push($estudiantes, $asistente);

                $estudiantes2 = $estudiantes2 . "$asistente->nombremiembro $asistente->apellido1miembro $asistente->apellido2miembro, ";
            }
        }
        $templateProcessor->cloneBlock('BDocentes', sizeof($profesores), true, true);

        $numero = 1;
        foreach ($profesores as $profesor) {
            $templateProcessor->setValue('Docentes#' . (string) $numero, "$numero. $profesor->nombremiembro $profesor->apellido1miembro $profesor->apellido2miembro");
            $numero++;
        }
        $numero = 1;
        $templateProcessor->cloneBlock('BEstudiantes', sizeof($estudiantes), true, true);
        foreach ($estudiantes as $estudiante) {
            $templateProcessor->setValue('Estudiantes#' . (string) $numero, "$numero. $estudiante->nombremiembro $estudiante->apellido1miembro $estudiante->apellido2miembro");
            $numero++;
        }


        $templateProcessor->cloneBlock('BPuntoAgendaAgenda', sizeof($puntos), true, true);
        $contadorPuntos = 1;

        foreach ($puntos as $punto) {
            $templateProcessor->setValue('Punto#' . (string) $contadorPuntos, "\t" . (string) $contadorPuntos . ". " . $punto->titulo);
            $contadorPuntos++;
        }



        $templateProcessor->setValue('cantidadPersonasPresentes', sizeof($asistentes));

        //Partes donde se especifica todo de los puntos

        $templateProcessor->cloneBlock('BloqueArticulo', sizeof($puntos), true, true);
        $contadorPuntos = 1;

        foreach ($puntos as $punto) {
            $templateProcessor->setValue('TituloArticulo#' . (string) $contadorPuntos, $punto->titulo);
            $templateProcessor->setValue('Considerando#' . (string) $contadorPuntos,  $punto->considerando);
            $templateProcessor->setValue('Acuerda#' . (string) $contadorPuntos,  $punto->acuerda);
            $templateProcessor->setValue('NumeroArticulo#' . (string) $contadorPuntos, (string) $contadorPuntos);
            $votacion = $obPuntos->buscarVotacion($punto->id_punto);
            if (sizeof($votacion) == 0) {
                $templateProcessor->setValue('VotosFavor#' . (string) $contadorPuntos, "N/A");
                $templateProcessor->setValue('VotosContra#' . (string) $contadorPuntos, "N/A");
                $templateProcessor->setValue('VotosAbstencion#' . (string) $contadorPuntos, "N/A");
            } else {
                $templateProcessor->setValue('VotosFavor#' . (string) $contadorPuntos, $votacion[0]->favor);
                $templateProcessor->setValue('VotosContra#' . (string) $contadorPuntos, $votacion[0]->contra);
                $templateProcessor->setValue('VotosAbstencion#' . (string) $contadorPuntos, $votacion[0]->abstinencia);
            }
            $contadorPuntos++;
        }



        /*$templateProcessor->setValue('dia', (string)date('d',strtotime($sesion->fecha)));
        $templateProcessor->setValue('mes', (string)date('M',strtotime($sesion->fecha)));
        $templateProcessor->setValue('hora', (string)date('h:i a',strtotime($sesion->hora)));
        $templateProcessor->setValue('anno', (string)date('Y',strtotime($sesion->fecha)));*/

        $nombreArchivo = 'files/' . $elemento[0]->tipo . '__' . (string) date('M-d-Y__', strtotime($sesion->fecha)) . (string) date('h-i', strtotime($sesion->hora)) . '.docx';

        $sesion->modificarNombreArchivo($idSesion, $nombreArchivo);

        $templateProcessor->saveAs($nombreArchivo);
    }

    public function cerrarSesion($idSesion, Request $request)
    {
        if ($this->acceso($request)) {

            $sesion = new Sesion();
            $sesion->sesionFinHoraActualizar($idSesion);
            $this->crearFile($idSesion);

            // return 445;
            $sesion = new Sesion;
            $sesion->cerrarSesion($idSesion);
            return redirect::to("sesion");
        } else {
            return redirect::to('/login');
        }
    }

    public function iniciarVotacion($idSesion, Request $request)
    {
        if ($this->acceso($request)) {

            $sesion = new Sesion;
            $sesion = $sesion->buscar($idSesion);
            $obPuntos = new PuntoAgenda();
            $puntos = $obPuntos->obtenerPuntosPorEvento($idSesion);

            //$puntos = PuntoAgenda::all();
            $puntoActivo = (int) $sesion->punto_activo;
            $largoPuntos = sizeof($puntos);
            $idPunto = (int) $puntos[$puntoActivo]->id_punto;

            $obPuntos->iniciarVotacion($idPunto);
            return redirect::to("sesion/iniciar/" . $idSesion);
        } else {
            return redirect::to('/login');
        }
    }

    public function cerrarVotacion($idSesion, Request $request)
    {
        if ($this->acceso($request)) {
            $sesion = new Sesion;
            $sesion = $sesion->buscar($idSesion);
            $obPuntos = new PuntoAgenda();
            $puntos = $obPuntos->obtenerPuntosPorEvento($idSesion);

            //$puntos = PuntoAgenda::all();
            $puntoActivo = (int) $sesion->punto_activo;
            $largoPuntos = sizeof($puntos);
            $idPunto = (int) $puntos[$puntoActivo]->id_punto;

            $obPuntos->cerrarVotacion($idPunto);
            return redirect::to("sesion/iniciar/" . $idSesion);
        } else {
            return redirect::to('/login');
        }
    }

    public function favorPunto($idSesion, Request $request)
    {
        if ($this->acceso($request)) {
            $sesion = new Sesion;
            $sesion = $sesion->buscar($idSesion);
            $obPuntos = new PuntoAgenda();
            $puntos = $obPuntos->obtenerPuntosPorEvento($idSesion);

            //$puntos = PuntoAgenda::all();
            $puntoActivo = (int) $sesion->punto_activo;
            $largoPuntos = sizeof($puntos);
            $idPunto = (int) $puntos[$puntoActivo]->id_punto;

            //$usuario = (int)$request->session()->get('id');
            $obPuntos->votoFavor($idPunto);

            $usuario = (int) $request->session()->get('id');
            $obPuntos->votoFavor_Miembro($idPunto, $usuario);
            return redirect::to("sesion/iniciar/" . $idSesion);
            //return 55;
        } else {
            return redirect::to('/login');
        }
    }

    public function contraPunto($idSesion, Request $request)
    {
        if ($this->acceso($request)) {
            $usuario = (int) $request->session()->get('id');
            $sesion = new Sesion;
            $sesion = $sesion->buscar($idSesion);
            $obPuntos = new PuntoAgenda();
            $puntos = $obPuntos->obtenerPuntosPorEvento($idSesion);

            //$puntos = PuntoAgenda::all();
            $puntoActivo = (int) $sesion->punto_activo;
            $largoPuntos = sizeof($puntos);
            $idPunto = (int) $puntos[$puntoActivo]->id_punto;
            $obPuntos->votoContra($idPunto);
            $usuario = (int) $request->session()->get('id');
            $obPuntos->votoContra_Miembro($idPunto, $usuario);

            return redirect::to("sesion/iniciar/" . $idSesion);
            //   return "Contra<br>Punto: " . $idPunto . "<br>" . "Usuario: " . $usuario;
        } else {
            return redirect::to('/login');
        }
    }

    public function abstenerPunto($idSesion, Request $request)
    {
        if ($this->acceso($request)) {
            $sesion = new Sesion;
            $sesion = $sesion->buscar($idSesion);
            $obPuntos = new PuntoAgenda();
            $puntos = $obPuntos->obtenerPuntosPorEvento($idSesion);

            //$puntos = PuntoAgenda::all();
            $puntoActivo = (int) $sesion->punto_activo;
            $largoPuntos = sizeof($puntos);
            $idPunto = (int) $puntos[$puntoActivo]->id_punto;

            $obPuntos->votoAbstinencia($idPunto);
            $usuario = (int) $request->session()->get('id');
            $obPuntos->votoAbstinencia_Miembro($idPunto, $usuario);

            return redirect::to("sesion/iniciar/" . $idSesion);
            //return "Abstener<br>Punto: " . $idPunto . "<br>" . "Usuario: " . $usuario;
        } else {
            return redirect::to('/login');
        }
    }


    public function favorPuntoPrivado($idSesion, Request $request)
    {
        if ($this->acceso($request)) {
            $sesion = new Sesion;
            $sesion = $sesion->buscar($idSesion);
            $obPuntos = new PuntoAgenda();
            $puntos = $obPuntos->obtenerPuntosPorEvento($idSesion);

            //$puntos = PuntoAgenda::all();
            $puntoActivo = (int) $sesion->punto_activo;
            $largoPuntos = sizeof($puntos);
            $idPunto = (int) $puntos[$puntoActivo]->id_punto;

            //$usuario = (int)$request->session()->get('id');
            $obPuntos->votoFavor($idPunto);

            $usuario = (int) $request->session()->get('id');
            $obPuntos->votoPrivado_Miembro($idPunto, $usuario);
            return redirect::to("sesion/iniciar/" . $idSesion);
            //return 55;
        } else {
            return redirect::to('/login');
        }
    }

    public function contraPuntoPrivado($idSesion, Request $request)
    {
        if ($this->acceso($request)) {
            $usuario = (int) $request->session()->get('id');
            $sesion = new Sesion;
            $sesion = $sesion->buscar($idSesion);
            $obPuntos = new PuntoAgenda();
            $puntos = $obPuntos->obtenerPuntosPorEvento($idSesion);

            //$puntos = PuntoAgenda::all();
            $puntoActivo = (int) $sesion->punto_activo;
            $largoPuntos = sizeof($puntos);
            $idPunto = (int) $puntos[$puntoActivo]->id_punto;
            $obPuntos->votoContra($idPunto);
            $usuario = (int) $request->session()->get('id');
            $obPuntos->votoPrivado_Miembro($idPunto, $usuario);

            return redirect::to("sesion/iniciar/" . $idSesion);
            //   return "Contra<br>Punto: " . $idPunto . "<br>" . "Usuario: " . $usuario;
        } else {
            return redirect::to('/login');
        }
    }

    public function abstenerPuntoPrivado($idSesion, Request $request)
    {
        if ($this->acceso($request)) {
            $sesion = new Sesion;
            $sesion = $sesion->buscar($idSesion);
            $obPuntos = new PuntoAgenda();
            $puntos = $obPuntos->obtenerPuntosPorEvento($idSesion);

            //$puntos = PuntoAgenda::all();
            $puntoActivo = (int) $sesion->punto_activo;
            $largoPuntos = sizeof($puntos);
            $idPunto = (int) $puntos[$puntoActivo]->id_punto;

            $obPuntos->votoAbstinencia($idPunto);
            $usuario = (int) $request->session()->get('id');
            $obPuntos->votoPrivado_Miembro($idPunto, $usuario);

            return redirect::to("sesion/iniciar/" . $idSesion);
            //return "Abstener<br>Punto: " . $idPunto . "<br>" . "Usuario: " . $usuario;
        } else {
            return redirect::to('/login');
        }
    }















    public function reiniciarVotacion($idSesion, Request $request)
    {
        if ($this->acceso($request)) {
            $sesion = new Sesion;
            $sesion = $sesion->buscar($idSesion);
            $obPuntos = new PuntoAgenda();
            $puntos = $obPuntos->obtenerPuntosPorEvento($idSesion);

            //$puntos = PuntoAgenda::all();
            $puntoActivo = (int) $sesion->punto_activo;
            $largoPuntos = sizeof($puntos);
            $idPunto = (int) $puntos[$puntoActivo]->id_punto;
            $obPuntos->reiniciarVotacion($idPunto);


            return redirect::to("sesion/iniciar/" . $idSesion);
        } else {
            return redirect::to('/login');
        }
    }


    public function favorPuntoApp(Request $request)
    {
        $obPuntos = new PuntoAgenda();

        $idPunto = (int) $request->id_punto;
        $obPuntos->votoFavor($idPunto);

        $usuario = (int) $request->id_usuario;
        $obPuntos->votoFavor_Miembro($idPunto, $usuario);
    }

    public function contraPuntoApp(Request $request)
    {
        $obPuntos = new PuntoAgenda();

        $idPunto = (int) $request->id_punto;
        $obPuntos->votoContra($idPunto);

        $usuario = (int) $request->id_usuario;
        $obPuntos->votoContra_Miembro($idPunto, $usuario);
    }

    public function abstenerPuntoApp(Request $request)
    {
        $obPuntos = new PuntoAgenda();

        $idPunto = (int) $request->id_punto;
        $obPuntos->votoAbstinencia($idPunto);

        $usuario = (int) $request->id_usuario;
        $obPuntos->votoAbstinencia_Miembro($idPunto, $usuario);
    }

    public function showFiles()
    {
        return Storage::url('prueba.txt');
    }
}
