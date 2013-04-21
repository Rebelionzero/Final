<?php

	class Login {
		var $usuario;
		var $clave;
		var $respuesta;

		function __construct($usr,$pass){
			$this->usuario = $usr;
			$this->clave = $pass;
		}
		
		function consultaUsuario(){
			$consultaUsuario = "SELECT tipoUsuario, password FROM usuarios WHERE nombreDeUsuario ='".$this->usuario."';";
			$objetoQueries = new Queries($consultaUsuario);
			$objetoQueries->select();

			if ($objetoQueries->resultado === false) {
				// fallo, no devuelve nada, no hay usuarios con ese nombre
				// header hacia el mismo login con el mensaje de error
				// mensaje de usuario o contraseña incorrectos
			}else{
				// exito, existe ese usuario
				if($this->clave != $objetoQueries->resultado[0]["password"]){
					print_r("usuario y/o contraseña erroneos");					
				}else{
					// clave y usuarios correctos
					$_SESSION['Login'] = true;
					header("Location:../vistas/admin.php");
				}
			}

		}

	}