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
				// no trajo resultados
				$this->resultado = false;
			}
				
		}

		public function insert (){
			$this->conexion();
			$this->queryFunction();

			$this->resultado = ($this->consulta === false) ? false : true;
		}

		public function update (){
			$this->conexion();
			$this->queryFunction();

			$this->resultado = ($this->consulta === false) ? false : true;
		}		

		public function delete (){
			$this->conexion();
			$this->queryFunction();
		}

		private function conexion (){
			$this->conectar = new Conexion();
			$this->conectar->conectar_bd();			
			
		}

		private function queryFunction (){			
			$this->consulta = mysql_query($this->query, $this->conectar->conexion);
			if($this->consulta === false){
				// header para otra parte del sitio, agregar mensaje de error
				var_dump("asd asd ".$this->consulta);
				exit();
			}
		}


	}