<?php

	class traerElementos {
		var $query;
		var $conexion;
		var $elemento = array();

		public function __construct($qu,$con){
			$this->query = $qu;
			$this->conexion = $con;
		}

		public function traerElem(){
			$ejecutar = mysql_query($this->query,$this->conexion) or die(mysql_error());

			if(mysql_num_rows($ejecutar) > 0){
				while($row = mysql_fetch_assoc($ejecutar)){
					$this->elemento[] = $row;
				}
			}else{
				$this->elemento = 'error en la consulta a la base de datos';
			}
		}

		public function get(){
			return $this->elemento;
		}
}
	
?>