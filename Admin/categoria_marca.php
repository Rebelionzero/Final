<?php
    include_once("conexion.php");
	session_start();
	
	/*if(isset($table)){unset($table);}
	
	if(!isset($_POST["algo"])){
		$table = $_POST["algo"];
	}else{
		$table = $_POST["algo"];
	}*/
	
	$table = $_POST["tabla"];
	$valor = $_POST["valor"];

	function insertar_bd($usuario,$conexion,$table,$valor){
		$insert = "INSERT INTO ".$table."s"." VALUES(null,'".$valor."',CURRENT_DATE());";
		$consulta = mysql_query($insert, $conexion);
		return $consulta;
	}
	if($consultar= insertar_bd($usuario,$conexion,$table,$valor)){
		echo "La ".$table. " ".$valor." ha sido insertada correctamente.";
		die();
	}else{
		echo "Error ".mysql_errno(). " los valores ingresados no constituyen un nombre de ".$table." correcto.";
		die();
	}
?>