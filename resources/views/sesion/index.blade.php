@extends('layouts.app')

@section('content')
<html lang="en">
<head>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
</head>
<body>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Sesiones de consejo</h4>
                    <p class="card-description">
                        Lista de sesiones de consejo programadas
                    </p>
                    @if (\Session::has('puntos'))

                    <div class="alert alert-danger">
                        El consejo no tiene puntos.
                    </div>

                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>
                                Tipo
                            </th>
                            <th>
                                Fecha
                            </th>
                            <th>
                                Hora
                            </th>
                            <th>
                                Lugar
                            </th>
                            @if(Auth::permisoIniciarSesion())
                            <th>
                                Acciones
                            </th>
                            @else
                            <th>
                                Acciones
                            </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sesiones as $sesion)
                        @if($sesion->estaactivo<2)
                        <tr>
                            <td>
                                {{$sesion->tipo}}
                            </td>
                            <td>
                                {{date('d M, Y',strtotime($sesion->fecha))}}
                            </td>
                            <td>
                                {{date('H:i',strtotime($sesion->hora))}}
                            </td>
                            <td>
                                {{$sesion->lugar}}
                            </td>
                            @if(Auth::permisoIniciarSesion())
                            @if($sesion->estaactivo==0)
                            <td class="center" >
                                <a href="{{action('SesionController@iniciarSesion',$sesion->id)}}"><strong>Iniciar</strong></a>
                            </td>
                            @else
                            <td class="center" >
                                <a href="{{action('SesionController@iniciarSesion',$sesion->id)}}"><strong>Continuar</strong></a>
                            </td>
                            @endif

                            <td class="center">
                                <a href="{{action('SesionController@edit',$sesion->id)}}"><strong style="color:green">Editar</strong></a>
                            </td>

                            <td class="center">
                                <a href="" data-target="#modal-delete-{{$sesion->id}}" data-toggle="modal"><strong style="color:red">Eliminar</strong></a>
                            </td>
                            <td class="center">
                                <a href="{{action('SesionController@enviarPuntos',$sesion->id)}}"><strong>Convocar</strong></a>
                            </td>
                            <td class="center">
                                <a href="{{action('PuntoAgendaController@crearActa')}}" target="_blank"><strong>Acta(PDF)</strong></a>
                            </td>
                            <td class="center">
                                <a id="descargar-acta" href="javascript:void(0)" onclick="load()"><strong>Acta(.docx)</strong></a>
                                <!-- <input type="submit" id="myButton" value="Acta(.docx)"/> -->
                            </td>
                            @else
                            <td class="center" >
                                <a href="{{action('SesionController@iniciarSesion',$sesion->id)}}"><strong>Ingresar</strong></a>
                            </td>
                            @endif
                        </tr>
                        @endif
                        @include('sesion.modal')
                        @endforeach


                    </tbody>
                </table>


            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Sesiones
        </div>
        <div class="panel-body" >
            {!! $calendar->calendar() !!}
            {!! $calendar->script() !!}
        </div>
    </div>
</div>

</div>
<div class="acta" style="display: none;" id="acta" ></div>

<script>

    var tags = document.getElementsByClassName('fc-day');

    function inicio() {

        // Al presionar una fecha en el calendario, esta función detecta cual 
        // fecha fue presionada y la envía para realizar la inserción. 
        function eventos(){

            // Permite obtener la fecha del calendario y enviarlo por parámetro 
            // a la función para que pueda almacenarlo en la fecha solicitada. 
            var fecha = this.getAttribute("data-date");

            // Aquí hace el envío de la fecha. 
            window.location.href = "/sesion/create?fecha=" + fecha;
        }

        for(i = 0; tags.length; i++){
            tags[i].onclick = eventos;
        }
    }

    window.addEventListener('click', inicio, false);

</script>
<script>
    async function load(){
        $('#acta').load("http://localhost:8000/acta");
        await sleep(1000);
        wordParser();
    }
    function wordParser(){
        $('#acta').wordExport("Acta");
    }
    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }
</script>
</body>
</html>

@endsection


<!doctype html>



