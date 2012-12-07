<?php 
	function array_unico($consul,$registro){
		$arr = array();
		foreach($consul as $no_repetir => $indice){
			$arr[] = $indice[$registro];
		}
		return array_unique($arr);
	}
?>