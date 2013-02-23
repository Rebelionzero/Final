<?php

	class Conexion	{
		var $server;
		var $usr;
		var $pass;
		var $db;
		var $conexion;
		
		function __construct($servidor = "localhost",$usuario = "root" ,$clave = "" ,$base = "sho") {
			$this->server = $servidor;
			$this->usr = $usuario;
			$this->pass = $clave;
			$this->db = $base;
		}
	

		public function conectar_bd(){
			$this->conexion = @mysql_connect($this->server,$this->usr,$this->pass) or die(header("Location: ../vistas/no_server.php"));			
			$resultado = @mysql_select_db($this->db, $this->conexion);

			if($resultado === false) {
				// new Error
				// debe ir en el log
			}			
		}

}