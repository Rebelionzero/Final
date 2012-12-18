<?php
	
	session_start();
	
	include_once('conexion.php');
	include_once('guardar_db.php');

	if(isset($_SESSION['errores'])){
		unset($_SESSION['errores']);
	}

	$producto = array(
		'producto' => $_POST['producto'],
		'precio' => $_POST['precio'],
		'categoria' => $_POST['categoria'],
		'marca' => $_POST['marca'],
		'descripcion' => $_POST['descripcion'],
		'imagen' => $_FILES['imagen'],
		'id' => $_POST['hidden']
	);

	$vacios = array(
		'producto' => vacio($producto['producto']),
		'precio' => vacio($producto['precio']),
		'descripcion' => vacio($producto['descripcion']),
		'categoria' => validar_select($producto['categoria']),
		'marca' => validar_select($producto['marca']),
		'imagen' => sinImagen($producto['imagen'])
	);

	$errores = array(
		'producto' => validar_producto($producto['producto']),
		'precio' => validar_precio($producto['precio']),
		'imagen' =>validar_img($producto['imagen'])
	);

	function vacio($string){
    	return (!isset($string) || trim($string) ==='');
	}

	function sinImagen($img){
		if($img['error'] == 4){return true;}else{return false;}	
	}


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

	function validar_select($campo){
		if($campo != 'seleccionar'){
			return false;
		}else{
			return true;
		}
	}

	
	function validar_img($img){
		
		if($img["type"] != 'image/gif' && $img["type"] != 'image/jpg' && $img["type"] != 'image/jpeg' && $img["type"] != 'image/png' && $img["type"] != 'image/pjpeg'){
  			return "Error en la carga de imagenes: solo se permiten formatos jpg, jpeg, gif y png";
  		}elseif( ($img["size"] / (1024 * 1024) ) > 2.0){
  			return "Error en la carga de imagenes: la imagen debe pesar menos de 2 Mb";
  		}else{
  			return false;
		}
	}

	setear_errores($errores,$producto,$vacios);

	function setear_errores($array,$producto,$vacios){

		$devolucionErrores = array();

		$campo_producto = $vacios['producto'];
		$campo_precio = $vacios['precio'];
		$campo_descripcion = $vacios['descripcion'];
		$campo_categoria = $vacios['categoria'];
		$campo_marca = $vacios['marca'];
		$campo_imagen = $vacios['imagen'];

		if($campo_producto === true){
			$ingresar_producto = '';
		}else{
			if($array['producto'] == false){
				$ingresar_producto = "SET nombre=".$producto['producto'];
			}else{
				echo 'array_push($devolucionErrores, $valor)';
			}
		}

		/*foreach ($vacios as $campoVacio => $value) {
			if ($value === true) {
				continue;
			}else{

			}
		}

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
				$img = explode(".",$producto['imagen']['name']);
				$producto['imagen']['saveName'] = $img[0].microtime(true).'.'.$img[1];
				$producto['imagen']['name'] = $img[0];
				if (!file_exists('/Prod_images')){
					mkdir("Prod_images");
				}
  				$carpetaYarchivo = "Prod_images/".$producto['imagen']['saveName'];
				move_uploaded_file($producto['imagen']['tmp_name'], $carpetaYarchivo);
				
				$conectar = conectar_bd();
				$save_db = save_prod_in_db('INSERT INTO productos VALUES (null, "'.$producto['producto'].'" ,'.$producto['precio'].',"'.$producto['descripcion'].'","'.$producto['imagen']['name'].'","'.$producto['imagen']['saveName'].'",'.$producto['categoria'].','.$producto['marca'].');',$conectar);
		}*/

	}


?>