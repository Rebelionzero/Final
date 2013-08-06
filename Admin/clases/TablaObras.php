<?php

	Class TablaObras extends DibujarTabla{
		var $th;
		var $content;
		var $table;

		function __construct($data){
			$this->content = $data;
		}

		public function crearTabla(){
			$this->table = $this->StartTable("lista_obras");
			$this->table .= $this->StartTr();
			$this->table .= $this->Th($titulos = array("Obra","Autor","Descripción","Año","¿Usa Seudonimo?","Categoria","Museo","Mail para contacto","Imagen","Editar","Borrar"));
			$this->table .= $this->EndTr();

			foreach($this->content as $obras => $obra) {
				$this->table .= $this->StartTr();
				
				$this->table .= $this->Td($obra['obra']);
				$this->table .= $this->Td($obra['autor']);
				$this->table .= $this->Td($obra['descripcion']);
				$this->table .= $this->Td($obra['anio']);
				$this->table .= $this->TdAttr( $this->usaSeudonimo($obra['seudonimo'],$obra['autor']) );
				$this->table .= $this->Td($obra['categoria']);
				$this->table .= $this->Td($obra['museo']);
				$this->table .= $this->Td(  $this->mailUsar($obra['mail']) );
				$this->table .= $this->Td('<div class="img-container"><img src="../Obras_images/'.$obra['src'].'" alt="'.$obra['alt'].'"/></div>');
				$this->table .= $this->Td('<a href="#" class="Editar Obra-'.$obra['id'].'">Editar</a>');
				$this->table .= $this->Td('<form action="../controladores/borrar-obra-de-base.php" method="POST" enctype="multipart/form-data"><fieldset><a href="#" class="Borrar">Borrar</a><input type="hidden" name="obra" value="'.$obra['valor'].'"/></fieldset></form>');

				$this->table .= $this->EndTr();
			}
			$this->table .= $this->EndTable();
		}

		private function usaSeudonimo($data,$autor){
			if($data == 0){
				return $data = array(0 => 'No',1 => '');
			}else{
				$query = "SELECT seudonimo FROM autores WHERE nombre='".$autor."'";
				$seud = new Queries($query);
				$seud->select();
				$data = array(0 => 'Si',1 => 'class="tooltipData" data-title="'.$seud->resultado[0]['seudonimo'].'"');
				return $data;
			}
		}

		private function mailUsar($data){
			$respuesta = "Mail del ";
			return $respuesta .= ($data == 0) ? "Autor" : "Museo";
		}

	}