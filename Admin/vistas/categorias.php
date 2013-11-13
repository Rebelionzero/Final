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
			
			include_once("../controladores/verificar_categorias.php");
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Art Smart Admin Panel - Categorias</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<script type="text/javascript" src="../../ajax-js/jquery.js"></script>
		<script type="text/javascript" src="../../ajax-js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../../ajax-js/admin.js"></script>
		<link type="text/css" rel="stylesheet" media="screen" href="../../CSS/reseteo.css"/>
		<link type="text/css" rel="stylesheet" media="screen" href="../../CSS/bootstrap.min.css"/>
		<link type="text/css" rel="stylesheet" media="screen" href="../../CSS/admin.css"/>
	</head>
	<body class="categorias">
		<?php include_once("header.php");?>
		<div class="middle">
			<?php include_once("left.php");?>
			<div class="right" id="right">
				<?php
					if( $errores != false ){echo $errMensaje->output;}
					if( $exito != false ){echo $exito->output;}
					if( $borrado != false ){echo $borrado->output;}
				?>
				<?php echo $rightEchoCategorias?>
			</div>
		</div>
		<div class="footer"></div>
		<?php include_once("modales.php");?>
	</body>
</html>