<?php

	session_start();
	// $_SESSION['estado'];
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
	</head>
	<body>
		<h1>Login</h1>
		<form action="validarLogin.php" method="POST" enctype="multipart/form-data">
			<input type="text" name="usr"/>
			<input type="text" name="pass"/>
			<input type="submit" value="ingresar"/>
		</form>
	</body>
</html>