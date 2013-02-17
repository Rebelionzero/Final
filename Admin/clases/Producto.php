<?php

	class Producto {
		var $nombre;
		var $precio;
		var $categoria;
		var $marca;
		var $descripcion;
		var $imagen;
		var $query;
		var $insertar;

		function __construct($array){
			$this->nombre = $array['producto'];
			$this->precio = $array['precio'];
			$this->categoria = $array['categoria'];
			$this->marca = $array['marca'];
			$this->descripcion = $array['descripcion'];
			$this->imagen = $array['imagen'];
		}

		public function moverImagen (){

			$img = explode(".",$this->imagen['name']);
				$this->imagen['saveName'] = $img[0].microtime(true).'.'.$img[1];
				$this->imagen['name'] = $img[0];


				
				$this->query = 'INSERT INTO productos VALUES (n,"'.$this->nombre.'" ,'.$this->precio.',"'.$this->descripcion.'","'.$this->imagen['name'].'","'.$this->imagen['saveName'].'",'.$this->categoria.','.$this->marca.');';
				$this->insertar = new Queries($this->query);
				$this->insertar->insert();

				if($this->insertar->resultado === true){
					if (!file_exists('../Prod_images')){
						mkdir("../Prod_images");
					}
  					$carpetaYarchivo = "../Prod_images/".$this->imagen['saveName'];
					move_uploaded_file($this->imagen['tmp_name'], $carpetaYarchivo);
				}
		}

	}