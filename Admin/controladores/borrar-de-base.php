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

	if(isset($_POST['autor'])){
		$value = $_POST['autor'];
		borrarAutorDeBase($value);
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
		$mensajeCategoriaUsada = 'La categoria que intentó borrar esta siendo usada por una o mas obras.';
		$location = " ../vistas/categorias.php";
		$borrarQuery = "DELETE FROM categorias WHERE id=".$id;
		$borradoCategoriaExitoso = 'La categoria se ha borrado exitosamente.';
		$borradoCategoriaError ='Se produjo un error al borrar la categoria elegida.';

		verificarUso($usoQuery,$mensajeCategoriaUsada,$location,$borrarQuery,$borradoCategoriaExitoso,$borradoCategoriaError);
	}

	function borrarAutorDeBase($id){
		// verificar que el autor no sea titular de una obra
		$usoQuery = "SELECT id FROM obras WHERE autor=".$id;
		$mensajeAutorEnUso = 'El autor que intentó borrar esta siendo usado por una o mas obras.';
		$location = " ../vistas/autores.php";
		$borrarQuery = "DELETE FROM autores WHERE id=".$id;
		$borradoAutorExitoso = 'El autor se ha borrado exitosamente.';
		$borradoAutorError ='Se produjo un error al borrar el autor seleccionado.';

		verificarUso($usoQuery,$mensajeAutorEnUso,$location,$borrarQuery,$borradoAutorExitoso,$borradoAutorError);

		
	}

	function verificarUso($query,$mensaje,$loc,$borrar,$exito,$error){
		// VERIFICAR PORQUE NO FUNCIONA EL HEADER()

		$selectObra = new Queries($query);
		$selectObra->select();
		if( $selectObra->resultado != false ){
			// signigica que la categoria, autor, o museo esta en uso y no se puede borrar			
			$mensajeRespuesta = new MensajeHTML($mensaje);
			$mensajeRespuesta->mensajeAlert();
			$_SESSION['borrado_exitoso'] = $mensajeRespuesta;
			
			header("Location: ".$loc);
		}else{
			borrarDeBase($borrar,$exito,$error,$loc);
		}

	}

	function borrarDeBase($queryABorrar,$msgExito,$msgError,$loc){
		// VERIFICAR PORQUE NO FUNCIONA EL HEADER()
		$borrarElemento = new Queries($queryABorrar);
		$borrarElemento->delete();

		if($borrarElemento->resultado === true){
			//se borro bien de la base de datos
			$mensajeRespuesta = new MensajeHTML($msgExito);
			$mensajeRespuesta->mensajeExito();
		}else{
			// hubo un error al borrar la categoria de la base			
			$mensajeRespuesta = new MensajeHTML($msgError);
			$mensajeRespuesta->mensajeError();
		}
		$_SESSION['borrado_exitoso'] = $mensajeRespuesta;
		header("Location: ".$loc);
	}

	
?>