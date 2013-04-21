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
			$consultaUsuario = "SELECT password FROM usuarios WHERE nombreDeUsuario ='".$this->usuario."';";
			$objetoQueries = new Queries($consultaUsuario);
			$objetoQueries->select();

			if ($objetoQueries->resultado === false) {
				// fallo, no devuelve nada o no hay usuarios con ese nombre
				$this->respuesta = false;
			}else{
				// exito, existe ese usuario
				if($this->clave != $objetoQueries->resultado[0]["password"]){
					$this->respuesta = false;
				}else{
					// clave y usuarios correctos
					$this->respuesta = true;
				}
			}

		}

	}