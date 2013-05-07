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
<!DOCTYPE html>
<html>
	<head>
		<title>****** Admin Panel</title>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
		<script type="text/javascript" src="../../ajax-js/jquery.js"></script>
		<script type="text/javascript" src="../../ajax-js/admin.js"></script>		
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
			<div class="right" id="right">
				<div class="right_content">
					<h2>Bienvenido al panel de administracion de ***********************, para comenzar seleccione una opcion del menu izquierdo.</h2>

				</div>	
			</div>
		</div>
		<div class="footer"></div>
	</body>
</html>
<?php
	}
?>