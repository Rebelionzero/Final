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
		'descripcion' => validar_descripcion($producto['descripcion']),
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
			return 'debe ingresar un numero como precio';
		}else{
			$campo = intval($campo);
			if($campo < 1 || $campo > 999){
				return 'el numero debe ser entero positivo entre 1 y 999';
			}else{
				return false;
			}
		}
	}

	function validar_descripcion($campo){
		if(trim(strlen($campo)) > 200){return "La descripcion no puede tener mas de 200 caracteres";}else{return false;}
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

	function setear_errores($errores,$producto,$vacios){
		echo $producto['id'];

		$devolucionErrores = array();
		$ingresar_producto = array();

		$campo_producto = $vacios['producto'];
		$campo_precio = $vacios['precio'];
		$campo_descripcion = $vacios['descripcion'];
		$campo_categoria = $vacios['categoria'];
		$campo_marca = $vacios['marca'];
		$campo_imagen = $vacios['imagen'];
	
		echo '<br />';
		echo 'y aca tambien';
		if($campo_producto === true){
			$ingresar_producto['nombre'] = '';
		}else{
			if($errores['producto'] == false){
				$ingresar_producto['nombre'] = "nombre='".$producto['producto']."'";
			}else{
				array_push($devolucionErrores, $errores['producto']);
			}
		}
		
		if($campo_precio === true){
			$ingresar_producto['precio'] = '';
		}else{
			if($errores['precio'] == false){
				$ingresar_producto['precio'] = "precio=".$producto['precio'];
			}else{
				array_push($devolucionErrores, $errores['precio']);
			}
		}
		
		if($campo_descripcion === true){
			$ingresar_producto['descripcion'] = '';
		}else{
			if($errores['descripcion'] == false){
				$ingresar_producto['descripcion'] = "descripcion='".$producto['descripcion']."'";
			}else{
				array_push($devolucionErrores, $errores['descripcion']);
			}
		}	
		
		if($campo_categoria === true){
			$ingresar_producto['categoria'] = '';
		}else{
			$ingresar_producto['categoria'] = "categoria=".$producto['categoria'];
		}
		
		if($campo_marca === true){
			$ingresar_producto['marca'] = '';
		}else{
			$ingresar_producto['marca'] = "marca=".$producto['marca'];
		}
		
		if($campo_imagen === true){
			$ingresar_producto['imagen'] = '';
			$ingresar_producto['src'] = '';
		}else{
			if($errores['imagen'] == false){
				
				$img = explode(".",$producto['imagen']['name']);
				$producto['imagen']['saveName'] = $img[0].microtime(true).'.'.$img[1];
				$producto['imagen']['name'] = $img[0];
  				$carpetaYarchivo = "Prod_images/".$producto['imagen']['saveName'];
				
				$ingresar_producto['imagen'] = "imagen='".$producto['imagen']['name']."'";
				$ingresar_producto['src'] = "src='".$producto['imagen']['saveName']."'";
				
			}else{
				array_push($devolucionErrores, $errores['imagen']);
			}
		}
		$contador = 0;
		foreach ($ingresar_producto as $dato => $value) {
			if($value != ''){
				continue;
			}else{
				$contador ++;
			}
		}
		if($contador == 7){
			array_push($devolucionErrores,'Error: Debe ingresar algun dato para editar');
			$_SESSION['errores'] = $devolucionErrores;
			header('Location: admin.php');
		}
		
		
		if(count($devolucionErrores) > 0){
			$_SESSION['errores'] = $devolucionErrores;
			header('Location: admin.php');
		}else{
			$conectar = conectar_bd();
			$old_src = "SELECT src FROM productos WHERE id=".$producto['id'];
			$consulta_old_src = mysql_query($old_src,$conectar);
			
			if(mysql_num_rows($consulta_old_src) > 0){
				while($row = mysql_fetch_assoc($consulta_old_src)){
					$resultado[]=$row;
				}
			}
			
			$query = "UPDATE productos SET ";
		
			foreach ($ingresar_producto as $dato => $valor) {
				if($valor == ''){
					continue;
				}else{
					$query.= $valor.', ';
				}	
			}
			$query = substr($query, 0, -2);
			$query.= " WHERE id=".$producto['id'].";";
			
			$update = mysql_query($query,$conectar);
			
			if( is_bool($update) ){
		 		if($update == true){
		 			if(!$ingresar_producto['imagen'] == ''){
		 				unlink("Prod_images/".$resultado[0]['src']);
						move_uploaded_file($producto['imagen']['tmp_name'], $carpetaYarchivo);
					}
		 			if( isset($_SESSION['edicion_exitosa']) ){unset($_SESSION['edicion_exitosa']);}
					$_SESSION['edicion_exitosa'] = 'El producto se ha editado satisfactoriamente';
					header('Location: admin.php');
		 		}
		 	}
		}

	}


?>