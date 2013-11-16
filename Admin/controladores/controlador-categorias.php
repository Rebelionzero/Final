<?php
	include_once('../autoloader.php');
	session_start();

	// si esta seteado la session errores la dessetea
	if(isset($_SESSION['errores'])){
		unset($_SESSION['errores']);
	}

	if(isset($_POST['nrcate'])){
		$idCate = $_POST['nrcate'];
	}else{
		$idCate = '';
	}

	$campos = array(
		'nombre' => utf8_decode($_POST['categoria']),
		'descripcion' => utf8_decode($_POST['descripcion']),
		'tipoForm' => $_POST['tipo'],
		'id' => $idCate
	);

	// la comprobacion de la categoria en la siguiente linea de codigo me impide avanzar.
	// si una categoria se edita y se mantiene el mismo titulo,me tira error, porque estoy tratando
	// de ingresar un nombre de categoria que ya existe, por lo cual tengo que tratar de que se ignore eso
	// tengo que ver que es mas conveniente, si al entrar en la comprobacion se verifique primero que tipo
	// de formulario es: de edicion o de creacion y despues lanzar clases distintas para c/u, o preguntar  
	// dentro de el metodo que tipo de formulario es y asi verificar desde ahi. La verificacion de la descripcion
	// no parece verse afectada, pues solo se chequea que tenga menos de 255 caracteres.

	/*
	$verificacion = new ComprobarCategoria($campos);
	$verificacion->verificar();

	//var_dump($verificacion->errores);
	if( count($verificacion->errores) > 0 ){
		$_SESSION['ErroresCategorias'] = $verificacion->errores;
		$_SESSION['campos'] = $categoria;
		header('Location: ../vistas/categorias.php');
	}else{
		$categoria = new Categoria($campos);
		if($campos['tipoForm'] == 1){
			// si es 1, quiere decir que la categoria es para editarse, por lo cual se crea un objeto de edicion
			$categoria->settingCategoria();
			$categoria->editarCategoria();

		}elseif($campos['tipoForm'] == 0){
			// si es 0, quiere decir que la categoria es nueva, por lo cual se crea un objeto de creacion
			$categoria->settingCategoria();
			$categoria->insertarCategoria();
		}
		
		if($categoria->resultado === false){
			// ocurrio un error de mysql, llamar a clase Error
			
		}elseif($categoria->resultado === true){
			// salio todo bien, redireccionar a categorias.php
			$exitoMensaje = new MensajeHTML($categoria->mensajeResultado);
			if(strlen($categoria->descripcion) > 0){
				$exitoMensaje->mensajeExito();
			}else{
				$exitoMensaje->mensajeAlert();
			}
			$_SESSION['carga_exitosa'] = $exitoMensaje;
			header('Location: ../vistas/categorias.php');
		}
	}*/

?>