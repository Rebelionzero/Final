<?php
    include_once("../autoloader.php");
	
	$table = $_POST["tabla"];
	$valor = $_POST["valor"];

	$nuevaCM = new InsertarCM($table,$valor);
	$nuevaCM->comprobarExistente();
	$nuevaCM->insertarEnBd();
?>