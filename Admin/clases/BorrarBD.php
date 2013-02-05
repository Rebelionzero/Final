<?php

	class BorrarBD {
		var $tabla;
		var $id;
		var $nombre;
		var $respuesta;
		var $conectar;

		function __construct($t,$i,$n){
			$this->tabla = $t;
			$this->id = $i;
			$this->nombre = $n;
		}

		function borrar_bd(){
			$conectar = new Conexion();
			$conectar->conectar_bd();
			$conectar->get();
			
			if($this->tabla == 'categorias' || $this->tabla == 'marcas'){

				if($this->tabla == 'categorias'){
					$campo = 'categoria';
				}elseif($this->tabla == 'marcas'){
					$campo = 'marca';
				}
				/* #E0F transformar en llamada a objeto, buscar la forma de llevar cada query a objeto  */
				$comprobar_uso = "SELECT nombre FROM productos WHERE productos.".$campo." =".$this->id." ;";
				$consulta_uso = mysql_query($comprobar_uso, $conectar->conexion);

				if(mysql_num_rows($consulta_uso) > 0){
					while($row = mysql_fetch_assoc($consulta_uso)){
						$resultado[]=$row;
					}

					$this->respuesta = 'Error: La '.$campo. ' no puede ser borrada porque esta siendo utilizada por los siguientes productos: ';

					for ($i=0; $i < count($resultado); $i++) { 
						$this->respuesta .= $resultado[$i]['nombre'].', ';
					}
					$this->respuesta = substr_replace($this->respuesta ,"",-2);
					return $this->respuesta;
				}else{
					$delete = "DELETE FROM ".$this->tabla." WHERE id=".$this->id." AND nombre='".$this->nombre."';";
					$consulta_uso = mysql_query($delete, $conectar->conexion);
					$this->respuesta = 'La '.$campo.' '.$this->nombre.' ha sido borrada exitosamente.';
					return $this->respuesta;
				}
				

				/* Fin de #E0F */
			}elseif($this->tabla == 'productos'){
				$src = "SELECT src FROM productos WHERE id=".$this->id;
				$consulta_src = mysql_query($src, $conectar->conexion);
				
				if(mysql_num_rows($consulta_src) > 0){
					while($row = mysql_fetch_assoc($consulta_src)){
						$resultado[]=$row;
					}
				}			

				$delete = "DELETE FROM ".$this->tabla." WHERE id=".$this->id.";";
				$consulta_delete = mysql_query($delete, $conectar->conexion);
				
				if($consulta_delete != false){
					if(file_exists('Prod_images/'.$resultado[0]['src'])){
						unlink('Prod_images/'.$resultado[0]['src']);
						$this->respuesta = 'El producto'.$this->nombre.' ha sido borrado exitosamente.';
						return $this->respuesta;
					}else{
						$this->respuesta = 'Error: La imagen correspondiente al producto no existe';
						return $this->respuesta;
					}
				}else{
					$this->respuesta = 'Error: el producto no ha podido ser borrado.';
					return $this->respuesta;
				}
			}
			
		}
	}