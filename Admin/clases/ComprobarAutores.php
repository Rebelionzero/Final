<?php

	class ComprobarAutores {
		var $autor;
		var $seudonimo;
		var $mail;
		var $form;
		var $id;
		var $validaciones_error;
		var $errores = array();

		function __construct($campos){
			$this->autor = $campos['nombre'];
			$this->seudonimo = $campos['seudonimo'];
			$this->mail = $campos['mail'];
			$this->form = $campos['tipoForm'];
			$this->id = $campos['id'];
		}

		public function verificar(){
			$ar = array('0' => $this->validarNombre(), '1'=> $this->validarSeudonimo(), '2'=> $this->validarMail());
			$this->setear_errores($ar);
		}

		private function setear_errores($array){
			foreach ($array as $error => $valor) {
				if ($valor == false) {
					continue;
				}else{					
					array_push($this->errores, $valor);
				}
			}
		}

		private function vacio($string){
    		return (!isset($string) || trim($string) ==='');
		}

		private function validarNombre(){
			// copiar de validar titulo de categoria y modificar
		}

		private function validarSeudonimo(){
			// verificar que si no se ingresa un seudonimo, en la base de datos se debe ingresar el default de -No Tiene-
			// y esto se logra al ignorar el valor del campo de la tabla de la abse de datos
		}

		private function validarMail(){}



	}