<?php  
    
    function save_prod_in_db($prod,$conexion){    	
		$consulta = mysql_query($prod, $conexion)or die($mysql_error = mysql_error() );
		
		 if( is_bool($consulta) ){
		 	if($consulta == true){
		 		if( isset($_SESSION['carga_exitosa']) ){unset($_SESSION['carga_exitosa']);}
				$_SESSION['carga_exitosa'] = '<p>el producto se ha cargado satisfactoriamente</p>';
				header('Location: admin.php');
		 	}
		 }
	}
?>