<?php

	class Conexion	{
		var $server;
		var $usr;
		var $pass;
		var $db;
		var $conexion;
		
		function __construct($servidor = "localhost",$usuario = "root" ,$clave = "" ,$base = "shop") {
			$this->server = $servidor;
			$this->usr = $usuario;
			$this->pass = $clave;
			$this->db = $base;
		}
	

		function conectar_bd(){
			$this->conexion= mysql_connect($this->server,$this->usr,$this->pass);
			$resultado = mysql_select_db($this->db, $this->conexion);			
		}

		function get(){
			return $this->conexion;
		}

}