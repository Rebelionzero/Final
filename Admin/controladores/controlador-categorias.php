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
	}

?>