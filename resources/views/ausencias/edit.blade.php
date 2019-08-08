@extends('layouts.app')

@section('content')
<div class="row">
	<!-- <div class="col-md-6"></div> -->
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
              <h4 class="card-title">Editar ausencia</h4>
              <p class="card-description">
	                Edición de una ausencia
	              </p>
					{!!Form::open(array('url' => 'ausenciaActualizar', 'method' => 'post', 'autocomplete' => 'off')) !!}
						@foreach($ausencias as $ausencia)
							<div class="form-group row" hidden="hidden">
								<label for="id" class="col-sm-12 col-form-label labels">Id</label>
									<input type="text" name="id" class="form-control" placeholder="Id..." id="id" value="{{$ausencia->idausencia}}">
							</div>

							<div class="form-group row">
								<label for="motivo" class="col-sm-12 col-form-label labels">Motivo</label>
									<input type="text" name="motivo" class="form-control" placeholder="Motivo..." id="motivo" value="{{$ausencia->motivo}}">
							</div>

							<div class="form-group row">
								<label for="fechaI" class="col-sm-12 col-form-label labels">Fecha Inicio</label>
								<input type="date" name="fechaI" class="form-control" id="fechaI" value="{{$ausencia->fechainicio}}">
							</div>

							<div class="form-group row">
								<label for="fechaF" class="col-sm-12 col-form-label labels">Fecha Final</label>
								<input type="date" name="fechaF" class="form-control" id="fechaF" value="{{$ausencia->fechafin}}">
							</div>
						@endforeach

						

						


						<p class="btnSubmitP"><input type="submit" value="Aceptar" class="btn btn-primary mr-2"/></p>
						<p class="btnSubmitP"><a class="btn btn-light"  href="{{url('ausencias')}}">Cancelar</a></p>
					{!! Form::close() !!}
			</div>
		</div>
	</div>
</div> <!--Hasta aquí-->

@endsection
