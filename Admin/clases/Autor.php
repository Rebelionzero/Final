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
			$this->nombre = trim($this->nombre);
			$this->seudonimo = trim($this->seudonimo);
			$this->seudonimo = $this->seudonimo == '' ? "-No tiene-" : $this->seudonimo;
			$this->value = str_replace(" ", "_", $this->nombre);
		}

		public function editarAutor(){
			$this->settingAutor();
					
		}

		public function insertarAutor(){
			$this->settingAutor();			
			$query = "INSERT INTO autores VALUES(null, '".$this->nombre."', '".$this->value."', '".$this->seudonimo."', '".$this->mail."')";

			$insertarAutor = new Queries($query);
			$insertarAutor->insert();
			$this->resultado = $insertarAutor->resultado;

			if($this->resultado == true){
				$this->mensajeResultado = "El anuevo autor ha sido creado con exito.";
			}else{
				$this->mensajeResultado = "Ha ocurrido un error al crear el nuevo autor.";
			}

		}

	}