<?php
	include_once("../interfaces/IObra.php");
	
	class Obra implements IObra{
		var $titulo;
		var $descripcion;
		var $autor;
		var $anio;
		var $categoria;
		var $museo;
		var $imagen;
		var $mail;
		var $seudonimo;
		var $accionBooleano;
		private $parametrosObra;
		var $resultado = false;
		var $mensajeResultado = '';
		var $id;

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
			$this->accionBooleano = $obra['tipoForm'];
			$this->id = $obra['id'];
		}

		private function settingObra(){
			// levanta los id's del autor, categoria y museo
			$this->parametrosObra = array(
				0 => array('autores' => $this->autor),
				1 => array('categorias' => $this->categoria),
				2 => array('museos' => $this->museo)
			);
			$this->parametrosObra = $this->crearQueries($this->parametrosObra);
			
			// define el parametro de seudonimo a insertar en la base de datos
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
			
			if($this->accionBooleano == 0 || ($this->accionBooleano == 1 && $this->imagen["error"] == 0) ){
			// configurando los parametros de la imagen para ser usados despues
				$img = explode(".",$this->imagen['name']);
				$this->imagen['saveName'] = $img[0].microtime(true).'.'.$img[1];
				$this->imagen['name'] = $img[0];
			}		
			
		}

		public function insertarObra(){
			$this->settingObra();
			$query = "INSERT INTO obras VALUES(
				null,
				'".$this->titulo."',
				'".str_replace(" ","_",$this->titulo)."',
				'".$this->imagen['name']."',
				'".$this->imagen['saveName']."',
				'".$this->descripcion."',
				".$this->anio.",
				".$this->parametrosObra[1][0]['id'].",
				".$this->parametrosObra[0][0]['id'].",
				".$this->parametrosObra[2][0]['id'].",
				".$this->seudonimo.",
				".$this->mail.");";
			
			$nuevaObra = new Queries($query);
			$nuevaObra->insert();
			$this->resultado = $nuevaObra->resultado;
			if($this->resultado == true){
				$this->moverImagen('La nueva obra ha sido cargada con exito.',false);
			}else{
				$this->mensajeResultado = 'Error en la insercion de la obra en la base de datos';
			}
			
		}

		public function editarObra(){
			$this->settingObra();
			if($this->imagen["error"] == 0){
				// al no hber error, hay una nueva imagen, por lo cual se crea el fragmento de la query para adherirlo
				// a la query final a ejecutar. Ademas se busca el src de la imagen vieja para borrarla de la carpeta.
				// this->id se pide siempre cuando se envia un formulario, pero solo se usa para la edicion
				// si se hace un var dump de $this->id en insercion de obra tira null.
				$imagenYSrc = "imagen='".$this->imagen['name']."',src='".$this->imagen['saveName']."', ";
				
				$imagenABorrarQuery = "SELECT src from obras WHERE id=".$this->id;
				$imagenABorrarSrc = new Queries($imagenABorrarQuery);
				$imagenABorrarSrc->select();
				$imagenABorrarSrc = $imagenABorrarSrc->resultado[0]['src'];
			}else{
				$imagenYSrc = '';
				$imagenABorrarSrc = false;
			} 
			
			
			$query = "UPDATE obras SET 
			nombre='".$this->titulo."', 
			value='".str_replace(" ","_",$this->titulo)."', 
			".$imagenYSrc." descripcion='".$this->descripcion."', 
			".utf8_decode("año")."=".$this->anio.", 
			categoria=".$this->parametrosObra[1][0]['id'].", 
			autor=".$this->parametrosObra[0][0]['id'].", 
			museo=".$this->parametrosObra[2][0]['id'].", 
			seudonimo=".$this->seudonimo.", 
			mail=".$this->mail." WHERE id=".$this->id.";";

			$editarObra = new Queries($query);
			$editarObra->update();
			$this->resultado = $editarObra->resultado;
			if($this->resultado == true){
				$this->moverImagen('La obra ha sido editada con exito',$imagenABorrarSrc);
			}else{
				$this->mensajeResultado = 'Error al realizar la edicion de la obra.';
			}
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

		private function moverImagen($mensaje,$oldSrc){
			$this->mensajeResultado = $mensaje;
			if($this->imagen["error"] == 0){
				// moviendo la imagen, si es exitoso se crea el registro en la base de datos
				if (!file_exists('../Obras_images')){
					mkdir("../Obras_images");
				}
			  	
			  	$carpetaYarchivo = "../Obras_images/".$this->imagen['saveName'];
				if( move_uploaded_file($this->imagen['tmp_name'], $carpetaYarchivo) ){
					// el archivo se movió correctamente
					$this->mensajeResultado = $mensaje;
				}else{
					// la imagen no se insertó correctamente, llamar a la clase Error
					$this->resultado = false;
					$this->mensajeResultado = 'Error al subir la imagen.';
				}
			}
			if($oldSrc != false){
				if(file_exists('../Obras_images/'.$oldSrc)){
					unlink('../Obras_images/'.$oldSrc);
				}
			}
		}
	}

