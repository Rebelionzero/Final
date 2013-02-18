<?php

	class Editar {
		var $tabla;
		var $id;
		var $nombre;
		var $precio;
		var $categoria;
		var $marca;
		var $descripcion;
		var $imagen;
		var $respuesta;

		function __construct($array){
			$this->tabla = $array[0];
			$this->id = $array[1];
			$this->nombre = $array[2];

			if($array[0] == 'productos'){
				$this->precio = $array[3];
				$this->categoria = $array[4];
				$this->marca = $array[5];
				$this->descripcion = $array[6];
				$this->imagen = $array[7];
			}
		}

		public function editarCM(){
			if(strlen($this->nombre) > 0 && strlen($this->nombre) < 31){
				if(preg_match('/^\pL+$/u', $this->nombre)){
					$update_db = 'UPDATE '.$this->tabla.' SET nombre="'.$this->nombre.'" WHERE id='.intval($this->id);

					$consulta = new Queries($update_db);
					$consulta->update();

					if($consulta->resultado === true){
						$this->respuesta = 'La edicion se realizo exitosamente';
					}else{
						$this->respuesta = "Error :".mysql_errno();
					}
				}else{
					$this->respuesta = 'Error: Caracteres erroneos fueron ingresados';
				}
			}else{
				$this->respuesta = 'Error: solo puede ingresar 30 caracteres como maximo y un minimo de 1 caracter';
			}
		}

		public function editarProducto(){
			//var_dump($this->tabla,$this->id,$this->nombre,$this->precio,$this->marca,$this->descripcion,$this->categoria);

			
		}

		private function vacio($string){
			return (!isset($string) || trim($string) ==='');
		}
		
		private function sinImagen($img){
			if($img['error'] == 4){
				return true;
			}else{
				return false;
			}
		}
		
		private function validar_producto($campo){
			if(strlen($campo) > 0 && strlen($campo) < 31){
				if(preg_match('/^\pL+$/u', $campo)){
					return false;
				}else{
					return 'solo se puede ingresar texto como nombre de producto';
				}
			}elseif(strlen($campo) < 1){
				return 'debe llenar el campo producto';
			}elseif(strlen($campo) > 30){
				return 'el campo porducto no debe tener mas de 30 caracteres';
			}
		}
		
		private function validar_precio($campo){
			if(!is_numeric($campo)){
				return 'debe ingresar un numero como precio';
			}else{
				$campo = intval($campo);
				if($campo < 1 || $campo > 999){
					return 'el numero debe ser entero positivo entre 1 y 999';
				}else{
					return false;
				}
			}
		}
		
		private function validar_descripcion($campo){
			if(trim(strlen($campo)) > 200){
				return "La descripcion no puede tener mas de 200 caracteres";
			}else{
				return false;
			}
		}
		
		private function validar_select($campo){
			if($campo != 'seleccionar'){
				return false;
			}else{
				return true;
			}
		}		
		
		private function validar_img($img){
			if($img["type"] != 'image/gif' && $img["type"] != 'image/jpg' && $img["type"] != 'image/jpeg' && $img["type"] != 'image/png' && $img["type"] != 'image/pjpeg'){
				return "Error en la carga de imagenes: solo se permiten formatos jpg, jpeg, gif y png";}elseif( ($img["size"] / (1024 * 1024) ) > 2.0){return "Error en la carga de imagenes: la imagen debe pesar menos de 2 Mb";
			}else{
				return false;
			}
		}
	}