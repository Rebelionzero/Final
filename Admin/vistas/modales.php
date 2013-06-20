<div id="BorrarObrasModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Borrar Obra</h3>
	</div>
	<div class="modal-body">
		<p>¿Esta seguro de que desea borrar la siguiente obra?</p>
		<p class="obra"></p>
		<p class="autor"></p>
	</div>
	<div class="modal-footer">
		<button class="btn btn-danger delete">Borrar</button>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
	</div>
</div>
<div id="EditarObrasModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Editar Obra</h3>
	</div>
	<div class="modal-body">
		<?php include_once("editar-obras.php"); ?>
	</div>
	<div class="modal-footer">
		<button class="btn btn-danger delete">Editar</button>
		<a class="btn clear-fields" href="#">Limpiar Campos</a>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
	</div>
</div>
