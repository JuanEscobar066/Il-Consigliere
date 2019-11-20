@extends('layouts.app')

@section('content')
<html lang="en">

<head>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css" />
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
                                    <th>
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sesiones as $sesion)

                                @if($sesion->estaactivo < 2) <tr>

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
                                    <td class="center">
                                        <a href="{{action('SesionController@iniciarSesion',$sesion->id)}}"><strong>Iniciar</strong></a>
                                    </td>
                                    @else
                                    <td class="center">
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
                                    @else
                                    <td>
                                        <a href="{{action('SesionController@iniciarSesion',$sesion->id)}}" style="color:green"><strong>Ingresar</strong></a>
                                    </td>
                                    <td>
                                        <div class="dropdown show">
                                            <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <strong>Solicitud puntos</strong>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <input  class="pdfBase64" style="display: none;" id="solicitudPuntos-{{ $sesion->id }}" value="{{ (new App\Http\Controllers\PuntoAgendaController)->firmaSolicitudPuntos(request(), $sesion->id) }}"/>
                                                <a class="dropdown-item" href="{{action('PuntoAgendaController@solicitudPuntos',$sesion->id)}}" target="_blank">PDF</a>
                                                <a class="dropdown-item" data-toggle="modal" href="#modal-firma-{{ $sesion->id }}" onclick="smartCardCertificates({{ $sesion->id }});">Firmar PDF</a>
                                                <a id="descargar-acta" class="dropdown-item" href="javascript:void(0)" onclick="load('solicitud_puntos', 'documentoSolicitudPuntos/',{{$sesion->id}})">Editable</a>
                                            </div>
                                        </div>
                                    </td>
                                    @endif
                                    <td>
                                        <div class="dropdown show">
                                            <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <strong>Acta de Consejo</strong>
                                            </a>


                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" >
                                                <input class="pdfBase64" style="display: none;" id="actaConsejo-{{ $sesion->id }}" value="{{ (new App\Http\Controllers\PuntoAgendaController)->firmarActaDeConsejo($sesion->id) }}"/>
                                                <a class="dropdown-item" href="{{action('PuntoAgendaController@crearActa',$sesion->id)}}" target="_blank">PDF</a>
                                                <a class="dropdown-item" data-toggle="modal" href="#modal-firma-{{ $sesion->id }}" onclick="smartCardCertificates({{ $sesion->id }});">Firmar PDF</a>
                                                <a id="descargar-acta" class="dropdown-item" href="javascript:void(0)" onclick="load('acta', 'documentoActa/',{{$sesion->id}})">Editable</a>

                                            </div>
                                        </div>
                                    </td>
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
                <div class="panel-body">
                    {!! $calendar->calendar() !!}
                    {!! $calendar->script() !!}
                </div>
            </div>
        </div>

    </div>

    <!-- Aquí está el puente entre PHP y JavaScript para poder usar la misma variable -->
    <div class="acta" style="display: none;" id="acta"></div>
    <div class="solicitud_puntos" style="display: none;" id="solicitud_puntos"></div>
    <input  class="pdfBase64" style="display: none;" id="pdfBase64" value="{{session('pdfBase64')}}"/>


        <p>{{session('pdfBase64')}}</p>



    <script>
        var tags = document.getElementsByClassName('fc-day');

        function inicio() {

            // Al presionar una fecha en el calendario, esta función detecta cual
            // fecha fue presionada y la envía para realizar la inserción.
            function eventos() {

                // Permite obtener la fecha del calendario y enviarlo por parámetro
                // a la función para que pueda almacenarlo en la fecha solicitada.
                var fecha = this.getAttribute("data-date");

                // Aquí hace el envío de la fecha.
                window.location.href = "/sesion/create?fecha=" + fecha;
            }

            for (i = 0; tags.length; i++) {
                tags[i].onclick = eventos;
            }
        }

        window.addEventListener('click', inicio, false);
    </script>
    <script>
        async function load(archivo, tipoDocumento, idSesion) {
            $('#' + archivo).load("http://localhost:8000/sesion/" + tipoDocumento + idSesion);
            await sleep(1000);
            wordParser(archivo);
        }

        function wordParser(archivo) {
            var nombreArchivo;
            if (archivo == "acta") {
                nombreArchivo = "Acta de Consejo";
            } else {
                nombreArchivo = "Solicitud de puntos";
            }

            var html = document.getElementById(archivo).innerHTML;
            var blob = new Blob(['\ufeff', html], {
                type: 'application/msword'
            });

            // Specify link url
            var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);

            // Specify file name
            var filename = filename ? filename + '.doc' : nombreArchivo + '.doc';

            // Create download link element
            var downloadLink = document.createElement("a");

            document.body.appendChild(downloadLink);

            if (navigator.msSaveOrOpenBlob) {
                navigator.msSaveOrOpenBlob(blob, filename);
            } else {
                // Create a link to the file
                downloadLink.href = url;

                // Setting the file name
                downloadLink.download = filename;

                //triggering the function
                downloadLink.click();
            }

            document.body.removeChild(downloadLink);
        }

        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

    </script>
</body>

<!-- Los componentes de la Firma Digital. -->
<script type="text/javascript" src="{{ asset('js/FirmaDigital/jquery-3.2.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/FirmaDigital/componente.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/FirmaDigital/modal.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/FirmaDigital/autenticacion.js') }}"></script>

</html>

@endsection


<!doctype html>
