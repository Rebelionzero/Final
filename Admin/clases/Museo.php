<?php

	class Museo {
		var $nombre;
		var $direccion;
		var $mail;
		var $imagen;
		var $value;
		var $accionBooleano;
		var $resultado = false;
		var $mensajeResultado = '';
		var $id;

		function __construct($museo){
			$this->nombre = $museo['nombre'];
			$this->seudonimo = $museo['direccion'];
			$this->mail = $museo['mail'];
			$this->imagen = $museo['imagen'];
			$this->accionBooleano = $autor['tipoForm'];
			$this->id = $autor['id'];
		}

		private function settingMuseo(){
			// define el value para insertar en la base de datos
			$this->nombre = utf8_encode(trim($this->nombre));
			$this->value = str_replace(" ", "_", $this->nombre);
		}

		public function editarMuseo(){
			$this->settingMuseo();
			var_dump("esto todavia no esta programado");

		}

		public function insertarMuseo(){
			$this->settingMuseo();
			
		}

	}