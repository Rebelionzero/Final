<?php

	$option_autores = '';
	$option_anio = '';
	$option_cate = '';
	$option_museo = '';

	if($camposSeteados == false){
		// titulo
		$value_titulo = "<input id='titulo' type='text' name='titulo' value='' />";
		
 		// descripcion
		$value_desc = "";
		
		// autor
		foreach ($requerimientos->autores as $autores => $autor) {
			$option_autores .= "<option value='".$value = utf8_encode(str_replace(' ','_',$autor['autor']))."'>".utf8_encode($autor['autor'])."</option>";
		}

		// año
		for($i = 1950; $i < ( intval(date('Y')) + 1); $i++ ) {
			$option_anio .= "<option value='".$i."' >".$i."</option>";
		}

		// categoria
		foreach ($requerimientos->categorias as $categorias => $categoria) {
			$option_cate .= "<option value='".$value = utf8_encode(str_replace(' ','_',$categoria['categoria']))."'>".utf8_encode($categoria['categoria'])."</option>";
		}

		// museo
		foreach ($requerimientos->museos as $museos => $museo) {
			$option_museo .= "<option value='".$value = utf8_encode(str_replace(' ','_',$museo['museo']))."'>".utf8_encode($museo['museo'])."</option>";
		}

		// checkbox
		$checkbox = '<input type="checkbox" class="check" name="seudonimo" id="seudonimo" disabled="true"/>';

 	}else{
 		// titulo
		$value_titulo = "<input id='titulo' type='text' name='titulo' value='".$camposSeteados['titulo']."'";
 		
		// descripcion
 		$value_desc = $camposSeteados['descripcion'];
 		
 		// autor
 		foreach ($requerimientos->autores as $autores => $autor) {
 			if(utf8_encode(str_replace(' ','_',$autor['autor'])) == $camposSeteados['autor']){
				$option_autores .= "<option selected='selected' value='".$value = utf8_encode(str_replace(' ','_',$autor['autor']))."'>".utf8_encode($autor['autor'])."</option>";
			}else{
				$option_autores .= "<option value='".$value = utf8_encode(str_replace(' ','_',$autor['autor']))."'>".utf8_encode($autor['autor'])."</option>";
			}
		}

		// año
		for($i = 1950; $i < ( intval(date('Y')) + 1); $i++ ) {
			if($i == $camposSeteados['anio']){
				$option_anio .= "<option selected='selected' value='".$i."' >".$i."</option>";
			}else{
				$option_anio .= "<option value='".$i."' >".$i."</option>";
			}
		}

		// categoria
		foreach ($requerimientos->categorias as $categorias => $categoria) {
			if(utf8_encode(str_replace(' ','_',$categoria['categoria'])) == $camposSeteados['categoria']){
				$option_cate .= "<option selected='selected' value='".$value = utf8_encode(str_replace(' ','_',$categoria['categoria']))."'>".utf8_encode($categoria['categoria'])."</option>";
			}else{
				$option_cate .= "<option value='".$value = utf8_encode(str_replace(' ','_',$categoria['categoria']))."'>".utf8_encode($categoria['categoria'])."</option>";
			}
		}

		// museo
		foreach ($requerimientos->museos as $museos => $museo) {
			if( utf8_encode( str_replace(' ','_',$museo['museo']) ) == $camposSeteados['museo']){
				$option_museo .= "<option selected='selected' value='".$value = utf8_encode(str_replace(' ','_',$museo['museo']))."'>".utf8_encode($museo['museo'])."</option>";
			}else{
				$option_museo .= "<option value='".$value = utf8_encode(str_replace(' ','_',$museo['museo']))."'>".utf8_encode($museo['museo'])."</option>";
			}
		}

		// checkbox
		if($camposSeteados['seudonimo'] != false){
			$checkbox = '<input type="checkbox" checked="true" class="check" name="seudonimo" id="seudonimo" disabled="true"/>';
		}else{
			$checkbox = '<input type="checkbox" class="check" name="seudonimo" id="seudonimo" disabled="true"/>';
		}

 	}


 ?>