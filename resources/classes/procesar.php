<?php
    include("dataBase.php");
    
	$nombre = $_POST['nombre'];
	$primerApellido = $_POST['primerApellido'];
	$segundoApellido = $_POST['segundoApellido'];
	$correo = $_POST['correo'];
	$contrasenna = $_POST['contrasenna'];
	$selected_val = (int)$_POST['ocupacionS'];  // Storing Selected Value In Variable
	echo "<h2>Informacion subida desde php</h2>";
	echo "Nombre: " . $nombre . "<br/>";
	echo "Asunto: " . $primerApellido . "<br/>";
	echo "Mensaje: " . $segundoApellido . "<br/>";
	echo "You have selected : " .$selected_val . "<br/>";  // Displaying Selected Value*/
	//echo "Seleccion: " . $seleccion . "<br/>";
    $objeto = new dataBase();
    $sql = "insert into miembro (nombreMiembro, apellido1Miembro, apellido2Miembro, correo, contrasenna, rol) values ('$nombre','$primerApellido','$segundoApellido','$correo','$contrasenna', $selected_val)";
	$objeto->insertar($sql);
	header('Location: annadirUsuario.php');
	
?>