<form id="obras-form" method="post" enctype="multipart/form-data" action="obras.php">
	<fieldset>
		<div class="primera-linea">
			<label for="titulo">Titulo:</label>
			<input id="titulo" type="text" name="titulo" />
			<label for="desc">Descripcion:</label>
			<textarea id="desc" rows="3" cols="1"></textarea>
		</div>
		<div class="segunda-linea">
			<div>
				<label for="autor">Autor:</label>
				<select id="autor" name="autor">
					<option value="seleccione">Seleccione un autor</option>
					<?php
						foreach ($requerimientos->autores as $autores => $autor) {
							echo("<option value='".$value = utf8_encode(str_replace(' ','_',$autor['autor']))."'>".utf8_encode($autor['autor'])."</option>");
						}
					?>
				</select>
				<label for="anio">Año:</label>
				<select id="anio" name="anio">
					<option value="seleccione">Seleccione un año</option>
					<?php
						for($i = 1950; $i < ( intval(date('Y')) + 1); $i++ ) {
							echo("<option value='".$i."'>".$i."</option>");
						}
					?>
				</select>
			</div>
			<div>
				<label for="categoria">Categoria:</label>
				<select id="categoria" name="categoria">
					<option value="seleccione">Seleccione una categoria</option>
					<?php
						foreach ($requerimientos->categorias as $categorias => $categoria) {
							echo("<option value='".$value = utf8_encode(str_replace(' ','_',$categoria['categoria']))."'>".utf8_encode($categoria['categoria'])."</option>");
						}
					?>
				</select>
				<label for="museo">Museo:</label>
				<select id="museo" name="museo">
					<option value="seleccione">Seleccione un museo</option>
					<?php
						foreach ($requerimientos->museos as $museos => $museo) {
							echo("<option value='".$value = utf8_encode(str_replace(' ','_',$museo['museo']))."'>".utf8_encode($museo['museo'])."</option>");
						}
					?>
				</select>
			</div>	
		</div>
		<div class="tercera-linea">
			<label for="imagen">Imagen:</label>
			<input id="imagen" type="file" name="imagen" />
			<label for="seudonimo" class="seudonimo">Usar seudonimo en vez de nombre del autor:</label>
			<input type="checkbox" name="seudonimo" id="seudonimo" disabled />
			
			<input type="submit" value="Cargar" class="btn btn-primary">
		</div>		
	</fieldset>
</form>