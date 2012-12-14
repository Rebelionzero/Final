<?php
	include_once("conexion.php");
	session_start();
	
	$tabla = $_POST['tabla'];
	$id = $_POST['id'];
	$nombre = $_POST['nombre'];


	/*function borrar_bd($conexion,$table,$valor){
		$insert = "INSERT INTO ".$table."s"." VALUES(null,'".$valor."',CURRENT_DATE());";
		$consulta = mysql_query($insert, $conexion);
		return $consulta;
	}
	if($consultar= borrar_bd($conexion,$table,$valor)){
		/*echo "La ".$table. " ".$valor." ha sido insertada correctamente.";
		die();
	}else{
		echo "Error ".mysql_errno(). " los valores ingresados no constituyen un nombre de ".$table." correcto.";
		die();
	}*/

?>