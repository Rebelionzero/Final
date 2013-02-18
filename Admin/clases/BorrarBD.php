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
			if($this->tabla == 'categorias' || $this->tabla == 'marcas'){

				if($this->tabla == 'categorias'){
					$campo = 'categoria';
				}elseif($this->tabla == 'marcas'){
					$campo = 'marca';
				}
				
				$comprobar_uso = "SELECT nombre FROM productos WHERE productos.".$campo." =".$this->id." ;";
				$consulta_uso = new Queries($comprobar_uso);
				$consulta_uso->select();

				
				if($consulta_uso->resultado !== false){
					$string = 'Error: La '.$campo. ' no puede ser borrada porque esta siendo utilizada por los siguientes productos: ';

					for ($i=0; $i < count($consulta_uso->resultado); $i++) { 
						$string .= $consulta_uso->resultado[$i]['nombre'].', ';
					}
					$string = substr_replace($string ,"",-2);
				}else{

					$queryBorrar = "DELETE FROM ".$this->tabla." WHERE id=".$this->id." AND nombre='".$this->nombre."';";
					$borrar_deBase = new Queries($queryBorrar);
					$borrar_deBase->delete();
					$string = 'La '.$campo.' '.$this->nombre.' ha sido borrada exitosamente.';
					
				}
				$this->respuesta = $string;

				
			}elseif($this->tabla == 'productos'){
				$src = "SELECT src FROM productos WHERE id=".$this->id;
				$consulta_src = new Queries($src);
				$consulta_src->select();				


				$queryBorrar = "DELETE FROM ".$this->tabla." WHERE id=".$this->id.";";
				$borrar_deBase = new Queries($queryBorrar);
				$borrar_deBase->delete();				
				
				if($borrar_deBase->consulta != false){
					if(file_exists('../Prod_images/'.$consulta_src->resultado[0]['src'])){
						unlink('../Prod_images/'.$consulta_src->resultado[0]['src']);
						$this->respuesta = 'El producto'.$this->nombre.' ha sido borrado exitosamente.';						
					}else{
						$this->respuesta = 'Error: La imagen correspondiente al producto no existe, ha sido movida, renombrada, alterada o borrada.';
					}
				}else{
					$this->respuesta = 'Error: el producto no ha podido ser borrado.';					
				}
			}
			
		}
	}