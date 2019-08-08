@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
              <h4 class="card-title">Editar sesión</h4>
              <p class="card-description">
                Edición de la sesión de consejo
              </p>
              {!!Form::model($sesion, ['method'=>'PATCH', 'route'=>['sesion.update',$sesion->id]]) !!}
                {{Form::token()}}     
                <div class="form-group row">
                    <label for="tipo_sesion" class="col-sm-3 col-form-label">Tipo de sesión</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="tipo_sesion" name="tipo_sesion" parsley-trigger="change">
                            @foreach($tipo_sesion as $tipo)
                                <option value="{{$tipo->id}}" default="{{$sesion->tipo_sesion}}">{{$tipo->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                  <label for="fecha" class="col-sm-3 col-form-label">Fecha</label>
                  <div class="col-sm-9">
                    <input id="fecha" name="fecha" type="date" class="form-control" placeholder="dd/mm/aaaa" parsley-trigger="change" value="{{$sesion->fecha}}"/>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="hora" class="col-sm-3 col-form-label">Hora</label>
                  <div class="col-sm-9">
                    <input id="hora" name="hora" type="time" class="form-control" parsley-trigger="change" value="{{$sesion->hora}}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="lugar" class="col-sm-3 col-form-label">Lugar</label>
                  <div class="col-sm-9">
                    <input type="text" name="lugar" class="form-control" id="lugar" placeholder="Lugar" parsley-trigger="change" value="{{$sesion->lugar}}">
                  </div>
                </div>                
                <div class="form-group row">
                <label for="convocados" class="col-sm-12 col-form-label">Convocados:</label>
                @foreach($listaMiembros as $miembro)
                  @if((int)$miembro->convocado == 1)
                  <div class="col-sm-9">
                    <input type="checkbox" name="values[]" value="{{$miembro->idmiembro}}" checked> {{$miembro->apellido1miembro}} {{$miembro->nombremiembro}}
</div>
                  @endif
                  @if((int)$miembro->convocado == 0)
                <div class="form-group row">
                    <input type="checkbox" name="values[]" value="{{$miembro->idmiembro}}" > {{$miembro->apellido1miembro}} {{$miembro->nombremiembro}}
</div>
                  @endif
                @endforeach
                </div>
                <button type="agregar" class="btn btn-primary mr-2">Actualizar</button>
                <button class="btn btn-light"  href="{{url('sesion')}}">Cancelar</button><br>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
