<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modalVotacion-votacion-{{$sesion->id}}">

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
                
                <label for="flname" class="col-sm-12 col-form-label labels"><b>Considerando: </b>{{$puntosAgenda[$puntoActivo]->considerando}}</label>
                <label for="flname" class="col-sm-12 col-form-label labels"><b>Acuerda:</b> {{$puntosAgenda[$puntoActivo]->acuerda}}</label>
                <label for="flname" class="col-sm-12 col-form-label labels"><b>Propuesto por:</b> {{$miembro->nombremiembro}} {{$miembro->apellido1miembro}} {{$miembro->apellido2miembro}}</label>
            </div>
            
            <!-- <input type="checkbox" id="chk_2" onclick="miFuncion(event);"><label>Marcar/Desmarcar</label> -->
            
            <div class="modal-footer" id="privado" style="display: none;text-align: center;">
                <a class="btn btn-light" href="{{action('SesionController@favorPuntoPrivado',$sesion->id)}}" style="background-color: #88E565;">Favor</a>
                <a class="btn btn-light" href="{{action('SesionController@contraPuntoPrivado',$sesion->id)}}" style="background-color: #E88E7A;">Contra</a>
                <a class="btn btn-light" href="{{action('SesionController@abstenerPuntoPrivado',$sesion->id)}}" style="background-color: #82A379;">Abstenerse</a>
            </div>
            <div class="modal-footer" id="publico" style="text-align: center;">
                <a class="btn btn-light" href="{{action('SesionController@favorPunto',$sesion->id)}}" style="background-color: #88E565;">Favor</a>
                <a class="btn btn-light" href="{{action('SesionController@contraPunto',$sesion->id)}}" style="background-color: #E88E7A;">Contra</a>
                <a class="btn btn-light" href="{{action('SesionController@abstenerPunto',$sesion->id)}}" style="background-color: #82A379;">Abstenerse</a>
            </div>
            <script type="text/javascript">
                function miFuncion(){
                    check = document.getElementById("privadoCh");
                    privado = document.getElementById("privado");
                    publico = document.getElementById("publico");
                    if (check.checked)
                    {

                        privado.style.display='block';
                        publico.style.display='none';
                        // $('#privado').removeAttr("hidden");
                        // $('#publico').attr('hidden', 'hidden');
                        // $('#privado').attr('style', 'display:block;');
                        // $('#publico').attr('style', 'display:none;');
                    }
                    else
                    {
                        publico.style.display='block';
                        privado.style.display='none';
                        // $('#publico').removeAttr("hidden");
                        // $('#privado').attr('style', 'display:none;');

                        // $('#privado').attr('style', 'display:none;');
                        // $('#publico').attr('style', 'display:block;');
                    }
                }//end function 
            </script>         
        </div>
    </div>

    <!-- {{Form::Close()}} -->
</div>
