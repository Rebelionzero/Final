<?php
	session_start();
	include_once("conexion.php");	
	$donde = $_SERVER['PHP_SELF']; //averiguo la ruta de este archivo	
	$tabla= basename($donde,".php"); //averiguo el nombre de este archivo sin su extension	
	$_SESSION['tabla']=$tabla;
	include("traer_productos.php");	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html>
	<head>
		<title>Shop Smart Admin Panel</title>
		<link type="text/css" rel="stylesheet" media="screen" href="../CSS/reseteo.css"/>
		<link type="text/css" rel="stylesheet" media="screen" href="../CSS/admin.css"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<body>
		<?php include_once("header.php");?>
		<div class="body">
			<?php include_once("left.php");?>
			<div class="right">
				<?php if($consultar != false){
						echo '<ul class="categorias">';
						echo '<li><h2>'.$tabla.'</h2><h2>Opciones</h2></li>';
						foreach($consultar as $consulta => $valor){
							echo '<li><p>'.$valor.'</p><a href="#">Editar</a></li>';
						}
						echo '</ul>';				
				}else{
					echo '<p>Aca no hay'.$tabla.' cargadas';
				} ?>
			</div>
		</div>
		<div class="footer"></div>
	</body>
</html>
