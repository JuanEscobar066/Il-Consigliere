<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modalCorreo-delete-{{$correo->id_correo_registrado}}">

    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title">Eliminar el correo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body" style="text-align: center;">
                <p>¿Realmente desea eliminar el correo</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-light" href="{{action('MiembroController@eliminarCorreo',$correo->id_correo_registrado)}}" style="background-color: #82A379;">Confirmar</a>
            </div>            
        </div>
    </div>

    
</div>