@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
              <h4 class="card-title">Nueva sesión</h4>
              <p class="card-description">
                Programación de una nueva sesión de consejo
              </p>

              <!-- Aquí se abre el Form del calendario, la fecha la permite obtener con 
                   JavaScript con el método de PHP: $_GET. -->
              {!!Form::open(array('url' => 'sesion?fecha='. $_GET["fecha"], 'method' => 'POST', 'autocomplete' => 'off')) !!}
                <div class="form-group row">
                    <label for="tipo_sesion" class="col-sm-3 col-form-label">Tipo de sesión</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="tipo_sesion" name="tipo_sesion" parsley-trigger="change">
                            @foreach($tipo_sesion as $tipo)
                                <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!--<div class="form-group row">
                  <label for="fecha" class="col-sm-3 col-form-label">Fecha</label>
                  <div class="col-sm-9">
                    <input id="fecha" name="fecha" type="date" class="form-control" placeholder="dd/mm/aaaa" parsley-trigger="change"/>
                  </div>
                </div>
                -->
                <div class="form-group row">
                  <label for="hora" class="col-sm-3 col-form-label">Hora</label>
                  <div class="col-sm-9">
                    <input id="hora" name="hora" type="time" class="form-control" parsley-trigger="change">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="lugar" class="col-sm-3 col-form-label">Lugar</label>
                  <div class="col-sm-9">
                    <input type="text" name="lugar" class="form-control" id="lugar" placeholder="Lugar" parsley-trigger="change">
                  </div>
                </div>                
                <button type="submit" class="btn btn-primary mr-2">Programar</button>
                <a class="btn btn-light"  href="{{url('sesion')}}">Cancelar</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
