<?php

	class objetoLogin {
		var $usuario;
		var $contrasenia;
		var $resultadoConexion;

		public function __construct($usr,$pass){
			$this->usuario = $usr;
			$this->contrasenia = $pass;
		}

		public function comprobarUsuario(){
			$conectar = new Conexion('localhost','shop','root','');
			$conectar->conexion();

			$q = new traerElementos('SELECT password FROM usuarios WHERE nombreDeUsuario ="'.$this->usuario.'";',$conectar->conexion);
			$q->traerElem();
			$q->get();
				
			$arr = $q->get();
			if($arr[0]['password'] != $this->contrasenia){
				$this->resultadoConexion = false;
			}else{
				$this->resultadoConexion = true;
			}
		}

		public function devolverResultado(){
			return $this->resultadoConexion;
		}
	}