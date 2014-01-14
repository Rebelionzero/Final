<?php

	class ComprobarMuseos {
		var $nombre;
		var $direccion;
		var $mail;
		var $imagen;
		var $id;
		var $errores = array();

		function __construct($campos){
			$this->nombre = $campos['museo'];
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

					if(preg_match('/^[a-z0-9 ñáéíóú]+$/i', utf8_encode(trim($this->nombre)) ) ){
						// verifica que el nombre de museo no este en uso
						$museoExiste = new Queries("SELECT id FROM museos WHERE nombre = '".$this->nombre."'");
						$museoExiste->select();
						if ( $museoExiste->resultado != false ) {
							// ya exite ese museo
							// chequea que el tipo de formulario. Si es de edicion, no importa que exista el nombre de museo
							if( $this->form != 1 ){
								return 'Error: El nombre de museo "'.utf8_encode($this->nombre).'" ya existe en la base de datos.';
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
						return 'Error: Solo se puede ingresar texto y numeros con espacios como nombre de museo. No se permiten caracteres extraños.';
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
			// campo no vacio
			if ($this->vacio($this->direccion) == false){
				// menor o igual a 30 caracteres
				if(strlen(trim($this->direccion)) <= 50){
					// busca letras y espacios en blanco
					if(preg_match('/^[a-z0-9 ñáéíóú]+$/i', utf8_encode(trim($this->direccion)) ) ){
						// verifica que la direccion del museo no este en uso
						$direccionExiste = new Queries("SELECT id FROM museos WHERE direccion = '".utf8_encode($this->direccion)."'");
						$direccionExiste->select();
						if ( $direccionExiste->resultado != false ) {
							// esa direccion ya esta en uso
							// chequea que el tipo de formulario. Si es de edicion, no importa que exista la direccion
							if( $this->form != 1 ){
								return 'Error: La direccion del museo ya existe en la base de datos.';
							}else{
								// es un formulario de edicion y no importa si la direccion ya existe en la base de datos
								return false;
							}
						}else{
							// machea, no hay caracteres extraños, entrada correcta
							return false;
						}
					}else{
						// no machea, hay caracteres extraños
						return 'Error: Solo se puede ingresar texto y numeros con espacios como direccion. No se permiten caracteres extraños.';
					}
				}else{
					// muy largo
					return 'Error: La direccion no puede tener mas de 50 caracteres.';
				}
			}else{
				// campo vacio
				return 'Error: Debe ingresar una direccion para el museo (campo vacio).';
			}	
		}

		private function validarMail(){
			if ($this->vacio($this->mail) == false){
				// si es un mail
				if(preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $this->mail)){
					// si el mail existe en la base de datos

					$queryMuseos = 'SELECT museos.id mail FROM museos WHERE museos.mail ="'.$this->mail.'"';
					$verificarMail = new Queries($queryMuseos);
					$verificarMail->select();
					if($verificarMail->resultado == false){
						// todo ok
						return false;
					}else{
						if($this->form == 1){
							// es un formulario de edicion, no importa si el mail se repite
							return false;
						}else{
							return 'Error: Esa direccion de correo electronico ya esta en uso.';
						}
					}
				}else{
					return 'Error: Se ingresaron caracteres extraños que no corresponden a un mail.';
				}
			}else{
				return 'Error: El campo de mail no puede estar vacio.';
			}
		}

		private function validarImagen(){
			
			if ($this->imagen["error"] > 0){				
				if($this->form == 0){
					// se espera una imagen
					return "Error en la carga de imagenes: No se ha subido ninguna imagen";
				}elseif($this->form == 1){
					// no es necesaria una imagen, ya que si existe, se editará
					return false;
				}
			}elseif($this->imagen["type"] != 'image/gif' && $this->imagen["type"] != 'image/jpg' && $this->imagen["type"] != 'image/jpeg' && $this->imagen["type"] != 'image/png' && $this->imagen["type"] != 'image/pjpeg'){
		  		return "Error en la carga de imagenes: Solo se permiten formatos jpg, jpeg, gif y png";
		  	}elseif( ($this->imagen["size"] / (1024 * 1024) ) > 2.0){
		  		return "Error en la carga de imagenes: La imagen debe pesar menos de 2 Mb";
		  	}else{
		  		return false;
			}


		}

	}