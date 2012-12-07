<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
	<head>
		<title>Examen Final Programacion II - Nicolas Alejandro Dezzutto</title>
		<link type="text/css" rel="stylesheet" href="../CSS/reseteo.css" />
		<link type="text/css" rel="stylesheet" href="../CSS/estilos.css" />
		<script type="text/javascript" src="JS/programa.js"></script>
	</head>
	<body>
		<div id="page">
			<div id="header">
				<div class="header_top clear_float">
					<h1>shopsmart</h1>
					<div class="items_container clear_float">
						<div>
							<h2 class="green">tu carrito:</h2>
							<p>tenes <a href="#" class="green"><span id="cantidad">0</span> productos</a></p>
							<p class="total"><span>por</span> un total de</p>
							<p class="green">$ <span id="total">0</span></p>
						</div>
						<div id="checkout"><a href="#">checkout</a></div>
					</div>	
				</div>	
				<div class="navbar clear_float">
					<ul class="clear_float">
						<li><a href="#" class="green">home</a></li>
						<li><a href="#">ofertas</a></li>
						<li><a href="#">emprendedores</a></li>
						<li><a href="#">registrarse</a></li>
						<li><a href="#">contactenos</a></li>
					</ul>
					<form action="">
						<input type="text" value=""/>
						<input type="submit" value="" />
					</form>
				</div>
			</div>
			<div id="body">
				<div class="left_body">
					<div>
						<h2>categorias</h2>
						<ul>
							<li><a href="#">mouses</a></li>
							<li><a href="#">teclados</a></li>
							<li><a href="#">memorias usb</a></li>
							<li><a href="#">tablet pc</a></li>
							<li><a href="#">smartphones</a></li>
						</ul>
					</div>
					<div>
						<h2>categorias 2</h2>
						<ul>
							<li><a href="#">auriculares</a></li>
							<li><a href="#">consolas</a></li>
							<li><a href="#">pantallas lcd</a></li>
							<li><a href="#">reproductores dvd</a></li>
							<li><a href="#">altavoces</a></li>
						</ul>
					</div>
				</div>
				<div class="central_body"></div>
				<div class="right_body">
					<div class="login_box">
						<h2>login</h2>
						<div>
							<form action="">
								<label>Mail:</label><input type="text" name="mail"/>
								<label>Password:</label><input type="password" name="password"/>
								<input type="submit" class="submit"/>
							</form>
						</div>
					</div>
					<div class="comming">
						<h2>Proximamente</h2>
						<div>
							<h3>Monitor Samsung PC I9000</h3>
							<img alt="monitor" src="Iconos/monitor.png"/>
						</div>
					</div>					
					<div class="free">
					
					</div>
				</div>
			</div>
			<div id="footer">
			</div>
		</div>
		<div id="form-registro">
			<form action="registro.php" method="post">
				<label>nombre</label><input type="text" name="nombre"/>
				<br />
				<label>apellido</label><input type="text" name="apellido"/>
				<br />
				<label>mail</label><input type="text" name="mail"/>
				<br />
				<label>password</label><input type="password" name="password"/>
				<br />
				<label>repetir password</label><input type="password" name="repassword"/>
				<br />
				<input type="submit" value="registrarme"/>
			</form>
		</div>	
	</body>
</html>