<?php
$servidor = "localhost";
$base = "shop";
$usuario = "root";
$pass = "";
	
	function conectar_bd($servidor,$usuario,$pass,$base){
		$conexion= mysql_connect($servidor,$usuario,$pass);
		mysql_select_db($base, $conexion);
		return $conexion;
	}
	
	$conexion = conectar_bd($servidor,$usuario,$pass,$base);
?>