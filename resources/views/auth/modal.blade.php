<div class="modal fade modal-slide-in-right" aria-hidden="false" role="dialog" id="modal-firma">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(247, 247, 247);">
                <h4 class="modal-title">Firma Digital</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body" style="text-align: center;">
                <!-- Aquí está el código de la Firma Digital -->
                <div id="overlay" class="modalDialog">
                    <div>
                        <a onclick="overlay();" title="Cerrar" class="close">X</a>
                        <h3>Autenticación</h3>
                        <div id="divSmartCard">
                            Por favor seleccione el certificado:
                            <div id="divSmartCardCerts"></div>
                        </div>
                        <br><br>
                        <label>Pin:</label>
                        <input id="pin" type="password" onkeypress="Javascript: if (event.which == 13 || event.keyCode == 13) getDN();"/>
                        <button onclick="getDN();">Validar</button>
                        <button onclick="overlay();">Cerrar</button>
                    </div>
                </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/Firma Digital/componente.js')}}"></script>
<script src="{{ asset('js/Firma Digital/autenticacion.js')}}"></script>
<script src="{{ asset('js/Firma Digital/firma.js')}}"></script>
<script src="{{ asset('js/Firma Digital/jquery-3.2.1.min.js')}}"></script>
<script src="{{ asset('js/Firma Digital/modal.js')}}"></script>
