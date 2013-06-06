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
			$this->table .= $this->Th($titulos = array("Obra","Autor","Descripción","¿Usa Seudonimo?","Categoria","Museo","Mail para contacto","Imagen","Editar","Borrar"));
			$this->table .= $this->EndTr();

			foreach($this->content as $obras => $obra) {
				$this->table .= $this->StartTr();
				
				$this->table .= $this->Td($obra['obra']);
				$this->table .= $this->Td($obra['autor']);
				$this->table .= $this->Td($obra['descripcion']);
				$this->table .= $this->Td( $this->usaSeudonimo($obra['seudonimo']) );
				$this->table .= $this->Td($obra['categoria']);
				$this->table .= $this->Td($obra['museo']);
				$this->table .= $this->Td(  $this->mailUsar($obra['mail']) );
				$this->table .= $this->Td('<div class="img-container"><img src="../Obras_images/'.$obra['src'].'" alt="'.$obra['alt'].'"/></div>');
				$this->table .= $this->Td('<a href="#" class="Editar">Editar</a>');
				$this->table .= $this->Td('<a href="#" class="Borrar">Borrar</a>');

				$this->table .= $this->EndTr();
			}
			

			$this->table .= $this->EndTable();
		}

		private function usaSeudonimo($data){
			return $respuesta = ($data == 0) ? "No" : "Si";
		}

		private function mailUsar($data){
			$respuesta = "Mail del ";
			return $respuesta .= ($data == 0) ? "Autor" : "Museo";
		}

	}