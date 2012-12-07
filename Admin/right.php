<?php
	if(isset($errores)){
		if($errores == true){
			echo '<div id="errores_form_prod">';
			echo '<a id="cerrar_error_msg" href="#">cerrar</a>';
			foreach ($_SESSION['errores'] as $error => $codigo) {
				echo '<p>'.$codigo.'</p>';
			}
			echo '</div>';
		}
	}
 
?>
<div class="right" id="right">
	<div class="right_content">
		<h2>Bienvenido al panel de administracion de ShopSmart, para comenzar seleccione una opcion del menu izquierdo.</h2>
	</div>	
</div>