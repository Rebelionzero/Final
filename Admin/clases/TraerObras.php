<?php

	class TraerObras {
		var $autores;
		var $categorias;		
		var $museos;
		var $respuesta;

		public function traer_requerimientos(){
			$query_autores = 'SELECT autores.nombre as autor FROM autores';
			$query_cat = 'SELECT categorias.nombre as categoria FROM categorias';
			$query_museos = 'SELECT museos.nombre as museo FROM museos';

			$select_autores = new Queries($query_autores);
			$select_cat = new Queries($query_cat);
			$select_museos = new Queries($query_museos);

			$select_autores->select();
			$select_cat->select();
			$select_museos->select();

			$this->autores = $select_autores->resultado;
			$this->categorias = $select_cat->resultado;
			$this->museos = $select_museos->resultado;

			if($this->autores !== false && $this->categorias !== false && $this->museos !== false){
				$this->respuesta = true;
			}else{
				$this->respuesta = false;
			}


		}

	}