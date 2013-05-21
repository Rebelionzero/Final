<?php

	class Obra {
		var $titulo;
		var $descripcion;
		var $autor;
		var $anio;
		var $categoria;
		var $museo;
		var $imagen;
		var $seudonimo;

		function __construct($obra){
			$this->titulo = $obra['titulo'];
			$this->descripcion = $obra['descripcion'];
			$this->autor = $obra['autor'];
			$this->anio = $obra['anio'];
			$this->categoria = $obra['categoria'];
			$this->museo = $obra['museo'];
			$this->imagen = $obra['imagen'];
			$this->seudonimo = $obra['seudonimo'];
		}

		public function insertarObra(){
			$query = "INSERT INTO obras VALUES(null,'".$this->titulo."');"
		}
	}

