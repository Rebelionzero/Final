<?php

	include_once('../autoloader.php');
	session_start();

	$campos = array(
		'pass' => utf8_decode($_POST['pass']),
		'newPass' => utf8_decode($_POST['new-pass']),
		'repeatPass' => utf8_decode($_POST['repeat-pass'])
	);

	foreach ($campos as $clave => $valor) {
		if (strlen($valor) < 1 ){
			$_SESSION['ErroresPass'] = 'Error: No pueden haber campos vacios';
			header("Location:../vistas/cambioPass.php");
		}else{
			continue;
		}
	}

	if(strlen($campos['newPass']) > 15 || strlen($campos['newPass']) < 6) {
		$_SESSION['ErroresPass'] = 'Error: La nueva contraseña debe tener un minimo de 6 caracteres y un maximo de 15';
		header("Location:../vistas/cambioPass.php");
	}else{
		if($campos['newPass'] != $campos['repeatPass']){
			$_SESSION['ErroresPass'] = 'Error: Los campos "Nueva contraseña" y "Repetir nueva contraseña" no coinciden.';
			header("Location:../vistas/cambioPass.php");
		}else{
			$queryPass = 'SELECT password FROM usuarios WHERE nombreDeUsuario="Admin"';
			$select = new Queries($queryPass);
			$select->select();

			if($select->resultado[0]['password'] != $campos['pass']){
				$_SESSION['ErroresPass'] = 'Error: La contraseña a cambiar es incorrecta.';
				header("Location:../vistas/cambioPass.php");
			}else{
				$queryCambiar = "UPDATE usuarios SET password='".$campos['newPass']."' WHERE nombreDeUsuario='Admin' ";
				$update = new Queries($queryCambiar);
				$update->update();

				if($update->resultado == true){
					$_SESSION['resultado_cambio'] = 'La contraseña se cambio correctamente.';
				}else{
					$_SESSION['ErroresPass'] = 'Error: Ocurrio un error al cambiar la contraseña.';
				}
				
				header("Location:../vistas/cambioPass.php");

			}
		}
	}

?>
