<?php
	include_once("../interfaces/ITablas.php");

	Class TablaCategorias extends DibujarTabla implements ITablas{
		var $th;
		var $content;
		var $table;

		function __construct($data){
			$this->content = $data;
		}

		public function crearTabla(){
			$this->table = $this->StartTable("lista_categorias");
			$this->table .= $this->StartTr();
			$this->table .= $this->Th($titulos = array("Categoria","Descripción","Editar","Borrar"));
			$this->table .= $this->EndTr();

			foreach ($this->content as $categorias => $categoria) {
				$this->table .= $this->StartTr();
				
				$this->table .= $this->Td($categoria['categoria']);
				$this->table .= $this->Td($categoria['descripcion']);
				$this->table .= $this->Td('<a href="#" class="Editar Categoria-'.$categoria['id'].'">Editar</a>');
				$this->table .= $this->Td('<form action="../controladores/borrar-de-base.php" method="POST" enctype="multipart/form-data"><fieldset><a href="#" class="Borrar">Borrar</a><input type="hidden" name="categoria" value="'.$categoria['id'].'"/></fieldset></form>');

				$this->table .= $this->EndTr();
			}
			$this->table .= $this->EndTable();

		}

	}