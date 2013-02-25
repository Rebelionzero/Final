<?php
	
	session_start();
	
	include_once('../autoloader.php');

	if(isset($_SESSION['errores'])){
		unset($_SESSION['errores']);
	}

	$producto = array(
		'producto' => $_POST['producto'],
		'precio' => intval($_POST['precio']),
		'categoria' => $_POST['categoria'],
		'marca' => $_POST['marca'],
		'descripcion' => $_POST['descripcion'],
		'imagen' => $_FILES['imagen']
	);

	$comprobarProducto = new ComprobarProducto($producto);
	$comprobarProducto->verificar();
	
	if(count($comprobarProducto->errores) > 0){
		$_SESSION['errores'] = $comprobarProducto->errores;
		header('Location: ../vistas/admin.php');
	}else{
		$productoObjeto = new Producto($producto);
		$productoObjeto->moverImagen();
		if($productoObjeto->insertar->resultado === true){
			if( isset($_SESSION['carga_exitosa']) ){unset($_SESSION['carga_exitosa']);}
			$_SESSION['carga_exitosa'] = 'El producto se ha cargado satisfactoriamente';
		}else{
			
			/*
			if (!file_exists('../Errores_Log')){
				mkdir("../Errores_Log");
			}
			
			$file = fopen("../Errores_Log/errores.txt","a+");

			$fecha = date('D, d M Y H:i:s');
			$errorSql = 'Error devuelto por SQL: '.mysql_error().PHP_EOL.
			 'Query insertada: '.$productoObjeto->query.PHP_EOL.
			 'Fecha: '.$fecha.PHP_EOL.'*********************************************************************'.PHP_EOL.PHP_EOL;

			fwrite($file,$errorSql);
			fclose($file);

			$errores = array(0 => 'Hubo un error al crear el producto en la base de datos,<br /> se ha creado un log de errores donde se detalla.');
			$_SESSION['errores'] = $errores;
		*/
		}
		header('Location: ../vistas/admin.php');
	}

?>