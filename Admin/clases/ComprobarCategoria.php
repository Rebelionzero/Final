<?php

	class ComprobarCategoria {
		var $titulo;
		var $descripcion;
		var $form;
		var $id;		
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
			// campo no vacio
			if ($this->vacio($this->titulo) == false){
				// menor o igual a 30 caracteres
				if(strlen(trim($this->titulo)) <= 30){
					// busca letras, numeros y espacios en blanco
					if(preg_match('/^[a-zA-Z0-9 ]*$/', trim($this->titulo) ) ){
						
						// verifica que el nombre de categoria ingresada no exista
						$categoriaExiste = new Queries("SELECT id FROM categorias WHERE nombre = '".$this->titulo."'");
						$categoriaExiste->select();
						if ( $categoriaExiste->resultado != false ) {
							// ya exite esa categoria

							// chequea que el tipo de formulario. Si es de edicion, no importa que exista el nombre de categoria, pues significa que solo se desea cambiar la descripcion
							if( $this->form != 1 ){
								return 'Error: El nombre de categoria "'.$this->titulo.'" ya existe en la base de datos.';
							}else{
								// es un formulario de edicion y no importa si la categoria ya existe en la base de datos
								return false;
							}
						}else{
							// machea, no hay caracteres extraños, entrada correcta
							return false;
						}
					}else{
						// no machea, hay caracteres extraños
						return 'Error: Solo se puede ingresar texto, espacios y numeros como nombre de categoria.';
					}
				}else{
					// muy largo
					return 'Error: La categoria no debe tener mas de 30 caracteres.';
				}
			}else{
				// campo vacio
				return 'Error: Debe ingresar una categoria (campo vacio).';
			}
		}

		private function validarDescripcion(){
			if( strlen( trim($this->descripcion) ) > 255 ){return "Error: La descripcion no puede tener mas de 255 caracteres.";}else{return false;}
		}



	}