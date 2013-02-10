<?php

	class Queries {
		var $query;
		var $consulta;
		var $conectar;
		var $resultado;

		public function __construct ($queri){
			$this->query = $queri;
		}

		public function select (){
			$this->conexion();
			$this->queryFunction();			

			if(mysql_num_rows($this->consulta) > 0){
				while($row = mysql_fetch_assoc($this->consulta)){
					$this->resultado[]=$row;
				}				
			}else{
				$this->resultado = false;
			}
				
		}

		public function insert (){}

		public function update (){}		

		public function delete (){
			$this->conexion();
			$this->queryFunction();

		}

		private function conexion (){
			$this->conectar = new Conexion();
			$this->conectar->conectar_bd();
			$this->conectar->get();
			return $this->conectar;
		}

		private function queryFunction (){
			$this->consulta = mysql_query($this->query, $this->conectar->conexion);
		}


	}