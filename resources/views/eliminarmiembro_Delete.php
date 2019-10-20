<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Eliminar Usuario</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Coiny" rel="stylesheet">
	</head>
	<body>
		<div class="banner"></div>
		<div class="container-fluid pt-5">
			<div class="container">
				<div class="row">
					<div class="col-3 p-3"></div>
					<div class="col-6 formularioInsertar pt-3" id="ColocarDatos">
						<form action="procesarEliminarUsuario.php" method="post">
							<p class="labels Titulo">Eliminar Usuario</p>
							<label class="labels">Nombre Usuario</label>
							<select name="usuario" class="etrInsertar">
								<!--<option value="11">Administradorrrrrrrrrrrrrr</option>
								<option value="22">Presidenteeeeeeeee</option>
								<option value="33">Secretariaaaaaaaaaaaaaa</option>
								<option value="44">Miembrooooooooooo</option>-->
								<?php
									// include("dataBase.php");
									// $objeto = new dataBase();
									// $sql = "select * from miembro";
									// $query = $objeto->consultar($sql);
									// //Se ejecutó correctamente
					    //             while ($row = pg_fetch_row($query)) {
					    //               echo "<option value=".$row[0].">".$row[1]." ".$row[2]." ".$row[3]."</option>";
					    //             }

								?>

							</select>


							<p class="btnSubmitP"><input type="submit" value="Eliminar" class="btnSubmit"/></p>
						</form>
					</div>
					<div class="col-3"></div>
				</div>
			</div>
		</div>
    <script src="js/script.js">
	</body>
</html>;
