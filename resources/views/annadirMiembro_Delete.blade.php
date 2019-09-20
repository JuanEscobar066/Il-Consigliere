<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Añadir Usuario</title>
        <link rel="stylesheet" type="text/css" href="css/styleN.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Coiny" rel="stylesheet">
	</head>
	<body>
		<div class="container-scroller">
	    <!-- partial:../../partials/_navbar.html -->

	    <!-- partial -->
	    	<div class="container-fluid page-body-wrapper">
				<div class="banner"></div>
				<div class="container-fluid pt-5">
					<div class="container">
						<div class="row">
							<div class="grid-margin stretch-card">
								<div class="card">
									<div class="card-body">
										<div class=""></div>
										<div class="col-6 formularioInsertar pt-3" id="ColocarDatos">
											<form action="procesar.php" method="post">
												<p class="labels Titulo">Añadir Usuario</p>

												<label for="fname" class="labels">Ingresar</label>
												<input type="text" name="nombre" class="etrInsertar" placeholder="Su Nombre..." id="fname">

												<label for="flname" class="labels">Primer Apellido</label>
												<input type="text" name="primerApellido" class="etrInsertar" placeholder="Su Primer apellido..." id="flname">

												<label for="slname" class="labels">Segundo Apellido</label>
												<input type="text" name="segundoApellido" class="etrInsertar" placeholder="Su Segundo apellido..." id="slname">

												<label for="mail" class="labels">Correo</label>
												<input type="text" name="correo" class="etrInsertar" placeholder="Su Correo.." id="mail">

												<label for="passw" class="labels">Contraseña</label>
												<input type="password" name="contrasenna" class="etrInsertar" placeholder="Su Contraseña..." id="passw">

												<label for="passw2" class="labels">Contraseña nuevamente</label>
												<input type="password" name="contrasenna2" class="etrInsertar" placeholder="Su contraseña..." id="passw2">

												<label class="labels">Ocupación</label>
												<select name="ocupacionS" class="etrInsertar">
													<option value="11">Administrador</option>
													<option value="22">Presidente</option>
													<option value="33">Secretaria</option>
													<option value="44">Miembro</option>
													<?php
														/*$host='localhost';
														$bd='prueba';
														$usuario='postgres';
														$password='2811';
														$datos_bd = "host=$host port=5432 dbname=$bd user=$usuario password=$password";
											            $link = pg_connect($datos_bd);
											            //$this->link = $link;
											            $query = pg_query($link,$sql);
														//include("dataBase.php");
														// $objeto = new dataBase();
														// $sql = "select * from roles";
														// $query = $objeto->consultar($sql);
														// //Se ejecutó correctamente
										                 while ($row = pg_fetch_row($query)) {
										                   echo "<option value=".$row[0].">".$row[1]."</option>";
										                 }*/

													?>



												</select>


												<p class="btnSubmitP"><input type="submit" value="Enviar" class="btnSubmit"/></p>
											</form>
										</div>
										<div class="col-3"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    <script src="js/script.js"> </script>
	</body>
</html>;
