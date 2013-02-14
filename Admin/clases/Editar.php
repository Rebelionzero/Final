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


	}