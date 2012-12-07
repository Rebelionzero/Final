<?php
    
    class Tabla {
    	private $arr=array();
		private $filas;
		private $columnas;
		private $fondo=array();
		private $color=array();
		
		public function __construct($fi,$colu){
			$this->filas=$fi;
			$this->columnas=$colu;
		}
		
		public function generar_tabla($fi,$co){
			echo '<table>';
			for($i = 0;$i < count($columnas);$i++){
				echo '<tr>';
				for($j = 0;$j < count($filas);$j++){
					echo '<td style="background:#'.$this->fon.';color:'.$this->colo.'">'.$this->colu.'</td>';
				}
				echo '</tr>';
			}
			echo '</table>';
			
		}
		
		public function cargar($fi,$col,$fon,$col_fo){
			$arr[$col][$fi]=$col." ".$col_fo;
			$fondo[$col][$fi]=$fon;
			$color[$col][$fi]=$col_fo;
		}

    }
?>