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
		'categoria' => utf8_decode($_POST['categoria']),
		'descripcion' => utf8_decode($_POST['descripcion']),
		'tipoForm' => $_POST['tipo'],
		'id' => $idCate
	);

	$categoria = $campos;
	$verificacion = new ComprobarCategoria($campos);
	$verificacion->verificar();

	if( count($verificacion->errores) > 0 ){
		$_SESSION['ErroresCategorias'] = $verificacion->errores;
		$_SESSION['campos'] = $categoria;
		header('Location: ../vistas/categorias.php');
	}else{
		$categoria = new Categoria($campos);
		if($campos['tipoForm'] == 1){
			// si es 1, quiere decir que la categoria es para editarse, por lo cual se crea un objeto de edicion			
			$categoria->editarCategoria();

		}elseif($campos['tipoForm'] == 0){
			// si es 0, quiere decir que la categoria es nueva, por lo cual se crea un objeto de creacion			
			$categoria->insertarCategoria();
		}
		
		$mensajeParaElUsuario = new MensajeHTML($categoria->mensajeResultado);
		$tipoDeMensaje = ( $categoria->resultado === false ? $mensajeParaElUsuario->mensajeDeError() : $largo = ( strlen($categoria->descripcion) > 0 ? $mensajeParaElUsuario->mensajeExito() : $mensajeParaElUsuario->mensajeAlert() ) );

		$_SESSION['resultado_carga'] = $mensajeParaElUsuario;
		header('Location: ../vistas/categorias.php');
	}

?>