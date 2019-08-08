<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modalAsistencia-asistencia-{{$sesion->id}}">

    {{Form::Open(array('action'=>array('SesionController@actualizarAsistencia',$sesion->id), 'method'=>'post'))}}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title">Asistencia al Consejo del día <u>{{date('d M, Y',strtotime($sesion->fecha))}}</u> en <u>{{$sesion->lugar}}</u></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">x</span>
                </button>
            </div>

            <div class="modal-body">
                
                


                
                
                @foreach($miembrosAsistentes as $miembro)
                    
                    @if((int)$miembro->estado == 1)
                        <input type="checkbox" name="values[]" class="values" value="{{$miembro->id_asistencia_a_evento}}" checked> {{$miembro->nombremiembro}} {{$miembro->apellido1miembro}} {{$miembro->apellido2miembro}}
                    @else
                        <input type="checkbox" name="values[]" class="values" value="{{$miembro->id_asistencia_a_evento}}" > {{$miembro->nombremiembro}} {{$miembro->apellido1miembro}} {{$miembro->apellido2miembro}}
                    @endif
                    <br>

                @endforeach
            </div>
            
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" >Confirmar</button>
                <a class="btn btn-light"  data-dismiss="modal" style="background-color: #6C8EF1;">Cancelar</a>
            </div>            
        </div>
    </div>

    {{Form::Close()}}
    
</div>