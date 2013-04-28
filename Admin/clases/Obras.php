<?php

	class Obras {
		var $categorias;
		var $autores;
		var $museos;

		public function traer_requerimientos(){
			$query = 'SELECT autores.nombre as autor, categorias.nombre as categoria, museos.nombre as museo FROM autores, categorias, museos';
			$select = new Queries();
		}

	}