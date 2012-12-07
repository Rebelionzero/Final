<?php
	session_start();
	if(isset($_SESSION['errores'])){
		foreach ($_SESSION['errores'] as $error => $codigo) {
				echo '<p>'.$codigo.'</p>';
			}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html>
	<head>
		<title>Shop Smart Admin Panel</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script type="text/javascript" src="../ajax-js/funciones_generales.js"></script>
		<script type="text/javascript" src="../ajax-js/admin_productos.js"></script>
		<script type="text/javascript" src="../ajax-js/formularios.js"></script>
		<script type="text/javascript" src="../ajax-js/ajax_pedidos.js"></script>
		<script type="text/javascript" src="../ajax-js/ajax_insert.js"></script>
		<link type="text/css" rel="stylesheet" media="screen" href="../CSS/reseteo.css"/>
		<link type="text/css" rel="stylesheet" media="screen" href="../CSS/admin.css"/>
	</head>
	<body>
		<div class="head">
			<h1><a href="../Site/home.php"><img alt="admin header" src="../Images/admin_header.jpg"/></a></h1>
		</div>
		<div class="middle">
			<?php include_once("left.php");?>
			<?php include_once("right.php");?>
		</div>
		<div class="footer"></div>
	</body>
</html>