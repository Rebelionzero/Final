<?php

	if($requerimientos->respuesta == false){
		echo ('<div class="right_content">');
			echo('<h2>Para poder crear una nueva obra es necesaria la creacion previa de al menos un autor, una categoria y un museo</h2>');
		echo('</div>');
	}else{
		if( $errores != false ){echo $errMensaje->output;}
		if( $exito != false ){echo $exito->output;}
		if( $borrado != false ){echo $borrado->output;}
		echo "<div class='tabs'>
				<a href='#' class='tab-cargar focused-tab'>Cargar Obras</a>
				<a href='#' class='tab-lista'>Lista de Obras</a>
			  </div>";
		echo '<div class="right_content_place">';
			echo "<div class='cargar block'>";							
				include_once("formulario-obras.php");
			echo "</div>";
			echo "<div class='lista none'>";
				echo '<div class="lista-de-obras">';
					include_once("../controladores/lista-obras.php");
				echo "</div>";	
			echo "</div>";
		echo '</div>';
	}
?>