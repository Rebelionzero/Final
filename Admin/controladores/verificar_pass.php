<?php
	include_once("../autoloader.php");

	$errores = false;
	$camposSeteados = false;
	if(isset($_SESSION['ErroresPass'])){
		$errores = $_SESSION['ErroresPass'];
		unset($_SESSION['ErroresPass']);
		$errMensaje = new MensajeHTML($errores);
		$errMensaje->mensajeDeError();
	}

	$exito = false;
	if(isset($_SESSION['resultado_cambio'])){
		$exito = $_SESSION['resultado_cambio'];
		unset($_SESSION['resultado_cambio']);
		$exitoMensaje = new MensajeHTML($exito);
		$exitoMensaje->mensajeExito();
		$exito = $exitoMensaje;
	}

	
	$rightEchoPass = "<div class='content_right'>
		<div class='cambiar-pass'>
			<form class='cambio-pass' method='post' action='../controladores/cambiar-pass.php'>
				<fieldset>
					<div>
						<label for='current-pass'>Ingrese contraseña</label>
						<input type='password' id='current-pass' name='pass' />
					</div>
					<div>
						<label for='new-pass'>Nueva contraseña</label>
						<input type='password' id='new-pass' name='new-pass' />
					</div>
					<div>
						<label for='new-pass-repeat'>Repetir nueva contraseña</label>
						<input type='password' id='new-pass-repeat' name='repeat-pass'/>
					</div>
					<input type='submit' class='btn btn-primary' value='Cambiar Contraseña' />
					<a class='btn clear-fields' href='#'>Limpiar Campos</a>
				</fieldset>
			</form>
		</div>";
		
?>