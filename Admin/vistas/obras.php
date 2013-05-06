<?php
	session_start();

	include_once("../autoloader.php");

	$conexion = new Conexion();
	$conexion->conectar_bd();
	
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>****** Admin Panel - Obras</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
		<script type="text/javascript" src="../../ajax-js/jquery.js"></script>
		<script type="text/javascript" src="../../ajax-js/admin.js"></script>		
		<link type="text/css" rel="stylesheet" media="screen" href="../../CSS/reseteo.css"/>
		<link type="text/css" rel="stylesheet" media="screen" href="../../CSS/bootstrap.min.css"/>
		<link type="text/css" rel="stylesheet" media="screen" href="../../CSS/admin.css"/>
	</head>
	<body>
		<div class="head">
			<h1><a href="admin.php"><img alt="admin header" src="../../Images/admin_header.jpg"/></a></h1>
		</div>
		<div class="middle">
			<?php include_once("left.php");?>
			<div class="right" id="right">
				<div class="right_content">
					<?php 
						if($requerimientos->respuesta == false){
							echo('<h2>Para poder crear una nueva obra es necesaria la creacion previa de al menos un autor, una categoria y un museo</h2>');
						}else{
							echo "<div class='tabs'>
									<a href='#' class='tab-cargar'>Cargar Obras</a>
									<a href='#' class='tab-lista'>Lista de Obras</a>
								</div>";
							echo "<div class='cargar'>";
								include_once("formulario-obras.php");
							echo "</div>";
							echo "<div class='lista'>";
								/* include el archivo que llama a la lista de obras */
							echo "</div>";							
						}
					 ?>
				</div>
			</div>
		</div>
		<div class="footer"></div>
	</body>
</html>
<?php
	}
?>