<div class="modal fade modal-slide-in-right" aria-hidden="false" role="dialog" id="modal-firma">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(247, 247, 247);">
                <h4 class="modal-title">Firma Digital</h4>
            </div>
            <div class="modal-body" style="text-align: center;">

                <!-- Aquí está el código de la Firma Digital -->
                <div id="overlay" class="modalDialog">
                    {!!Form::open(array('url' => 'login/firmaDigital', 'method' => 'POST', 'autocomplete' => 'off')) !!}
                    @csrf

                    <div class="form-group">
                        <h3>Autenticación</h3>
                        <div id="divSmartCard">
                            Por favor seleccione el certificado:
                            <div id="divSmartCardCerts"></div>
                        </div>
                        <br><br>
                        <label>Pin:</label>
                        <input id="pin" name="pin" type="password" class="form-control" onkeypress="Javascript: if (event.which == 13 || event.keyCode == 13) getDN();" />
                    </div>
                    <div class="form-group">
                        <button id="validar" name="validar" onclick="getDN();" type="submit" class="btn btn-primary mr-2">Validar</button>
                        <button data-dismiss="modal" class="btn btn-light">Cerrar</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>    
</div>