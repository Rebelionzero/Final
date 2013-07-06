<?php include_once('../controladores/variables-formulario-obras.php'); ?>
<form id="obras-form" class="obras" method="post" enctype="multipart/form-data" action="../controladores/controlador-obras.php">
	<fieldset>
		<h2>Campos Obligatorios</h2>
		<div class="primera-linea">
			<label for="titulo">Titulo:</label>
			<?php echo $value_titulo; ?>
			<label for="desc">Descripcion:</label>
			<textarea id="desc" rows="3" cols="1" name="descripcion"><?php echo $value_desc; ?></textarea>
		</div>
		<div class="segunda-linea">
			<div>
				<label for="autor">Autor:</label>
				<select id="autor" name="autor">
					<option value="seleccione">Seleccione un autor</option>
					<?php echo $option_autores; ?>
				</select>
				<label for="anio">Año:</label>
				<select id="anio" name="anio">
					<option value="seleccione">Seleccione un año</option>
					<?php echo $option_anio; ?>
				</select>
			</div>
			<div>
				<label for="categoria">Categoria:</label>
				<select id="categoria" name="categoria">
					<option value="seleccione">Seleccione una categoria</option>
					<?php echo $option_cate?>
				</select>
				<label for="museo">Museo:</label>
				<select id="museo" name="museo">
					<option value="seleccione">Seleccione un museo</option>
					<?php echo $option_museo; ?>
				</select>
			</div>
			<div>
				<label for="imagen">Imagen:</label>
				<input id="imagen" type="file" name="imagen" />
			</div>
		</div>		
	</fieldset>	
	<fieldset class="opciones">
		<h2>Opciones de autor:</h2>
		<div class="mail-container">
			<div>
				<?php echo $radio_autor; ?>					
				<label for="mail-autor">Utilizar mail del autor</label>
			</div>
			<div>
				<?php echo $radio_museo; ?>					
				<label for="mail-museo">Utilizar mail del museo</label>
			</div>
		</div>
		<div class="seudonimo-container">
			<div>
				<?php echo $checkbox; ?>
				<label for="seudonimo">Utilizar seudonimo del autor si este lo posee:</label>
				<p class="no-seu none">El autor/a seleccionado/a no tiene seudonimo disponible</p>
			</div>
			<p class="warn none"><span class="label label-warning">Advertencia:</span> Si el autor utiliza su seudonimo, el mail que figurará en el site será el del museo</p>
		</div>			
	</fieldset>
	<fieldset class="botones">
		<input type="submit" value="Cargar" class="btn btn-primary" />
		<a class="btn clear-fields" href="#">Limpiar Campos</a>
	</fieldset>	
</form>