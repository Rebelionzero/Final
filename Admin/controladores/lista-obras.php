<?php

	$queryObras = "SELECT obras.nombre obra, obras.value valor, autores.nombre autor, obras.descripcion descripcion, obras.seudonimo seudonimo, categorias.nombre categoria, museos.nombre museo, obras.mail mail, obras.imagen alt, obras.src src FROM obras, autores, categorias, museos WHERE obras.autor = autores.id AND obras.categoria = categorias.id AND obras.museo = museos.id ORDER BY obras.id";
	$claseQuery = new Queries($queryObras);
	$claseQuery->select();

	if($claseQuery->resultado != false){
		$tabla = new TablaObras($claseQuery->resultado);
		$tabla->crearTabla();
		echo($tabla->table);
	}else{		
		// No hay ninguna obra cargada
		echo("<h2 class='ninguna-obra'>No hay ninguna obra cargada en este momento</h2>");

	}

?>