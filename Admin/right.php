<?php
	if($errores != false){
		echo '<div>';
		echo '<a id="cerrar_error_msg" href="#">cerrar</a>';
		foreach ($errores as $error => $codigo) {
			echo '<p>'.$codigo.'</p>';
		}
		echo '</div>';
	}
	
	if($exito != false){
		echo '<div>';		
			echo $exito;
			echo '<a href="#" id="carga_exitosa_msg">cerrar</a>';
		echo '</div>';
	}
 
?>
<div class="right" id="right">
	<div class="right_content">
		<h2>Bienvenido al panel de administracion de ShopSmart, para comenzar seleccione una opcion del menu izquierdo.</h2>
	</div>	
</div>