@extends('layouts.app')

@section('content')
<html lang="en">
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <!--!<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"><-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

    
</head>
<body>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">              
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Consejo del día {{date('d M, Y',strtotime($sesion->fecha))}} en {{$sesion->lugar}}</h4>
                <p class="card-description">
                Consejo
                </p>
                @if(Auth::permisoIniciarSesion())
                    <a class="btn btn-light" data-toggle="modal" href="#modalAsistencia-asistencia-{{$sesion->id}}">Control de Quorum</a>
                    @include('sesion.modalAsistencia')
                @endif
                

                
            </div>
        </div>
    </div>
  </div>  
    <!-- <div class="container" style="background-color: none;">
        <div class="panel panel-primary" style="background-color: none;"> -->
            
            <div class="row">
                <div class="col-lg-8 grid-margin stretch-card">              
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Consejo del día {{date('d M, Y',strtotime($sesion->fecha))}} en {{$sesion->lugar}}</h4>
                            <p class="card-description">
                            Punto número {{$puntoActivo+1}}
                            </p>
                            

                            <div class="row">
                                
                                <div class="col-lg-12" style="text-align: center;">
                                    

                                    <div class="form-group row" style="text-align: left;">

                                        <label for="flname" class="col-sm-12 col-form-label labels"><b>Titulo:</b> {{$puntosAgenda[$puntoActivo]->titulo}}</label>
                                        <label for="flname" class="col-sm-12 col-form-label labels"><b>Considerando: </b>{{$puntosAgenda[$puntoActivo]->considerando}}</label>
                                        <label for="flname" class="col-sm-12 col-form-label labels"><b>Acuerda:</b> {{$puntosAgenda[$puntoActivo]->acuerda}}</label>
                                        <label for="flname" class="col-sm-12 col-form-label labels"><b>Propuesto por:</b> {{$miembro->nombremiembro}} {{$miembro->apellido1miembro}} {{$miembro->apellido2miembro}}</label>
                                        @include('sesion.modalVotacion')

                                    </div>
                                </div>

                            </div>

                            @if($votacionAbierta==1)

                                <div class="row">

                                    <div class="col-lg-12" style="text-align: center;">
                                        <label for="flname" style="background-color: #88E565;" class="col-sm-3 col-form-label labels"><b>Favor: </b>{{$votacion[0]->favor}}</label>
                                        <label for="flname" style="background-color: #E88E7A;" class="col-sm-3 col-form-label labels"><b>Contra: </b>{{$votacion[0]->contra}}</label>
                                        <label for="flname" style="background-color: #82A379;" class="col-sm-3 col-form-label labels"><b>Abstención: </b>{{$votacion[0]->abstinencia}}</label>
                                    </div>

                                </div>
                            @endif


                            <div class="row">
                                <!-- 
                                    Manos: 
                                        derecha: <i class="fas fa-hand-point-right"></i>
                                        izquierda: <i class="fas fa-hand-point-left"></i>

                                    fechas:
                                        derecha: <i class="fas fa-arrow-right"></i>
                                        izquierda: <i class="fas fa-arrow-left"></i>
                                 -->
                                <div class="col-lg-12" style="text-align: center;">
                                    @if($puntoActivo>0 and Auth::permisoIniciarSesion() )
                                        <a class="btn btn-light" href="{{action('SesionController@anteriorPunto',$sesion->id)}}">
                                            <i class="fas fa-arrow-left" style="font-size: 100%;color:green;"></i>  Anterior
                                        </a>
                                    @endif
                                    @if($votacionAbierta==0 and Auth::permisoIniciarSesion())
                                        <a class="btn btn-light" data-toggle="modal" href="#modalTipoVotacion-{{$sesion->id}}">Iniciar Votacion</a>
                                    @else
                                        @if($abierta==0)
                                            @if(Auth::permisoIniciarSesion())
                                                <a class="btn btn-light" href="{{action('SesionController@cerrarVotacion',$sesion->id)}}">Cerrar Votacion</a>
                                            @else
                                                <a class="btn btn-light" data-toggle="modal" href="#modalVotacion-votacion-{{$sesion->id}}">Votar</a>

                                            @endif
                                            @if($votosMiembro==0 and Auth::permisoIniciarSesion())
                                                <a class="btn btn-light" data-toggle="modal" href="#modalVotacion-votacion-{{$sesion->id}}">Votar</a>
                                            @endif
                                        @else
                                            @if(Auth::permisoIniciarSesion())
                                                <a class="btn btn-light" href="{{action('SesionController@reiniciarVotacion',$sesion->id)}}">Reiniciar Votación</a>
                                                <a class="btn btn-light" data-toggle="modal" href="#modalVerVotos-votacion-{{$sesion->id}}">Ver Votaciones</a>
                                            @endif
                                        @endif
                                    @endif
                                    @if(Auth::permisoIniciarSesion())
                                        <a class="btn btn-light" href="">Moción</a>
                                    @endif
                                    @if($puntoActivo==($largoPuntos-1) and Auth::permisoIniciarSesion())
                                        <a class="btn btn-light" href="{{action('SesionController@cerrarSesion',$sesion->id)}}">Cerrar Consejo</a>
                                    @else
                                        @if(Auth::permisoIniciarSesion())
                                            <a class="btn btn-light" href="{{action('SesionController@siguientePunto',$sesion->id)}}">
                                            Siguiente  <i class="fas fa-arrow-right" style="font-size: 100%;color:green;"></i>
                                            </a>
                                        @endif
                                    @endif
                                    @include('sesion.modalVerVotos')
                                    @include('sesion.modalTipoVotacion')
                                    
                                </div>

                            </div>

                            
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 grid-margin stretch-card">              
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Puntos de agenda</h4>
                            <p class="card-description">
                            Lista de puntos
                            </p>
                            <ul>
                                @for($i=0;$i<$largoPuntos;$i++)
                                    <li>
                                        @if($puntoActivo == $i)
                                            <b>
                                                {{$puntosAgenda[$i]->titulo}}
                                            </b>
                                        @else
                                            {{$puntosAgenda[$i]->titulo}}
                                        
                                        @endif
                                    </li>        
                                @endfor
                            </ul>
                        </div>
                    </div>
                </div>

            </div>


        <!-- </div>
    </div> -->
    
<!-- </div> -->

</body>
</html>

@endsection


<!doctype html>



