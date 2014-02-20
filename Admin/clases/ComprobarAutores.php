<?php
	include_once("../interfaces/IComprobaciones.php");

	class ComprobarAutores implements IComprobaciones{
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
			
			if ($this->vacio($this->autor) == false){
				// menor o igual a 30 caracteres
				if(strlen(trim($this->autor)) <= 30){
					// busca letras, numeros y espacios en blanco
					if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]*$/', utf8_encode(trim($this->autor)) ) ){
						// todo ok
						return false;
					}else{
						// no machea, hay caracteres extraños
						return 'Error: Solo se puede ingresar texto nombre de autor.';
					}
				}else{
					// nombre muy largo
					return 'Error: El nombre ingresado es muy largo, no puede tener mas de 30 caracteres.';	
				}
			}else{
				// campo vacio
				return 'Error: Debe ingresar un nombre de autor (campo vacio).';
			}

		}

		private function validarSeudonimo(){
			if ($this->vacio($this->seudonimo) == false){
				// menor o igual a 30 caracteres
				if(strlen(trim($this->seudonimo)) <= 30){
					// el seudonimo puede estar repetido, pero se debe verificar qeu no existan 2 autores con el mismo nombre y el mismo seudonimo

					$query = 'SELECT id FROM autores WHERE seudonimo="'.utf8_encode($this->seudonimo).'" AND nombre="'.utf8_encode($this->autor).'"';
					$selectRepetido = new Queries($query);
					$selectRepetido->select();

					// si devuelve false es que no hay coincidencia
					if($selectRepetido->resultado == false){
						// todo ok
						return false;
					}else{
						// nombre Y seudonimos repetidos
						return 'Error: Ya existe un autor con ese nombre y ese seudonimo.';
					}
				}else{
					// muy largo
					return 'Error: El seudonimo no debe tener mas de 30 caracteres.';
				}
			}else{
				// dejo el campo seudonimo vacio
				return false;
			}
		}

		private function validarMail(){
			if ($this->vacio($this->mail) == false){
				// si es un mail
				if(preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $this->mail)){
					// si el mail existe en la base de datos

					$query = 'SELECT museos.id mail,autores.id autor FROM museos,autores WHERE museos.mail OR autores.mail="'.$this->mail.'"';
					$verificarMail = new Queries($query);
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
					return 'Error: Se ingresaron caracteres extraños que no corresponden a un mail, o este esta incompleto.';
				}
			}else{
				return 'Error: El campo de mail no puede estar vacio.';
			}
		}



	}