<?php
	
	class ComprobarObra {
		var $titulo;
		var $descripcion;
		var $autor;
		var $anio;
		var $categoria;
		var $museo;
		var $imagen;
		var $seudonimo;		
		var $vacios = array();
		var $validaciones = array();
		var $errores = array();
		var $temporal;

		function __construct($array){
			$this->titulo = $array['titulo'];
			$this->descripcion = $array['descripcion'];
			$this->autor = $array['autor'];
			$this->anio = $array['anio'];
			$this->categoria = $array['categoria'];
			$this->museo = $array['museo'];
			$this->imagen = $array['imagen'];
			$this->seudonimo = $array['seudonimo'];
		}

		public function verificar(){			
			$this->validaciones = array(
				'titulo' => $this->validar_titulo(), // ok
				'descripcion' => $this->validar_descripcion(), // ok

				//'precio' => $this->validar_precio(),
				//'categoria' => $this->validar_select($this->categoria,'categoria'),
				//'marca' => $this->validar_select($this->marca,'marca'),				
				//'imagen' => $this->validar_img()
			);
			
			/*$this->vacios = array(
				'titulo' => $this->vacio($this->titulo),
				'descripcion' => $this->vacio($this->descripcion),
				'imagen' => $this->sinImagen($this->imagen)
			);*/
			
			//$this->setear_errores($this->validaciones);			
			
			
		}

		private function vacio($string){
    		return (!isset($string) || trim($string) ==='');
		}

		private function sinImagen($img){
			if($img['error'] == 4){return true;}else{return false;}	
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
			if ($this->vacio($this->titulo) == false) {
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
			if(strlen(trim($this->descripcion)) > 255){return "La descripcion no puede tener mas de 255 caracteres";}else{return false;}
		}

		private function validar_precio(){
			if(!is_numeric($this->precio)){
				return 'Error: Debe ingresar un numero';
			}else{
				$this->precio = intval($this->precio);
				if($this->precio < 1 || $this->precio > 999){
					return 'Error: El numero debe ser entero positivo entre 1 y 999';
				}else{
					return false;
				}
			}
		}		
		
		private function validar_select($campo,$error){
			if($campo != 'seleccionar'){
				return false;
			}else{
				return 'Error: Debe seleccionar una '.$error;
			}
		}

		
		private function validar_img(){
			
			if ($this->imagen["error"] > 0){
	  			return "Error en la carga de imagenes: No se ha subido ninguna imagen";
			}elseif($this->imagen["type"] != 'image/gif' && $this->imagen["type"] != 'image/jpg' && $this->imagen["type"] != 'image/jpeg' && $this->imagen["type"] != 'image/png' && $this->imagen["type"] != 'image/pjpeg'){
	  			return "Error en la carga de imagenes: Solo se permiten formatos jpg, jpeg, gif y png";
	  		}elseif( ($this->imagen["size"] / (1024 * 1024) ) > 2.0){
	  			return "Error en la carga de imagenes: La imagen debe pesar menos de 2 Mb";
	  		}else{
	  			return false;
			}
		}


	}