<?php

	class Autor {
		var $nombre;
		var $seudonimo;
		var $mail;
		var $value;
		var $accionBooleano;
		var $resultado = false;
		var $mensajeResultado = '';
		var $id;

		function __construct($autor){
			$this->nombre = $autor['nombre'];
			$this->seudonimo = $autor['seudonimo'];
			$this->mail = $autor['mail'];
			$this->accionBooleano = $autor['tipoForm'];
			$this->id = $autor['id'];
		}

		private function settingAutor(){
			// define el value para insertar en la base de datos
			$this->nombre = utf8_encode(trim($this->nombre));
			$this->seudonimo = utf8_encode(trim($this->seudonimo));
			$this->seudonimo = $this->seudonimo == '' ? "-No tiene-" : $this->seudonimo;
			$this->value = str_replace(" ", "_", $this->nombre);
		}

		public function editarAutor(){
			$this->settingAutor();
			$query = "UPDATE autores SET nombre='".$this->nombre."', value='".$this->value."', seudonimo='".$this->seudonimo."', mail='".$this->mail."' WHERE id=".$this->id;
			
			$editarAutor = new Queries($query);
			$editarAutor->update();
			$this->resultado = $editarAutor->resultado;

			if($this->resultado == true){
				$this->mensajeResultado = "El autor se ha editado con exito.";
			}else{
				$this->mensajeResultado = "Ha ocurrido un error al editar el autor.";
			}

		}

		public function insertarAutor(){
			$this->settingAutor();			
			$query = "INSERT INTO autores VALUES(null, '".$this->nombre."', '".$this->value."', '".$this->seudonimo."', '".$this->mail."')";

			$insertarAutor = new Queries($query);
			$insertarAutor->insert();
			$this->resultado = $insertarAutor->resultado;

			if($this->resultado == true){
				$this->mensajeResultado = "El nuevo autor ha sido creado con exito.";
			}else{
				$this->mensajeResultado = "Ha ocurrido un error al crear el nuevo autor.";
			}

		}

	}