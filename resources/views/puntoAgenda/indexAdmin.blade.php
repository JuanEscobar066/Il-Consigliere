@extends('layouts.app')
@section('content')

            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Administración de puntos de agenda</h4>
                  <p class="card-description">
                    Puntos de agenda recibidos
                  </p>
                  <div class="row">
                    <div class="col-md-6">
                      <h6 class="card-title">Aceptados</h6>
                      <div id="dragula-event-left" class="py-2">
                        @foreach($puntosPropuestos as $p)
                        <div class="card rounded border mb-2">
                          <div class="card-body p-3">
                            <div class="media">
                              <i class="fas fa-check icon-sm text-primary align-self-center mr-3"></i>
                              <div class="media-body">
                                <h6 class="mb-1">{{$p->titulo}}</h6>
                                <p class="mb-0 text-muted">
                                  {{$p->fecha->format('d/m/y')}}
                                </p>
                                        <a href="" data-target="#modal-show-punto-{{$p->id_punto}}" data-toggle="modal"><strong>Ver más</strong></a>
                              </div>                              
                            </div> 
                          </div>
                        </div>
                        @include('puntoAgenda.modalShow')
                        @endforeach
                      </div>
                    </div>
                    <div class="col-md-6">
                      <h6 class="card-title mt-4 mt-md-0">Rechazados</h6>
                      <div id="dragula-event-right" class="py-2">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="../../../../vendors/js/vendor.bundle.base.js"></script>
  <script src="../../../../vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="../../../../js/off-canvas.js"></script>
  <script src="../../../../js/hoverable-collapse.js"></script>
  <script src="../../../../js/template.js"></script>
  <script src="../../../../js/settings.js"></script>
  <script src="../../../../js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->

<script src="../../../../js/dragula.js"></script>


@endsection
