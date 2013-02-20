<?php
	
	class ComprobarProducto {
		var $nombre;
		var $precio;
		var $categoria;
		var $marca;
		var $descripcion;
		var $imagen;
		var $validaciones = array();
		var $vacios = array();
		var $errores = array();

		function __construct($array){
			$this->nombre = $array['producto'];
			$this->precio = $array['precio'];
			$this->categoria = $array['categoria'];
			$this->marca = $array['marca'];
			$this->descripcion = $array['descripcion'];
			$this->imagen = $array['imagen'];
		}

		public function verificar(){

			$this->validaciones = array(
				'producto' => $this->validar_producto(),
				'precio' => $this->validar_precio(),
				'categoria' => $this->validar_select($this->categoria,'categoria'),
				'marca' => $this->validar_select($this->marca,'marca'),
				'descripcion' => $this->validar_descripcion(),
				'imagen' => $this->validar_img()
			);
			
			$this->vacios = array(
				'producto' => $this->vacio($this->nombre),
				'precio' => $this->vacio($this->precio),
				'categoria' => $this->vacio($this->categoria),
				'marca' => $this->vacio($this->marca),
				'descripcion' => $this->vacio($this->descripcion),
				'imagen' => $this->sinImagen($this->imagen)
			);
			
			$this->setear_errores($this->validaciones);
			
			
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

		private function validar_producto(){
			if(strlen($this->nombre) > 0 && strlen($this->nombre) < 31){
				if(preg_match('/^\pL+$/u', $this->nombre)){
					return false;
				}else{
					return 'Error: Solo se puede ingresar texto sin espacios como nombre de producto';
				}
			}elseif(strlen($this->nombre) < 1){
				return 'Error: Debe llenar el campo producto';
			}elseif(strlen($this->nombre) > 30){
				return 'Error: El campo porducto no debe tener mas de 30 caracteres';
			}
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

		private function validar_descripcion(){
			if(trim(strlen($this->descripcion)) > 200){return "La descripcion no puede tener mas de 200 caracteres";}else{return false;}
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