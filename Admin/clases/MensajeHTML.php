<?php

	class MensajeHTML {
		var $input;
		var $middle;
		var $output;

		function __construct($mensajes){
			$this->input = $mensajes;
		}

		public function mensajeError(){			
			$this->output = "<div class='mensaje_error'><ul>";
			foreach ($this->input as $error => $mensaje) {
				$this->middle .= "<li>".$mensaje."</li>";
			}
			$this->output.=	$this->middle . "</ul><a href='#' class='cerrar_error_msg'>Cerrar</a></div>";
		}

	}