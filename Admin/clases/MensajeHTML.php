<?php

	class MensajeHTML {
		var $input;
		var $middle;
		var $output;

		function __construct($mensajes){
			$this->input = $mensajes;
		}

		public function mensajeError(){
			$this->output = "<div class='mensaje_error alert alert-error container'><ul>";
			foreach ($this->input as $error => $mensaje) {
				$this->middle .= "<li>".$mensaje."</li>";
			}
			$this->output.=	$this->middle . "</ul><a href='#' class='close cerrar_error_msg'>x</a></div>";
		}

		public function mensajeExito(){
			$this->output = "<div class='mensaje_exito alert alert-success container'><p>".$this->input."</p><a href='#' class='close cerrar_exito_msg'>x</a></div>";
		}

		public function mensajeAlert(){
			$this->output = "<div class='mensaje_exito alert alert-info container'><p>".$this->input."</p><a href='#' class='close cerrar_info_msg'>x</a></div>";
		}

	}