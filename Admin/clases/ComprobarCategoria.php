<?php

	class ComprobarCategoria {
		var $titulo;
		var $descripcion;
		var $form;
		var $id;
		var $validaciones_error;
		var $errores = array();

		function __construct($campos){
			$this->titulo = $campos['nombre'];
			$this->descripcion = $campos['descripcion'];
			$this->form = $campos['tipoForm'];
			$this->id = $campos['id'];
		}

		public function verificar(){
			$ar = array('0' => $this->validarTitulo(), '1'=> $this->validarDescripcion());
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

		private function validarTitulo(){
			if ($this->vacio($this->titulo) == false){
				// campo no vacio
				if(strlen(trim($this->titulo)) <= 30){
					// menor o igual a 30 caracteres
					if(preg_match('/^[a-zA-Z0-9 ]*$/', trim($this->titulo) ) ){
						// busca letras, numeros y espacios en blanco
						// machea, no hay caracteres extraños, entrada correcta
						return false;
					}else{
						// no machea, hay caracteres extraños
						return 'Error: Solo se puede ingresar texto, espacios y numeros como nombre de categoria';
					}
				}else{
					// muy largo
					return 'Error: La categoria no debe tener mas de 30 caracteres';
				}
			}else{
				// campo vacio
				return 'Error: Debe ingresar una categoria (campo vacio)';
			}
		}

		private function validarDescripcion(){
			if( strlen( trim($this->descripcion) ) > 255 ){return "Error: La descripcion no puede tener mas de 255 caracteres";}else{return false;}
		}



	}