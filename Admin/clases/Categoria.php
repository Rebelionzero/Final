<?php

	class Categoria {
		var $titulo;
		var $descripcion;
		var $value;
		var $accionBooleano;
		private $parametrosObra;
		var $resultado = false;
		var $mensajeResultado = '';
		var $id;

		function __construct($categoria){
			$this->titulo = $categoria['nombre'];
			$this->descripcion = $categoria['descripcion'];
			$this->accionBooleano = $categoria['tipoForm'];
			$this->id = $categoria['id'];
		}

		public function settingCategoria(){
			// define el value para insertar en la base de datos
			$this->value = str_replace(" ", "_", $this->titulo);			
		}

		public function editarCategoria(){}

		public function insertarCategoria(){
			$query = "INSERT INTO categorias VALUES(null,'".$this->titulo."','".$this->value."','".$this->descripcion."')";

			$nuevaCate = new Queries($query);
			$nuevaCate->insert();
			$this->resultado = $nuevaCate->resultado;
			if($this->resultado == true){
				if(strlen($this->descripcion) > 0){
					$this->mensajeResultado = 'La nueva categoria ha sido cargada con exito.';
				}else{
					$this->mensajeResultado = 'Se creó una nueva categoria, pero le recomendamos agregarle una descripción en la seccion <strong>Editar Categoria</strong> en la <strong>Lista de Categorias</strong>.';
				}
			}else{
				$this->mensajeResultado = 'Error en la insercion de la categoria en la base de datos';
			}
		}

	}