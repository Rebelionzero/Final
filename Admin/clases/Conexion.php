<?php

	class Conexion	{
		var $server;
		var $usr;
		var $pass;
		var $db;
		var $conexion;
		
		function __construct($servidor = "localhost",$usuario = "root" ,$clave = "" ,$base = "arte") {
			$this->server = $servidor;
			$this->usr = $usuario;
			$this->pass = $clave;
			$this->db = $base;
		}
	

		public function conectar_bd(){
			$this->conexion = @mysql_connect($this->server,$this->usr,$this->pass) or die(header("Location: ../vistas/no_server.php"));
			$resultado = @mysql_select_db($this->db, $this->conexion);

			if($resultado === false) {
				$_SESSION['Login']['autenticacion'] = false;
				$_SESSION['Login']['respuesta'] = 'Se produjo un error al conectarse al servidor, contacte al servicio tecnico o intentelo de nuevo mas tarde.';
				header("Location: ../vistas/login.php");
			}
		}

}