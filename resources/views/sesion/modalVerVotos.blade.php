<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modalVerVotos-votacion-{{$sesion->id}}">

    <!-- {{Form::Open(array('action'=>array('SesionController@destroy', $puntosAgenda[$puntoActivo]->id_punto), 'method'=>'delete'))}} -->
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title">Votación del punto <u>{{$puntosAgenda[$puntoActivo]->titulo}}</u></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                @if(sizeof($listaVotos)>0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Voto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($listaVotos as $voto)
                                    <tr>
                                        <td>
                                            {{$voto->nombremiembro}} {{$voto->apellido1miembro}} {{$voto->apellido2miembro}}
                                        </td>
                                        <td>
                                            @if($voto->estado == 0)
                                                Favor
                                            @elseif ($voto->estado == 1)
                                                Contra
                                            @elseif ($voto->estado == 2)
                                                Abstención
                                            @elseif ($voto->estado == 3)
                                                Privado
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    No hay votaciones aún.
                @endif
            </div>
            <div class="modal-footer">
                <a class="btn btn-light"  data-dismiss="modal" style="background-color: #6C8EF1;">Aceptar</a>
            </div>            
        </div>
    </div>

    <!-- {{Form::Close()}} -->
</div>