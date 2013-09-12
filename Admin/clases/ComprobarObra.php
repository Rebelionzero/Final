<?php
	
	class ComprobarObra {
		var $titulo;
		var $descripcion;
		var $autor;
		var $anio;
		var $categoria;
		var $museo;
		var $esEditable;
		var $imagen;
		var $mail;
		var $validaciones = array();
		var $errores = array();

		function __construct($array){
			$this->titulo = $array['titulo'];
			$this->descripcion = $array['descripcion'];
			$this->autor = $array['autor'];
			$this->anio = $array['anio'];
			$this->categoria = $array['categoria'];
			$this->museo = $array['museo'];
			$this->esEditable = $array['tipoForm'];
			$this->imagen = $array['imagen'];
			$this->mail = $array['mail'];
		}

		public function verificar(){
			$this->validaciones = array(
				'titulo' => $this->validar_titulo(),
				'descripcion' => $this->validar_descripcion(),
				'autor' => $this->validar_select($this->autor,'Debe seleccionar un autor'),
				'año' => $this->validar_select($this->anio,'Debe seleccionar un año'),
				'categoria' => $this->validar_select($this->categoria,'Debe seleccionar una categoria'),
				'museo' => $this->validar_select($this->museo,'Debe seleccionar un museo'),
				'mail' => $this->validar_mail(),
				'imagen' => $this->validar_img()				
			);
			$this->setear_errores($this->validaciones);
		}

		private function vacio($string){
    		return (!isset($string) || trim($string) ==='');
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

		private function validar_titulo(){
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
						return 'Error: Solo se puede ingresar texto, espacios y numeros como titulo';
					}
				}else{
					// muy largo
					return 'Error: El titulo no debe tener mas de 30 caracteres';
				}
			}else{
				// campo vacio
				return 'Error: Debe ingresar un titulo (campo vacio)';
			}
		}

		private function validar_descripcion(){
			if( strlen( trim($this->descripcion) ) > 255 ){return "Error: La descripcion no puede tener mas de 255 caracteres";}else{return false;}
		}
		
		private function validar_select($campo,$error){
			if($campo != 'seleccione'){
				return false;
			}else{
				return 'Error: '.$error;
			}
		}

		private function validar_img(){
			if ($this->imagen["error"] > 0){				
				if($this->esEditable == 0){
					// se espera una imagen, porque la obra es nueva
					return "Error en la carga de imagenes: No se ha subido ninguna imagen";
				}elseif($this->esEditable == 1){
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

		private function validar_mail(){
			if( $this->mail === false){
				return "Error: Debe seleccionar que mail se usará en la obra";
			}else{
				return false;
			}
		}
		
	}