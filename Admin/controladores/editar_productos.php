<?php
	
	session_start();
	
	include_once('../autoloader.php');

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

	$edicion = new Editar(array(
		'',
		$producto['id'],
		$producto['producto'],
		$producto['precio'],
		$producto['categoria'],
		$producto['marca'],
		$producto['descripcion'],
		$producto['imagen']
		));
	$edicion->editarProducto();

	/*$vacios = array(
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

	
	
	setear_errores($errores,$producto,$vacios);

	function setear_errores($errores,$producto,$vacios){		

		$devolucionErrores = array();
		$ingresar_producto = array();

		$campo_producto = $vacios['producto'];
		$campo_precio = $vacios['precio'];
		$campo_descripcion = $vacios['descripcion'];
		$campo_categoria = $vacios['categoria'];
		$campo_marca = $vacios['marca'];
		$campo_imagen = $vacios['imagen'];
	
		
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
			$conectar = new Conexion();
			$conectar->conectar_bd();
			$conectar->get();
			$old_src = "SELECT src FROM productos WHERE id=".$producto['id'];
			$consulta_old_src = mysql_query($old_src,$conectar->conexion);
			
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
			
			$update = mysql_query($query,$conectar->conexion);
			
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

*/
?>