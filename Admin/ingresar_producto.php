<?php
	session_start();
	include("conexion.php");
	$_SESSION['consultar'];
	$nombre = $_POST['nombre'];
	$descripcion = $_POST['descripcion'];
	$precio = $_POST['precio'];
	$flotante = $_POST['centavos'];
	$categoria = $_POST['categoria'];
	$marca = $_POST['marca'];
	
	$precio += '.'.$flotante;
	
	
	
	function ingresar_bd($nom,$desc,$pre,$cat,$mar,$con){
		$consulta = 'INSERT INTO productos VALUES ("null","'.$nom.'","'.$desc.'","producto.jpg","'.$pre.'",(SELECT id FROM categorias WHERE nombre = "'.$cat.'"),(SELECT id FROM marcas WHERE nombre = "'.$marc.'"))';
		$ingresar = mysql_query($consulta, $con);
	}
	$consultar= ingresar_bd($nombre,$descripcion,$precio,$categoria,$marca,$conexion);
	
?>