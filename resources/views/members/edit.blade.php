@extends('layouts.app')

@section('content')
<div class="row">
	<!-- <div class="col-md-6"></div> -->
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
              <h4 class="card-title">Actualizar usuario</h4>
              <p class="card-description">
	                Actualizar la información de un usuario
	              </p>
											{!!Form::open(array('url' => 'miembroActualizarDatos', 'method' => 'POST', 'autocomplete' => 'off')) !!}
											<!-- <form action="procesar.php" method="post"> -->
												


												<!-- <div class="form-group row">
													<label for="fecha" class="col-sm-3 col-form-label">Fecha</label>
													<div class="col-sm-9">
														<input id="fecha" name="fecha" type="date" class="form-control" placeholder="dd/mm/aaaa" parsley-trigger="change"/>
													</div>
												</div> -->
												@foreach($miembros as $miembro)
													<div class="form-group row" hidden="hidden">
														<label for="identificacion" class="col-sm-12 col-form-label labels" hidden="hidden">ID</label>
														<!-- <div class="col-sm-9"> -->
															<input type="text" name="ident" class="form-control" placeholder="Su Nombre..." id="identificacion" value="{{$miembro->idmiembro}}" readonly="readonly">
														<!-- </div> -->
													</div>

													<div class="form-group row">
														<label for="fname" class="col-sm-12 col-form-label labels">Nombre</label>
														<!-- <div class="col-sm-9"> -->
															<input type="text" name="nombre" class="form-control" placeholder="Su Nombre..." id="fname" value="{{$miembro->nombremiembro}}">
														<!-- </div> -->
													</div>
													

													<div class="form-group row">
					
														<label for="flname" class="col-sm-12 col-form-label labels">Apellido 1</label>
														<input type="text" name="primerApellido" class="form-control" placeholder="Su Primer apellido..." value="{{$miembro->apellido1miembro}}" id="flname">
													</div>

													<div class="form-group row">

														<label for="slname" class="col-sm-12 col-form-label labels">Segundo Apellido</label>
														<input type="text" name="segundoApellido" class="form-control" placeholder="Su Segundo apellido..." id="slname" value="{{$miembro->apellido2miembro}}">
													</div>

													<div class="form-group row">

														<label for="mail" class="col-sm-12 col-form-label labels">Correo</label>
														<input type="text" name="correo" class="form-control" placeholder="Su Correo.." id="mail" value="{{$miembro->correo}}">
													</div>

													<!-- <div class="form-group row">

														<label for="passw" class="col-sm-12 col-form-label labels">Contraseña</label>
														<input type="password" name="contrasenna" class="etrInsertar" placeholder="Su Contraseña..." id="passw">

													</div>

													<div class="form-group row">

														<label for="passw2" class="col-sm-12 col-form-label labels">Contraseña nuevamente</label>
														<input type="password" name="contrasenna2" class="etrInsertar" placeholder="Su contraseña..." id="passw2">
													</div> -->

													<div class="form-group row">

													<label class="col-sm-12 col-form-label labels">Rol</label>
														<select name="ocupacionS" class="form-control">
															@foreach($roles as $role)
																<option value="{{$role->idrole}}">{{$role->descripcionrole}}</option>
															@endforeach
														</select>
													</div>


													<p class="btnSubmitP"><input type="submit" value="Actualizar" class="btn btn-primary mr-2"/></p>
													<p class="btnSubmitP"><a class="btn btn-light"  href="{{url('miembro/show')}}">Cancelar</a></p>
												
												@endforeach
											<!-- </form> -->
											{!! Form::close() !!}
			</div>
		</div>
	</div>
</div> <!--Hasta aquí-->
@endsection
