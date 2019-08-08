@extends('layouts.app')

@section('content')
<div class="row">
	<!-- <div class="col-md-6"></div> -->
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
              <h4 class="card-title">{{$miembro[0]->nombremiembro}} {{$miembro[0]->apellido1miembro}} {{$miembro[0]->apellido2miembro}}</h4>
              <p class="card-description">
	                Actualizar Perfil
	              </p>
	              	{!!Form::open(array('url' => 'perfil/update', 'method' => 'POST', 'autocomplete' => 'off')) !!}
						

						<div class="form-group row" hidden="hidden">
							<label for="identificacion" class="col-sm-12 col-form-label labels" hidden="hidden">ID</label>
							<!-- <div class="col-sm-9"> -->
								<input type="text" name="ident" class="form-control" placeholder="Su Nombre..." id="identificacion" value="{{$miembro[0]->idmiembro}}" readonly="readonly">
							<!-- </div> -->
						</div>

						<div class="form-group row">
							<label for="fname" class="col-sm-12 col-form-label labels" >Nombre</label>
							
								<input type="text" name="nombre" class="form-control" value="{{$miembro[0]->nombremiembro}}" placeholder="Su Nombre..." id="fname">
							
						</div>
						

						<div class="form-group row">

							<label for="flname" class="col-sm-12 col-form-label labels">Primer Apellido</label>
							<input type="text" name="primerApellido" class="form-control"  value="{{$miembro[0]->apellido1miembro}}" placeholder="Su Primer apellido..." id="flname">
						</div>

						<div class="form-group row">

							<label for="slname" class="col-sm-12 col-form-label labels">Segundo Apellido</label>
							<input type="text" name="segundoApellido" class="form-control" value="{{$miembro[0]->apellido2miembro}}" placeholder="Su Segundo apellido..." id="slname">
						</div>

						<div class="form-group row">

							<label for="correoN" class="col-sm-12 col-form-label labels">Nuevo correo</label>
							<input type="text" name="correoN" class="form-control" placeholder="Nuevo correo..." id="correoN">
						</div>

						<div class="form-group row">
							<table class="table table-striped"  style="border:2px solid #9DA4B8;">
		                    	<thead style="border:2px solid #5FB0DB;">
									<tr style="text-align: center;">
										<th>Correos Registrados</th>
										<th>Acción</th>
										
									</tr>
								</thead>
								<tbody style="text-align: center;">
									<tr>
										<td style="border:2px solid #9DA4B8;">
											{{$miembro[0]->correo}} 
										</td>
										<td style="border:2px solid #9DA4B8;text-align: center;">
											N/A 
										</td>
										
									@foreach($correos as $correo)
										<tr>
											<td style="border:2px solid #9DA4B8;">
												{{$correo->correo}} 
											</td>
											<td style="border:2px solid #9DA4B8;text-align: center;">
												<a style="padding-left: 10%;" data-toggle="modal" href="#modalCorreo-delete-{{$correo->id_correo_registrado}}"><i title="Eliminar" class='fas fa-trash-alt' style="font-size: 160%;"></i></a>
											</td>
										</tr>
									@include('members.modalCorreo')
									@endforeach
								</tbody>
							</table>
						</div>
						<p class="btnSubmitP"><input type="submit" value="Actualizar" class="btn btn-primary mr-2"/></p>

					{!! Form::close() !!}

						

						

						


						
			</div>
		</div>
	</div>
</div> <!--Hasta aquí-->
@endsection
