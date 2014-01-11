<?php

	class Museo {
		var $nombre;
		var $direccion;
		var $mail;
		var $imagen;
		var $value;
		var $accionBooleano;
		var $resultado = false;
		var $mensajeResultado = '';
		var $id;

		function __construct($museo){
			$this->nombre = $museo['nombre'];
			$this->direccion = $museo['direccion'];
			$this->mail = $museo['mail'];
			$this->imagen = $museo['imagen'];
			$this->accionBooleano = $museo['tipoForm'];
			$this->id = $museo['id'];
		}

		private function settingMuseo(){
			// define el value para insertar en la base de datos
			$this->nombre = utf8_encode(trim($this->nombre));
			$this->value = str_replace(" ", "_", $this->nombre);
			$this->direccion = utf8_encode($this->direccion);

			if($this->accionBooleano == 0 || ($this->accionBooleano == 1 && $this->imagen["error"] == 0) ){
			// configurando los parametros de la imagen para ser usados despues
				$img = explode(".",$this->imagen['name']);
				$this->imagen['saveName'] = $img[0].microtime(true).'.'.$img[1];
				$this->imagen['name'] = $img[0];
			}
		}

		public function editarMuseo(){
			$this->settingMuseo();
			if($this->imagen["error"] == 0){
				$imagenYSrc = "imagen='".$this->imagen['name']."',src='".$this->imagen['saveName']."'";				
				$imagenABorrarQuery = "SELECT src from museos WHERE id=".$this->id;
				$imagenABorrarSrc = new Queries($imagenABorrarQuery);
				$imagenABorrarSrc->select();
				$imagenABorrarSrc = $imagenABorrarSrc->resultado[0]['src'];
			}else{
				$imagenYSrc = '';
				$imagenABorrarSrc = false;
			}
			
			$query = "UPDATE museos SET nombre='".$this->nombre."', value='".$this->value."', direccion='".$this->direccion."' , mail='".$this->mail."', $imagenYSrc WHERE id=".$this->id.";";
			

			$editarMuseo = new Queries($query);
			$editarMuseo->update();
			$this->resultado = $editarMuseo->resultado;
			if($this->resultado == true){
				$this->moverImagen('El museo ha sido editado con exito',$imagenABorrarSrc);
			}else{
				$this->mensajeResultado = 'Error en la edicion del museo.';
			}

		}

		public function insertarMuseo(){
			$this->settingMuseo();
			
			$query = "INSERT INTO museos VALUES(null, '".$this->nombre."', '".$this->value."', '".$this->direccion."', '".$this->mail."', '".$this->imagen['name']."', '".$this->imagen['saveName']."')";

			$insertarMuseo = new Queries($query);
			$insertarMuseo->insert();
			$this->resultado = $insertarMuseo->resultado;

			if($this->resultado == true){
				$this->moverImagen('El nuevo museo ha sido cargado con exito.',false);
			}else{
				$this->mensajeResultado = "Ha ocurrido un error al crear el nuevo museo.";
			}

		}

		private function moverImagen($mensaje,$oldSrc){
			$this->mensajeResultado = $mensaje;
			if($this->imagen["error"] == 0){
				// moviendo la imagen, si es exitoso se crea el registro en la base de datos
				if (!file_exists('../Museos_images')){
					mkdir("../Museos_images");
				}
			  	
			  	$carpetaYarchivo = "../Museos_images/".$this->imagen['saveName'];
				if( move_uploaded_file($this->imagen['tmp_name'], $carpetaYarchivo) ){
					// el archivo se movió correctamente
					$this->mensajeResultado = $mensaje;
				}else{
					// la imagen no se insertó correctamente
					$this->resultado = false;
					$this->mensajeResultado = 'Error al subir la imagen.';
				}
			}
			if($oldSrc != false){
				if(file_exists('../Museos_images/'.$oldSrc)){
					unlink('../Museos_images/'.$oldSrc);
				}
			}
		}

	}