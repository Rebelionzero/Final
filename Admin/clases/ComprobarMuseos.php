<?php

	class ComprobarMuseos {
		var $nombre;
		var $direccion;
		var $mail;
		var $imagen;
		var $id;		
		var $errores = array();

		function __construct($campos){
			$this->nombre = $campos['nombre'];
			$this->direccion = $campos['direccion'];
			$this->mail = $campos['mail'];
			$this->imagen = $campos['imagen'];			
			$this->form = $campos['tipoForm'];
			$this->id = $campos['id'];
		}

		public function verificar(){
			$ar = array('0' => $this->validarNombreMuseo(), '1'=> $this->validarDireccion(), '2'=> $this->validarMail(), '3'=> $this->validarImagen());
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

		private function validarNombreMuseo(){
			// campo no vacio
			if ($this->vacio($this->nombre) == false){
				// menor o igual a 30 caracteres
				if(strlen(trim($this->nombre)) <= 30){
					// busca letras y espacios en blanco
					if(preg_match('/^[a-zA-Z ]*$/', trim($this->nombre) ) ){
						// verifica que el nombre de museo no este en uso
						$museoExiste = new Queries("SELECT id FROM museos WHERE nombre = '".$this->nombre."'");
						$museoExiste->select();
						if ( $museoExiste->resultado != false ) {
							// ya exite ese museo
							// chequea que el tipo de formulario. Si es de edicion, no importa que exista el nombre de museo
							if( $this->form != 1 ){								
								return 'Error: El nombre de museo "'.$this->nombre.'" ya existe en la base de datos.';
							}else{
								// es un formulario de edicion y no importa si el museo ya existe en la base de datos
								return false;
							}
						}else{
							// machea, no hay caracteres extraños, entrada correcta
							return false;
						}
					}else{
						// no machea, hay caracteres extraños
						return 'Error: Solo se puede ingresar texto, espacios y numeros como nombre de museo.';
					}
				}else{
					// muy largo
					return 'Error: El nombre del museo no debe tener mas de 30 caracteres.';
				}
			}else{
				// campo vacio
				return 'Error: Debe ingresar un nombre de museo (campo vacio).';
			}	
		}

		private function validarDireccion(){

		}

		private function validarMail(){

		}

		private function validarImagen(){

		}

	}