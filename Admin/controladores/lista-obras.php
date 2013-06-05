<?php

	include_once("../autoloader.php");
	
	$queryObras = "SELECT obras.nombre obra, autores.nombre autor, obras.descripcion descripcion, obras.seudonimo seudonimo, categorias.nombre categoria, museos.nombre museo, obras.mail mail, obras.imagen alt, obras.src src FROM obras, autores, categorias, museos WHERE obras.autor = autores.id AND obras.categoria = categorias.id AND obras.museo = museos.id";
	$claseQuery = new Queries($queryObras);
	$claseQuery->select();

	if($claseQuery->resultado != false){
		$tabla = new TablaObras($claseQuery->resultado);
		$tabla->crearTabla();
		echo($tabla->table);
		/*
		echo '<table><tr><th>Obra</th><th>Autor</th><th>Descripcion</th><th>Usa Seudonimo?</th><th>Categoria</th><th>Museo</th><th>Contacto a utilizar</th><th>Imagen de la obra</th><th>Editar</th><th>Borrar</th></tr>';
		foreach ($claseQuery->resultado as $obras => $obra) {
			echo '<tr>';
				echo '<td>'.utf8_encode($obra['obra']).'</td>';
				echo '<td>'.utf8_encode($obra['autor']).'</td>';
				echo '<td>'.utf8_encode($obra['descripcion']).'</td>';
				echo '<td>'.utf8_encode($obra['seudonimo']).'</td>';
				echo '<td>'.utf8_encode($obra['categoria']).'</td>';
				echo '<td>'.utf8_encode($obra['museo']).'</td>';
				echo '<td>'.utf8_encode($obra['mail']).'</td>';
				echo '<td><img src="../Obras_images/'.utf8_encode($obra['src']).'" alt="'.utf8_encode($obra['alt']).'"/></td>';
				echo '<td><a href="#" class="Editar">Editar</a></td>';
				echo '<td><a href="#" class="Borrar">Borrar</a></td>';
			echo '</tr>';
		}
		echo '</table>';*/
	}else{
		// nunca deberia llegar aca, pues se llama a la clase Error desde la clase Query
	}
	
	

?>