<?php

	session_start();

	if(isset($_SESSION['Login']['autenticacion'])) {	
		if($_SESSION['Login']['autenticacion'] === false) {
			// login incorrecto o desconectado			
			$error = '<div class="mensaje_error alert alert-error container error_php"><h3>'.$_SESSION['Login']['respuesta'].'</h3><a href="#" class="close">x</a></div>';
			unset($_SESSION['Login']);
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<title>Login</title>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
		<link type="text/css" rel="stylesheet" media="screen" href="../../CSS/reseteo.css"/>
		<link type="text/css" rel="stylesheet" media="screen" href="../../CSS/bootstrap.min.css"/>
		<link type="text/css" rel="stylesheet" media="screen" href="../../CSS/admin.css"/>
		<script type="text/javascript" src="../../ajax-js/jquery.js"></script>
		<script type="text/javascript" src="../../ajax-js/admin.js"></script>
	</head>
	<body>
		<h1>Login</h1>
		<?php if(isset($error)){ echo $error;} ?>
		<form action="../controladores/validar_login.php" method="POST" enctype="multipart/form-data">
			<input type="text" name="usr"/>
			<input type="password" name="pass"/>
			<input type="submit" value="ingresar"/>
		</form>		
	</body>
</html>