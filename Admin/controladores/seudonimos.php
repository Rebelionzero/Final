<?php
	include_once("../autoloader.php");

	$autor = $_POST['seudonimo'];
	
	if($autor != "" && $autor != " "){
		$autor = trim($autor);
		$autor = str_replace("_"," ",$autor);

		$query = "SELECT seudonimo FROM autores WHERE nombre = '".$autor."';";
		$consulta = new Queries($query);
		$consulta->select();
		if($consulta->resultado == "-No tiene-" || $consulta->resultado == false){
			$resp = false;
		}else{
			$resp = $consulta->resultado[0];
		}
		

	}else{
		// llamar a la clase Error, pues ajax envió algo vacio, comprobar la linea 6 igualmente
	}

	$b = json_encode($resp);
	echo $b;

?>