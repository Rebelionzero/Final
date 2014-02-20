<?php
	include_once("../interfaces/ITablas.php");

	Class TablaMuseos extends DibujarTabla implements ITablas{
		var $th;
		var $content;
		var $table;

		function __construct($data){
			$this->content = $data;
		}

		public function crearTabla(){
			$this->table = $this->StartTable("lista_museos");
			$this->table .= $this->StartTr();
			$this->table .= $this->Th($titulos = array("Museo","Direccion","Mail","Imagen","Editar","Borrar"));
			$this->table .= $this->EndTr();

			foreach ($this->content as $museos => $museo) {
				$this->table .= $this->StartTr();
				
				$this->table .= $this->Td($museo['museo']);
				$this->table .= $this->Td($museo['direccion']);
				$this->table .= $this->Td($museo['mail']);
				$this->table .= $this->Td('<div class="img-container"><img src="../Museos_images/'.$museo['src'].'" alt="'.$museo['imagen'].'" /></div>');
				$this->table .= $this->Td('<a href="#" class="Editar Museo-'.$museo['id'].'">Editar</a>');
				$this->table .= $this->Td('<form action="../controladores/borrar-de-base.php" method="POST" enctype="multipart/form-data"><fieldset><a href="#" class="Borrar">Borrar</a><input type="hidden" name="museo" value="'.$museo['id'].'"/></fieldset></form>');

				$this->table .= $this->EndTr();
			}
			$this->table .= $this->EndTable();

		}

	}