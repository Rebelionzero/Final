<?php
	session_start();

	include_once("../autoloader.php");

	$conexion = new Conexion();
	$conexion->conectar_bd();
	$conexion->get();
	
	if(!$conexion->conexion){
		header("Location: no_base.php");
	}else{
	
		$errores = false;
		if(isset($_SESSION['errores'])){
			$errores = $_SESSION['errores'];
			unset($_SESSION['errores']);
		}
		
		$exito = false;
		if(isset($_SESSION['carga_exitosa'])){
			$exito = $_SESSION['carga_exitosa'];
			unset($_SESSION['carga_exitosa']);
		}
		
		$edicion = false;
		if(isset($_SESSION['edicion_exitosa'])){
			$exito = $_SESSION['edicion_exitosa'];
			unset($_SESSION['edicion_exitosa']);
		}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html>
	<head>
		<title>Shop Smart Admin Panel</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />		
		<script type="text/javascript" src="../../ajax-js/admin_productos.js"></script>
		<script type="text/javascript" src="../../ajax-js/formularios.js"></script>
		<script type="text/javascript" src="../../ajax-js/ajax_pedidos.js"></script>
		<script type="text/javascript" src="../../ajax-js/ajax_insert.js"></script>
		<link type="text/css" rel="stylesheet" media="screen" href="../../CSS/reseteo.css"/>
		<link type="text/css" rel="stylesheet" media="screen" href="../../CSS/bootstrap.min.css"/>
		<link type="text/css" rel="stylesheet" media="screen" href="../../CSS/admin.css"/>
	</head>
	<body>
		<div class="head">
			<h1><a href="../../Site/home.php"><img alt="admin header" src="../../Images/admin_header.jpg"/></a></h1>
		</div>
		<div class="middle">
			<?php include_once("left.php");?>
			<?php include_once("right.php");?>
		</div>
		<div class="footer"></div>
	</body>
</html>
<?php
	}
?>