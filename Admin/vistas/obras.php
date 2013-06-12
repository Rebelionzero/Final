<?php
	
	include_once("../autoloader.php");

	$conexion = new Conexion();
	$conexion->conectar_bd();
	
	session_start();

	if(!$conexion->conexion){
		header("Location: no_server.php");
	}else{

		if( !isset( $_SESSION['Login']['autenticacion'] ) || $_SESSION['Login']['autenticacion'] === false ){
			header("Location: login.php");
		}elseif( isset( $_SESSION['Login']['autenticacion'] ) && $_SESSION['Login']['autenticacion'] === true){
			// exito en el login, revisar en el futuro que hacer con esta sentencia

			include_once("../controladores/verificar_obras.php");
		}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>****** Admin Panel - Obras</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
		<script type="text/javascript" src="../../ajax-js/jquery.js"></script>
		<script type="text/javascript" src="../../ajax-js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../../ajax-js/admin.js"></script>
		<link type="text/css" rel="stylesheet" media="screen" href="../../CSS/reseteo.css"/>
		<link type="text/css" rel="stylesheet" media="screen" href="../../CSS/bootstrap.min.css"/>
		<link type="text/css" rel="stylesheet" media="screen" href="../../CSS/admin.css"/>
	</head>
	<body class="obras">		
		<div class="head">
			<h1><a href="admin.php"><img alt="admin header" src="../../Images/admin_header.jpg"/></a></h1>
		</div>
		<div class="middle">
			<?php include_once("left.php");?>
			<div class="right" id="right">
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
						echo ('<div class="right_content_place">');
							echo "<div class='cargar block'>";							
								include_once("formulario-obras.php");
							echo "</div>";
							echo "<div class='lista none'>";
								include_once("lista-de-obras.php");
							echo "</div>";
						echo('</div>');
					}
				 ?>
			</div>
		</div>
		<div class="footer"></div>
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
				<button class="btn btn-danger">Borrar</button>
				<button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
			</div>
		</div>
	</body>
</html>
<?php
	}
?>