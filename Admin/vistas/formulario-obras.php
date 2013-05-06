<form id="obras-form" method="post" enctype="multipart/form-data" action="obras.php">
	<fieldset>
		<div>
			<label for="autor">Autor:</label>
			<select id="autor" name="autor">
				<?php
					foreach ($requerimientos->autores as $autores => $autor) {
						echo("<option value='".$value = str_replace(' ','_',$autor['autor'])."'>".$autor['autor']."</option>");
					}
				?>
			</select>
			<label for="titulo">Titulo:</label>
			<input id="titulo" type="text" name="titulo" />
		</div>
		<div>
			<label for="imagen">Imagen:</label>
			<input id="imagen" type="file" name="imagen" />
			<label for="anio">Año:</label>
			<select id="anio">
				<?php
					for($i = 1950; $i < ( intval(date(Y)) + 1); $i++ ) {
						echo("<option value='".$i."'>".$i."</option>");
					}
				?>
			</select>
		</div>
		<div>
			
		</div>
	</fieldset>
</form>