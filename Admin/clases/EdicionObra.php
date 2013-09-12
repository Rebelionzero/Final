<?php

	class EdicionObra{
		private $titulo;
		private $descripcion;
		private $autor;
		private $anio;
		private $categoria;
		private $museo;
		private $imagen;
		private $mail;
		private $seudonimo; 

		function __construct($obras){
			var_dump($obras);
		}

		public function edit(){
			/*$queryEditar = "UPDATE obras SET nombre='".$this->titulo."', value=";
			var_dump($queryEditar);*/

		}

	}