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
			try{
				$resultado = mysql_select_db($this->db, $this->conexion);
 		    	if($resultado === false){throw new Exception("<div class='xcpt'>
 		    		<p>Falló la conexion a la base de datos, intentelo nuevamente o contacte al administrador del sitio.</p>
 		    		<a href='#'>Cerrar</a>
 		    		</div>");
 		    		exit();
 		    	}else{

 		    	}
    		}catch (Exception $e){   
         		echo $e->getMessage();
    		}
			
		}

		function get(){
			return $this->conexion;
		}

}