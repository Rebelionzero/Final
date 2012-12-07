<?php
	
	session_start();
	
	include_once('conexion.php');
	include_once('guardar_db.php');

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

	$errores = array(
		'producto' => validar_producto($producto['producto']),
		'precio' => validar_precio($producto['precio']),
		'categoria' =>validar_select($producto['categoria'],'debe seleccionar una categoria'),
		'marca' =>validar_select($producto['marca'],'debe seleccionar una marca'),
		'imagen' =>validar_img($producto['imagen'])
	);

	setear_errores($errores,$producto);

	function validar_producto($campo){
		if(strlen($campo) > 0 && strlen($campo) < 31){			
			if(preg_match('/^\pL+$/u', $campo)){
				return false;
			}else{
				return 'solo se puede ingresar texto como nombre de producto';
			}
		}elseif(strlen($campo) < 1){
			return 'debe llenar el campo producto';
		}elseif(strlen($campo) > 30){
			return 'el campo porducto no debe tener mas de 30 caracteres';
		}
	}


	function validar_precio($campo){
		if(!is_numeric($campo)){			
			return 'debe ingresar un numero';
		}else{
			$campo = intval($campo);
			if($campo < 1 || $campo > 999){
				return 'el numero debe ser entero positivo entre 1 y 999';
			}else{
				return false;
			}
		}
	}

	function validar_select($campo,$error){
		if($campo != 'seleccionar'){
			return false;
		}else{
			return $error;
		}
	}

	
	function validar_img($img){
		
		if ($img["error"] > 0){
  			return "Error en la carga de imagenes: no se ha subido ninguna imagen";
		}elseif($img["type"] != 'image/gif' && $img["type"] != 'image/jpg' && $img["type"] != 'image/jpeg' && $img["type"] != 'image/png' && $img["type"] != 'image/pjpeg'){
  			return "Error en la carga de imagenes: solo se permiten formatos jpg, jpeg, gif y png";
  		}elseif( ($img["size"] / (1024 * 1024) ) > 2.0){
  			return "Error en la carga de imagenes: la imagen debe pesar menos de 2 Mb";
  		}else{
  			// subida de imagen y confirmacion
  			return false;
		}
	}

	function setear_errores($array,$producto){
		$devolucionErrores = array();
		foreach ($array as $error => $valor) {
			if ($valor == false) {
				continue;
			}else{
				array_push($devolucionErrores, $valor);
			}
		}

		if(count($devolucionErrores) > 0){
			$_SESSION['errores'] = $devolucionErrores;
			header('Location: admin.php');
			
		}else{
			// cambio de nombre a la imagen para que no se pise en la carpeta
			$img = explode(".",$producto['imagen']['name']);
			$producto['imagen']['saveName'] = $img[0].microtime(true).'.'.$img[1];
			$producto['imagen']['name'] = $img[0];
  			$carpetaYarchivo = "Prod images/".$producto['imagen']['saveName'];
			move_uploaded_file($producto['imagen']['tmp_name'], $carpetaYarchivo);
			
			$conectar = conectar_bd();
			$save_db = save_prod_in_db('INSERT INTO productos VALUES (null, "'.$producto['producto'].'" ,'.$producto['precio'].',"'.$producto['descripcion'].'","'.$producto['imagen']['name'].'","'.$producto['imagen']['saveName'].'",'.$producto['categoria'].','.$producto['marca'].');',$conectar);
			

		}
		
	}
?>