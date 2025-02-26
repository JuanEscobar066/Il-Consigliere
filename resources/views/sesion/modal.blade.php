<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$sesion->id}}">

    {{Form::Open(array('action'=>array('SesionController@destroy', $sesion->id), 'method'=>'delete'))}}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Eliminar la sesión</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Realmente desea eliminar la sesión?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" >Confirmar</button>
            </div>
        </div>
    </div>

    {{Form::Close()}}
</div>

<!--
    Estos dos modals son los de la firma, esto está bien picha porque es el mismo código repoiado dos veces pero no
    se me ocurrió como putas decirle desde el index al modal que identifique que es el acta o la solicitud de puntos.
 -->
<div class="modal fade modal-slide-in-right" aria-hidden="false" role="dialog" id="modal-firmaSolicitudPuntos-{{$sesion->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(247, 247, 247);">
                <h4 class="modal-title">Firma Digital</h4>
            </div>
            <div class="modal-body" style="text-align: center;">

                <!-- Aquí está el código de la Firma Digital
                     No hay llamadas a los forms de Laravel porque se hace el llamado en el mismo JS.
                     Importante: las funciones de abajo, son funciones definidas en los 5 archivos
                     de JavaScript. -->
                <div id="overlay-solicitudPuntos-{{ $sesion->id }}" class="modalDialog">
                    <div class="form-group">
                        <h3>Autenticación</h3>
                        <div id="divSmartCard-solicitudPuntos{{ $sesion->id }}">
                            Por favor seleccione el certificado:
                            <div id="divSmartCardCerts-solicitudPuntos-{{ $sesion->id }}"></div>
                        </div>
                        <br><br>
                        <label>Pin:</label>
                        <input id="pinSolicitudPuntos-{{ $sesion->id }}" name="pin" type="password" class="form-control" onkeypress="Javascript: if (event.which == 13 || event.keyCode == 13) getDN();" />
                    </div>
                    <div class="form-group">
                        <button id="validar" name="validar" onclick="firmarPDF( {{ $sesion->id }}, 'puntos');" type="submit" class="btn btn-primary mr-2">Firmar</button>
                        <button id="cerrar" data-dismiss="modal" class="btn btn-light">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-slide-in-right" aria-hidden="false" role="dialog" id="modal-firmaActa-{{$sesion->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(247, 247, 247);">
                <h4 class="modal-title">Firma Digital</h4>
            </div>
            <div class="modal-body" style="text-align: center;">

                <!-- Aquí está el código de la Firma Digital
                     No hay llamadas a los forms de Laravel porque se hace el llamado en el mismo JS.
                     Importante: las funciones de abajo, son funciones definidas en los 5 archivos
                     de JavaScript. -->
                <div id="overlay-acta-{{ $sesion->id }}" class="modalDialog">
                    <div class="form-group">
                        <h3>Autenticación</h3>
                        <div id="divSmartCard-acta{{ $sesion->id }}">
                            Por favor seleccione el certificado:
                            <div id="divSmartCardCerts-acta-{{ $sesion->id }}"></div>
                        </div>
                        <br><br>
                        <label>Pin:</label>
                        <input id="pinActa-{{ $sesion->id }}" name="pin" type="password" class="form-control" onkeypress="Javascript: if (event.which == 13 || event.keyCode == 13) getDN();" />
                    </div>
                    <div class="form-group">
                        <button id="validar" name="validar" onclick="firmarPDF( {{ $sesion->id }}, 'acta' );" type="submit" class="btn btn-primary mr-2">Firmar</button>
                        <button id="cerrar" data-dismiss="modal" class="btn btn-light">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
