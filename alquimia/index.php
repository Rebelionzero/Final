<?php
	include_once('conexion.php');
	include_once('traerElementos.php');

	$conectar = new Conexion('localhost','alquimia','root','');
	$conectar->conexion();

	$q = new traerElementos('SELECT id,nombre FROM resultado',$conectar->conexion);
	$q->traerElem();
	$q->get();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Alquimia</title>
	</head>
	<body>
		<h1>Alquimia</h1>
		<form action="procesarCombinacion.php" method="POST" enctype="multipart/form-data">
			<div class="select">
				<select name="elemento1">
					<option value="seleccionar">seleccione un elemento</option>
					<?php
					if($q->elemento != 'error en la consulta a la base de datos')
						foreach ($q->elemento as $array => $valor) {
							echo '<option value="'.$valor['id'].'">'.$valor['nombre'].'</option>';
						}
					?>
				</select>
			</div>
			<div class="select">
				<select name="elemento2">
					<option value="seleccionar">seleccione un elemento</option>
					<?php
					if($q->elemento != 'error en la consulta a la base de datos')
						foreach ($q->elemento as $array => $valor) {
							echo '<option value="'.$valor['id'].'">'.$valor['nombre'].'</option>';
						}
					?>
				</select>
			</div>
			<label for="hay_resultado">Hay resultado????</label>
			<input type="checkbox" name="hay_resultado" id="hay_resultado" />
			<!--
			<?php/*
				echo rand(1,889).'<br />';
				echo rand(1,8).'<br />';
				echo rand(1,112).'<br />';
				// 500 lollipop
				*/
			 ?>-->
		</form>
	</body>
</html>