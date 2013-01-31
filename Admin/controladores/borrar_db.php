<?php
	include_once("conexion.php");
	
	$tabla = $_POST['tabla'];
	$id = $_POST['id'];
	if($tabla == 'productos'){
		$nombre = '';
	}else{
		$nombre = $_POST['nombre'];
	}

	function borrar_bd($conexion,$tabla,$id,$nombre){
		if($tabla == 'categorias' || $tabla == 'marcas'){

			if($tabla == 'categorias'){
				$campo = 'categoria';
			}elseif($tabla == 'marcas'){
				$campo = 'marca';
			}
			$comprobar_uso = "SELECT nombre FROM productos WHERE productos.".$campo." =".$id." ;";
			$consulta_uso = mysql_query($comprobar_uso, $conexion);

			if(mysql_num_rows($consulta_uso) > 0){
				while($row = mysql_fetch_assoc($consulta_uso)){
					$resultado[]=$row;
				}

				$devolver = 'Error: La '.$campo. ' no puede ser borrada porque esta siendo utilizada por los siguientes productos: ';

				for ($i=0; $i < count($resultado); $i++) { 
					$devolver .= $resultado[$i]['nombre'].', ';
				}
				$devolver = substr_replace($devolver ,"",-2);
				return $devolver;
			}else{
				$delete = "DELETE FROM ".$tabla." WHERE id=".$id." AND nombre='".$nombre."';";
				$consulta_uso = mysql_query($delete, $conexion);
				return 'La '.$campo.' '.$nombre.' ha sido borrada exitosamente.';
			}
		}elseif($tabla == 'productos'){
			$src = "SELECT src FROM productos WHERE id=".$id;
			$consulta_src = mysql_query($src, $conexion);
			
			if(mysql_num_rows($consulta_src) > 0){
				while($row = mysql_fetch_assoc($consulta_src)){
					$resultado[]=$row;
				}
			}			

			$delete = "DELETE FROM ".$tabla." WHERE id=".$id.";";
			$consulta_delete = mysql_query($delete, $conexion);
			
			if($consulta_delete != false){
				if(file_exists('Prod_images/'.$resultado[0]['src'])){
					unlink('Prod_images/'.$resultado[0]['src']);
					return 'El producto'.$nombre.' ha sido borrado exitosamente.';	
				}else{
					return 'Error: La imagen correspondiente al producto no existe';
				}
			}else{
				return 'Error: el producto no ha podido ser borrado.';
			}
		}
	}
	
	$eliminar = borrar_bd($conexion,$tabla,$id,$nombre);
	$enviar = json_encode($eliminar);
	echo $enviar;
?>