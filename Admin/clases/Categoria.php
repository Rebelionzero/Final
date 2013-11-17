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

		private function settingCategoria(){
			// define el value para insertar en la base de datos
			$this->titulo = trim($this->titulo);
			$this->descripcion = trim($this->descripcion);
			$this->value = str_replace(" ", "_", $this->titulo);
		}

		public function editarCategoria(){
			$this->settingCategoria();

			$query = "UPDATE categorias SET nombre='".$this->titulo."', value='".$this->value."', descripcion='".$this->descripcion."' WHERE id=".$this->id;

			$actualizarCate = new Queries($query);
			$actualizarCate->update();
			$this->resultado = $actualizarCate->resultado;
			
			if($this->resultado == true){
				if(strlen($this->descripcion) > 0){
					$this->mensajeResultado = 'La nueva categoria ha sido editada con exito.';
				}else{
					$this->mensajeResultado = 'Se editó la categoria, pero le recomendamos agregarle una descripción en la seccion <strong>Editar Categoria</strong> en la <strong>Lista de Categorias</strong>.';
				}
			}else{
				$this->mensajeResultado = 'Error en la edicion de la categoria.';
			}
			
		}

		public function insertarCategoria(){
			$this->settingCategoria();

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