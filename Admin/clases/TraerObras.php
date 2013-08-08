<?php

	class TraerObras {
		var $autores;
		var $categorias;		
		var $museos;
		var $respuesta;

		public function traer_requerimientos(){
			$query_autores = 'SELECT autores.nombre as autor, autores.value as valor, autores.seudonimo seudonimo FROM autores';
			$query_cat = 'SELECT categorias.nombre as categoria, categorias.value as valor FROM categorias';
			$query_museos = 'SELECT museos.nombre as museo, museos.value as valor FROM museos';

			$select_autores = new Queries($query_autores);
			$select_cat = new Queries($query_cat);
			$select_museos = new Queries($query_museos);

			$select_autores->select();
			$select_cat->select();
			$select_museos->select();

			$this->autores = $select_autores->resultado;
			$this->categorias = $select_cat->resultado;
			$this->museos = $select_museos->resultado;

			// chequea si hay autores, categorias y museos cargados. Si hay al menos 1 de c/u cargado devuelve true, sino devuelve false.
			if($this->autores !== false && $this->categorias !== false && $this->museos !== false){
				$this->respuesta = true;
			}else{
				$this->respuesta = false;
			}


		}

	}