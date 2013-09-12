<?php

	class Obra {
		var $titulo;
		var $descripcion;
		var $autor;
		var $anio;
		var $categoria;
		var $museo;
		var $tipo;
		var $imagen;
		var $mail;
		var $seudonimo;
		var $resultado = false;

		function __construct($obra){
			$this->titulo = $obra['titulo'];
			$this->descripcion = $obra['descripcion'];
			$this->autor = $obra['autor'];
			$this->anio = $obra['anio'];
			$this->categoria = $obra['categoria'];
			$this->museo = $obra['museo'];
			$this->imagen = $obra['imagen'];
			$this->mail = $obra['mail'];
			$this->seudonimo = $obra['seudonimo'];
		}

		public function settingObra(){
			$img = explode(".",$this->imagen['name']);
			$this->imagen['saveName'] = $img[0].microtime(true).'.'.$img[1];
			$this->imagen['name'] = $img[0];
			
			if($this->seudonimo === false){
				$this->seudonimo = 0;
			}else{
				$this->seudonimo = 1;
			}

			// continuar por aca, si el mail es museo tiene que ser 1 y si es autor tiene que ser 0
			if($this->mail == 'autor'){
				$this->mail = 0;
			}else{
				$this->mail = 1;
			}
			
			$parametrosObra = array(
				0 => array('autores' => $this->autor),
				1 => array('categorias' => $this->categoria),
				2 => array('museos' => $this->museo)
			);
			
			$parametrosObra = $this->crearQueries($parametrosObra);
			var_dump($parametrosObra);
			/*$categoriaId = "SELECT id FROM categorias WHERE value ='".$this->categoria."'";
			$autorId = "SELECT id FROM autores WHERE value ='".$this->autor."'";
			$museoId = "SELECT id FROM museos WHERE value ='".$this->museo."'";
			
			$categoriaQuery = new Queries($categoriaId);
			$autorQuery = new Queries($autorId);
			$museoQuery = new Queries($museoId);

			$categoriaQuery->select();
			$autorQuery->select();
			$museoQuery->select();*/

			// moviendo la imagen, si es exitoso se crea el registro en la base de datos
			/*if (!file_exists('../Obras_images')){
				mkdir("../Obras_images");
			}

  			$carpetaYarchivo = "../Obras_images/".$this->imagen['saveName'];
			
			if( move_uploaded_file($this->imagen['tmp_name'], $carpetaYarchivo) ){
				// si el archivo se movió correctamente se inserta en la base el registro
				$nuevaObra = new Queries($query);
				$nuevaObra->insert();
				$this->resultado = $nuevaObra->resultado;
			}else{
				// la imagen no se insertó correctamente, llamar a la clase Error
				echo("La imagen no se insertó correctamente.");
			}*/

		}

		public function insertarObra(){
			$query = "INSERT INTO obras VALUES(null,'".$this->titulo."','".str_replace(" ","_",$this->titulo)."','".$this->imagen['name']."','".$this->imagen['saveName']."','".$this->descripcion."',".$this->anio.",".$categoriaQuery->resultado[0]['id'].",".$autorQuery->resultado[0]['id'].",".$museoQuery->resultado[0]['id'].",".$this->seudonimo.",".$this->mail.");";
		}

		public function editarObra(){
			$query = "UPDATE obras SET";
		}

		private function crearQueries($array){
			$arrayRetornable = array();
			$objetos;
			$querySelect;
			for ($i=0; $i < count($array); $i++) { 
				foreach ($array[$i] as $clave => $valor) {
					$querySelect = "SELECT id FROM ".$clave." WHERE value='".$valor."'";
					$objetos = new Queries($querySelect);
					$objetos->select();
					array_push($arrayRetornable, $objetos->resultado);
				}
				$querySelect = '';
			}
			return $arrayRetornable;
		}
	}

