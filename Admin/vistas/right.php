<?php
	if($errores != false){
		echo '<div class="mensaje_error alert alert-error container error_php">';
		echo '<a id="cerrar_error_msg" class="close" href="#">x</a>';
		foreach ($errores as $error => $codigo) {
			echo '<h3>'.$codigo.'</h3>';
		}
		echo '</div>';
	}
	
	if($exito != false){
		echo '<div class="mensaje_exito alert alert-success container exito_php">';
			echo '<a href="#" id="carga_exitosa_msg" class="close">x</a>';
			echo '<h3>'.$exito.'</h3>';
		echo '</div>';
	}
 
?>
