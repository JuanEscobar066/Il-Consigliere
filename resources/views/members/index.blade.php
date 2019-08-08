<!--<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Visualizar Usuario</title>
		<link rel="stylesheet" type="text/css" href="css/style2.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	</head>
	<body>
		<div class="container-fluid">
			<div class="container">
					<table> -->
@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">              
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Usuarios registrados</h4>
                <p class="card-description">
                Usuarios registrados en la base de datos.
                </p>
                <div class="table-responsive">
                    <table class="table table-striped">
                    	<thead>
						<tr>
							<th>Nombre</th>
							<!-- <th>Apellido 1</th>
							<th>Apellido 2</th> -->
							<th>Correo</th>
							<th>Rol</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach($miembros as $miembro)
							<tr>
								<td>
									{{$miembro->nombremiembro}} {{$miembro->apellido1miembro}} {{$miembro->apellido2miembro}}
								<!-- </td>
								<td> 
									{{$miembro->apellido1miembro}}
								 </td>
								<td> 
									{{$miembro->apellido2miembro}}-->
								</td>
								<td>
									{{$miembro->correo}}
								</td>
								<td>
									{{$miembro->descripcionrole}}
								</td>
								<td>
									<a href="{{route('update', ['parameter' => $miembro->idmiembro])}}">
										<i title="Editar" class='fas fa-user-edit' style="font-size: 160%;"></i>
									</a>
									 <a style="padding-left: 10%;" data-toggle="modal" href="#modal-delete-{{$miembro->idmiembro}}">
										<i title="Eliminar" class='fas fa-user-times' style="font-size: 160%;"></i>
									</a>
									<!-- <a style="padding-left: 10%;" href="members.modal-{{$miembro->idmiembro}}">
										<i title="Eliminar" class='fas fa-user-times' style="font-size: 160%;color:Red;"></i>
									</a> -->
								</td>
							</tr>
						@include('members.modal')	
						@endforeach
					</tbody>
					</table>
					                </div>
            </div>
        </div>
    </div>
</div>

@endsection


				   <!--  while ($row = pg_fetch_row($query)) {
				      $tabla = $tabla . "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td>";
				       $tabla = $tabla . "<td><a href=actualizarUsuario.php?valor=" . $row[0] ."><i class='fas fa-user-edit'></i></a><a href=procesarEliminarUsuario.php?valor=" . $row[0] ."><i class='fas fa-user-times'></i></a></td>";
				      $tabla = $tabla . "</tr>";
				    }
				    $table = $tabla . "</table>";
				    echo $tabla; -->
<!-- 			</div>
		</div>
	</body>
</html>
