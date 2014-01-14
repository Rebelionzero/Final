<?php
	session_start();

	include_once("../autoloader.php");

	$conexion = new Conexion();
	$conexion->conectar_bd();
	
	if(!$conexion->conexion){
		//header("Location: no_server.php");
	}else{

		if( !isset( $_SESSION['Login']['autenticacion'] ) || $_SESSION['Login']['autenticacion'] === false ){
			header("Location: login.php");
		}elseif( isset( $_SESSION['Login']['autenticacion'] ) && $_SESSION['Login']['autenticacion'] === true){
			// exito en el login, revisar en el futuro que hacer con esta sentencia
		}
	
		$errores = false;
		if(isset($_SESSION['errores'])){
			$errores = $_SESSION['errores'];
			unset($_SESSION['errores']);
		}
		
		$exito = false;
		if(isset($_SESSION['resultado_carga'])){
			$exito = $_SESSION['resultado_carga'];
			unset($_SESSION['resultado_carga']);
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
		<title>****** Admin Panel - Formato</title>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
		<script type="text/javascript" src="../../ajax-js/jquery.js"></script>
		<script type="text/javascript" src="../../ajax-js/admin.js"></script>		
		<link type="text/css" rel="stylesheet" media="screen" href="../../CSS/reseteo.css"/>
		<link type="text/css" rel="stylesheet" media="screen" href="../../CSS/bootstrap.min.css"/>
		<link type="text/css" rel="stylesheet" media="screen" href="../../CSS/admin.css"/>
	</head>
	<body class="formato">
		<div class="head">
			<h1><a href="admin.php"><img alt="admin header" src="../../Images/admin_header.jpg"/></a></h1>
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