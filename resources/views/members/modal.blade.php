<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$miembro->idmiembro}}">

    {{Form::Open(array('action'=>array('MiembroController@destroy', $miembro->idmiembro), 'method'=>'delete'))}}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title">Eliminar el usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body" style="text-align: center;">
                <p>¿Realmente desea eliminar el usuario?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" >Confirmar</button>
            </div>            
        </div>
    </div>

    {{Form::Close()}}
</div>