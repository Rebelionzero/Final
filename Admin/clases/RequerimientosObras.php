<?php

	class RequerimientosObras {
		var $arrayQuery = array();
		var $arrayObjetos = array();
		var $resultadoVacio = false;
		var $arrayRequerimientos;

		function __construct($q){
			$this->arrayRequerimientos = $q;
		}

		public function traer_requerimientos(){
						
			foreach ($this->arrayRequerimientos as $array => $value) {
				$this->arrayQuery[$array] = "SELECT ";
				for ( $i = 0; $i < count($value); $i++) {
					if($i == (count($value)-1) ){
						$comma = '';
					}else{
						$comma = ',';
					}
					$this->arrayQuery[$array] .= key($value[$i]).' as '.$value[$i][key($value[$i])].$comma." ";
				}
				$this->arrayQuery[$array] .= "FROM ".$array;
			}

			
			foreach ($this->arrayQuery as $arrayConsulta => $valor) {
				$this->arrayObjetos[$arrayConsulta] = new Queries($valor);
				$this->arrayObjetos[$arrayConsulta]->select();
				if($this->arrayObjetos[$arrayConsulta]->resultado == false){$this->resultadoVacio = true;}
				$this->arrayObjetos[$arrayConsulta] = $this->arrayObjetos[$arrayConsulta]->resultado;
			}
			
		}

	}