<?php

	class Error {
		var $queri;
		var $resultado;
		var $mensaje;

		function __construct($consulta) {
			$this->queri = $consulta;
		}

		public function creacionError(){

			if (!file_exists('../Errores_Log')){
				$directorio = mkdir("../Errores_Log");
			}
			
			$apertura = fopen("../Errores_Log/errores.txt","a+");

			$fecha = date('D, d M Y H:i:s');
			$errorSql = 'Error devuelto por SQL: '.mysql_error().PHP_EOL.
			 'Query insertada: '.$this->queri.PHP_EOL.
			 'Fecha: '.$fecha.PHP_EOL.'*********************************************************************'.PHP_EOL.PHP_EOL;

			$escritura = fwrite($apertura,$errorSql);
			$cierre = fclose($apertura);

			if($directorio === false){
				$this->resultado = false;
				$this->mensaje = "Error al crear el directorio donde se guarda el log";
			}elseif($apertura === false){
				$this->resultado = false;
				$this->mensaje = "Error al crear el archivo del log";
			}elseif($escritura === false){
				$this->resultado = false;
				$this->mensaje = "Error al escribir en el log";
			}elseif($cierre === false){
				$this->resultado = false;
				$this->mensaje = "Error cerrar el log";
			}else{
				$this->resultado = true;
			}


			

		}

	}