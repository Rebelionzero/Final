<?php
	include("../Admin/conexion.php");
	
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$mail = $_POST['mail'];
	$password = $_POST['password'];
	
	function existeUsuario($email,$con){
		$consulta = "SELECT id FROM usuarios WHERE mail='".$email."';";
		$select = mysql_query($consulta,$con);		
		if(mysql_num_rows($select) > 0){
			// existe el mail
			return false;
		}else{
			// NO existe el mail
			return true;
			
		}
	}
	
	function nuevoUsuario($name,$last,$email,$pass,$con){
		$insertar = "INSERT INTO usuarios VALUES(null,'$name','$last',now(),'$email','$pass')";
		$query = mysql_query($insertar,$con);
	}
	
	$existente = existeUsuario($mail, $conexion);
	if($existente == false){
		echo 'el mail ya esta en uso';
	}elseif($existente == true){
		$crear_usuario_nuevo = nuevoUsuario($nombre,$apellido,$mail,$password,$conexion);
	}
	
	mysql_close($conexion);
?>