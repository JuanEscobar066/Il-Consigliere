@extends('layouts.app')

@section('content')
<div class="row">
	<!-- <div class="col-md-6"></div> -->
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
              <h4 class="card-title">Nuevo usuario</h4>
              <p class="card-description">
	                Creación de un usuario
	              </p>
					{!!Form::open(array('url' => 'miembro', 'method' => 'POST', 'autocomplete' => 'off')) !!}
						<div class="form-group row">
							<label for="fname" class="col-sm-12 col-form-label labels">Nombre</label>
							
								<input type="text" name="nombre" class="form-control" placeholder="Su Nombre..." id="fname">
							
						</div>
						

						<div class="form-group row">

							<label for="flname" class="col-sm-12 col-form-label labels">Primer Apellido</label>
							<input type="text" name="primerApellido" class="form-control" placeholder="Su Primer apellido..." id="flname">
						</div>

						<div class="form-group row">

							<label for="slname" class="col-sm-12 col-form-label labels">Segundo Apellido</label>
							<input type="text" name="segundoApellido" class="form-control" placeholder="Su Segundo apellido..." id="slname">
						</div>

						<div class="form-group row">

							<label for="mail" class="col-sm-12 col-form-label labels">Correo</label>
							<input type="text" name="correo" class="form-control" placeholder="Su Correo.." id="mail">
						</div>

						<div class="form-group row">

							<label for="passw" class="col-sm-12 col-form-label labels">Contraseña</label>
							<input type="password" name="contrasenna" class="form-control" placeholder="Su Contraseña..." id="passw">

						</div>

						<div class="form-group row">

							<label for="passw2" class="col-sm-12 col-form-label labels">Contraseña nuevamente</label>
							<input type="password" name="contrasenna2" class="form-control" placeholder="Su contraseña..." id="passw2">
						</div>

						<div class="form-group row">

						<label class="col-sm-12 col-form-label labels">Rol</label>
							<select name="ocupacionS" class="form-control">
								@foreach($roles as $role)
									<option value="{{$role->idrole}}">{{$role->descripcionrole}}</option>
								@endforeach
							</select>
						</div>


						<p class="btnSubmitP"><input type="submit" value="Aceptar" class="btn btn-primary mr-2"/></p>
						<p class="btnSubmitP"><a class="btn btn-light"  href="{{url('sesion')}}">Cancelar</a></p>
					{!! Form::close() !!}
			</div>
		</div>
	</div>
</div> <!--Hasta aquí-->
@endsection
