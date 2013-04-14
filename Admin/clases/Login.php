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
			$query = "SELECT tipoUsuario, password FROM usuarios WHERE nombreDeUsuario ='".$this->usuario."';";
			echo $query;
		}

	}