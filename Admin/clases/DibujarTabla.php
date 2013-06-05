<?php

	abstract Class DibujarTabla{

		protected function StartTable(){
			return "<table>";
		}

		protected function StartTr(){
			return "<tr>";
		}

		protected function Th($title){
			return "<th>".$title."</th>";
		}

		protected function Td($tdData){
			return "<td>".$tdData."</td>";
		}

		protected function EndTr(){
			return "</tr>";
		}

		protected function EndTable(){
			return "</table>";
		}
	}