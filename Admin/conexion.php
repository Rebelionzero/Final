<?php

	function conectar_bd($servidor = "localhost",$usuario = "root" ,$pass = "" ,$base = "shop"){
		$conexion= mysql_connect($servidor,$usuario,$pass);
		mysql_select_db($base, $conexion);
		return $conexion;
	}
	
	$conexion = conectar_bd();
?>