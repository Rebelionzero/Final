<?php
	session_start();
	include_once("conexion.php");	
	$donde = $_SERVER['PHP_SELF']; //averiguo la ruta de este archivo
	$tabla= basename($donde,".php"); //averiguo el nombre de este archivo sin su extension
	$_SESSION['tabla']=$tabla;
	include("traer_productos.php");	
	$_SESSION['consultar'] = $consultar;
	$marcas = array();
	$categorias = array();
	
	include("funciones.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html>
	<head>
		<title>Shop Smart Admin Panel</title>
		<link type="text/css" rel="stylesheet" media="screen" href="../CSS/reseteo.css"/>
		<link type="text/css" rel="stylesheet" media="screen" href="../CSS/admin.css"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script type="text/javascript" src="../AJAX - JS/productos.js"></script>
	</head>
	<body>
		<div class="head">
			<h1>Shop Smart Admin Panel</h1>
		</div>
		<div class="middle">
			<?php include_once("left.php");?>
			<div class="right">
				<div class="nuevo"><p>nuevo producto</p></div>
				<div>
					<form id="ingreso_producto" class="none" action="ingresar_producto.php" method="post" enctype="multipart/form-data">
						<h2>Ingresar nuevo producto</h2>
						<ul>
							<li class="nombre_p"><label>nombre: </label><input type="text" name="nombre" value="" /></li>
							<li class="descripcion_p"><label>descripcion: </label><textarea name="descripcion" rows="1" cols="20" ></textarea></li>
							<li class="imagen_p"><label>imagen: </label><input type="file" name="foto"/></li>
							<li class="precio_p"><label>precio: </label><input type="text" name="precio" id="entero" value="100" /><p>.</p><input type="text" name="centavos" id="flotante" value="00" /></li>
							<li class="categoria_p"><label>categoria: </label><select name="categoria">
									<?php 									
									$cate = array_unico($consultar,'categoria');									
									foreach($cate as $cat){echo '<option value="'.$cat.'">'.$cat.'</option>';}
									?>
								</select></li>
							<li class="marca_p"><label>marca: </label><select name="marca">
								<?php 
									$string = 'marca';
									$marcas = array_unico($consultar,'marca');	
									foreach($marcas as $marc){echo '<option value="'.$marc.'">'.$marc.'</option>';}
									?>
								</select></li>
							<li><input type="submit" id="nuevo_prod" value="ingresar"/><input type="button" value="cancelar" /></li>
						</ul>
					</form>
				</div>	
				<?php if($consultar != false){
						echo '<table class="productos">';
							echo '<tr>';
								echo '<th>Nombre</th>';
								echo '<th>Descripcion</th>';
								echo '<th>Imagen</th>';
								echo '<th>Precio</th>';
								echo '<th>Categoria</th>';
								echo '<th>Marca</th>';
								echo '<th>Opciones</th>';
							echo '</tr>';
						foreach($consultar as $consulta => $valor){
							echo '<tr>';
							echo '<td>'.$valor['n_p'].'</td>';
							echo '<td>'.$valor['descripcion'].'</td>';
							echo '<td>'.$valor['imagen'].'</td>';
							echo '<td>'.$valor['precio'].'</td>';
							echo '<td>'.$valor['categoria'].'</td>';
							echo '<td>'.$valor['marca'].'</td>';
							echo '<td><a href="#">Editar</a><a href="#">Borrar</a></td>';
							echo '</tr>';							
						}
						echo '</table>';
				}else{
					echo '<p>Aca no hay'.$tabla.' cargados';
				} ?>
			</div>
		</div>
		<div class="footer"></div>
	</body>
</html>