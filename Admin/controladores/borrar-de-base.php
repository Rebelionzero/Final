<?php

	include_once('../autoloader.php');
	session_start();

	if(isset($_POST['obra'])){
		$value = $_POST['obra'];
		borrarObraDeBase($value);
	}

	if(isset($_POST['categoria'])){
		$value = $_POST['categoria'];
		borrarCategoriaDeBase($value);
	}



	function borrarObraDeBase($id){
			
		$query = "DELETE FROM obras WHERE id = '".$id."'";

		$imagen_query = "SELECT src FROM obras WHERE id ='".$id."'";
		$select_img = new Queries($imagen_query);
		$select_img->select();

		$borrar = new Queries($query);
		$borrar->delete();
		// ESTOY ASUMIENDO QUE TODO SALIÓ BIEN, CREAR UNA INSTANCIA EN EL CASO DE QUE NO EXISTA LA OBRA APRA SER BORRADA

		if( file_exists("../Obras_images/".$select_img->resultado[0]['src']) ){
			if( unlink("../Obras_images/".$select_img->resultado[0]['src']) ){
				// borrado de imagen exitoso
				$unlink_img = true;
				$mensaje = "La obra ha sido borrada exitosamente.";
			}else{
				// borrado de imagen no exitoso
				$unlink_img = false;
				$mensaje = "La obra ha sido borrada exitosamente de la base de datos, pero la imagen correspondiente a ella, no pudo ser borrada.";
			}
		}else{
			// llamar a mensaje html tipo info que diga que la imagen no existe, pero fue borrada de la base
			$unlink_img = false;
			$mensaje = "La obra ha sido borrada exitosamente de la base de datos, pero la imagen correspondiente a ella, no existe.";
		}

		$mensaje_exito = new MensajeHTML($mensaje);
		if($unlink_img === true){
			$mensaje_exito->mensajeExito();
		}else{
			$mensaje_exito->mensajeAlert();
		}
		$_SESSION['borrado_exitoso'] = $mensaje_exito;
		header("Location: ../vistas/obras.php");
	}

	function borrarCategoriaDeBase($id){
		// verificar que la categoria no este en uso por una obra
		$usoQuery = "SELECT id FROM obras WHERE categoria=".$id;
		$selectObra = new Queries($usoQuery);
		$selectObra->select();
		
		if( $selectObra->resultado != false ){
			// signigica que la categoria esta en uso y no se puede borrar
			$mensaje = 'La categoria que intentó borrar esta siendo usada por una o mas obras.';
			$mensajeRespuesta = new MensajeHTML($mensaje);
			$mensajeRespuesta->mensajeAlert();
		}else{
			$borrarQuery = "DELETE FROM categorias WHERE id=".$id;
			$borrarCategoria = new Queries($borrarQuery);
			$borrarCategoria->delete();

			if($borrarCategoria->resultado === true){
				//se borro bien de la base de datos
				$mensaje = 'La categoria se ha borrado exitosamente.';
				$mensajeRespuesta = new MensajeHTML($mensaje);
				$mensajeRespuesta->mensajeExito();
			}else{
				// hubo un error al borrar la categoria de la base
				$mensaje = 'Se produjo un error al borrar la categoria elegida.';
				$mensajeRespuesta = new MensajeHTML($mensaje);
				$mensajeRespuesta->mensajeError();
			}
		}
		$_SESSION['borrado_exitoso'] = $mensajeRespuesta;
		header("Location: ../vistas/categorias.php");

	}


	
?>