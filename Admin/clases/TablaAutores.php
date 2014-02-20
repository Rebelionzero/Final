<?php
	include_once("../interfaces/ITablas.php");

	Class TablaAutores extends DibujarTabla implements ITablas{
		var $th;
		var $content;
		var $table;

		function __construct($data){
			$this->content = $data;
		}

		public function crearTabla(){
			$this->table = $this->StartTable("lista_autores");
			$this->table .= $this->StartTr();
			$this->table .= $this->Th($titulos = array("Autor","Seudonimo","Mail","Editar","Borrar"));
			$this->table .= $this->EndTr();

			foreach ($this->content as $autores => $autor) {
				$this->table .= $this->StartTr();
				
				$this->table .= $this->Td($autor['autor']);
				$this->table .= $this->Td($autor['seudonimo']);
				$this->table .= $this->Td($autor['mail']);
				$this->table .= $this->Td('<a href="#" class="Editar Autor-'.$autor['id'].'">Editar</a>');
				$this->table .= $this->Td('<form action="../controladores/borrar-de-base.php" method="POST" enctype="multipart/form-data"><fieldset><a href="#" class="Borrar">Borrar</a><input type="hidden" name="autor" value="'.$autor['id'].'"/></fieldset></form>');

				$this->table .= $this->EndTr();
			}
			$this->table .= $this->EndTable();

		}

	}