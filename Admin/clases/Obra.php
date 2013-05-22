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
			$img = explode(".",$this->imagen['name']);
			$this->imagen['saveName'] = $img[0].microtime(true).'.'.$img[1];
			$this->imagen['name'] = $img[0];
			
			// Revisar documentacion antes de seguir con esta parte!!!!!!!!
			/*
			$categoriaId = "SELECT FROM categorias"
			$categoriaQuery = new Query();

			
			$query = "INSERT INTO obras VALUES(null,'".$this->titulo."','".$this->imagen['name']."','".$this->imagen['saveName']."','".$this->descripcion."','".$this->anio."','".$this->categoria."','".$this->autor."','".$this->museo."','".$this->seudonimo."');";
			var_dump($query);*/


		}
	}

