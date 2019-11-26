@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Puntos de agenda propuestos</h4>
                <p class="card-description"> Lista de puntos de agenda propuestos </p>
                <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Título
                          </th>
                          <th>
                            Agregado
                          </th>
                          <th>
                            Miembro
                          </th>
                          <th>
                            Sesión
                          </th>
                          <th>
                            Acciones
                          </th>
                        </tr>
                      </thead>
                        <tbody>
                            @foreach($puntosPropuestos as $p) 
                                <tr>
                                    <td>
                                      <?php
                                      if(strlen($p->titulo) > 50){
                                        echo substr($p->titulo, 0, 60) . '...';
                                      }
                                      else{
                                        echo $p->titulo;
                                      }
                                      ?>
                                    </td>
                                    <td>
                                        {{$p->fecha->format('d/m/y')}}
                                    </td>
                                    <td>
                                        {{$p->miembro}}
                                    </td>
                                    <td>
                                        {{$p->punto_para_agenda}}
                                    </td>
                                    <td class = "center">
                                        <a href="" data-target="#modal-show-punto-{{$p->id_punto}}" data-toggle="modal"><strong>Ver más</strong></a>
                                    </td>
                                    @if($p->miembro == 'Marco Lucio')
                                      <td class = "center">
                                        <a href="" data-target="#modal-delete-punto-{{$p->id_punto}}" data-toggle="modal" style="color:red"><strong>Eliminar</strong></a>
                                      </td>
                                    @endif
                                </tr>
                            @include('puntoAgenda.modalShow')
                            @include('puntoAgenda.modalDelete')
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
