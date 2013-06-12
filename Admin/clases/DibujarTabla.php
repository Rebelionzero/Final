<?php

	abstract Class DibujarTabla{
		private $th;

		protected function StartTable($class = ""){
			return "<table class='".$class."'>";
		}

		protected function StartTr(){
			return "<tr>";
		}

		protected function Th($titles){			
			for ($i=0; $i < count($titles); $i++) { 
				$this->th .= "<th>".$titles[$i]."</th>";
			}
			return $this->th;
		}

		protected function Td($tdData){
			return "<td>".utf8_encode($tdData)."</td>";
		}

		protected function TdAttr($tdData){
			return "<td ".$tdData[1].">".utf8_encode($tdData[0])."</td>";
		}

		protected function EndTr(){
			return "</tr>";
		}

		protected function EndTable(){
			return "</table>";
		}
	}