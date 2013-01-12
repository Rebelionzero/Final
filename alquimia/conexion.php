<?php

	class Conexion {
		private $servidor;
		private $base;
		private $user;
		private $pass;
		var $conexion;


		function __construct($server,$db,$usr,$psw) {
			$this->servidor = $server;
			$this->base = $db;
			$this->user = $usr;
			$this->pass = $psw;
		}

		function conexion(){
			$this->conexion = mysql_connect($this->servidor,$this->user,$this->pass);
			$select_db = mysql_select_db($this->base,$this->conexion);

			if(!$select_db){
				if(!file_exists("no_base.php")){
		   			$fp = fopen("no_base.php","w"); 
		   			fwrite($fp,"no existe la base de datos solicitada"); 
		   			fclose($fp);
				}  
				header('Location:no_base.php');
			}else{
				return $this->conexion;
			}
		}
	}






?>