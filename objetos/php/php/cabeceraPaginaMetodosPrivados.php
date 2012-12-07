<?php
    
    class cabeceraPagina{
		private $titulos=array();
		private $enlaces=array();
		private $orientacion;
		
		public function cargar($ti,$en){
			$this->titulos[]=$ti;
			$this->enlaces[]=$en;
		}
		
		public function mostrar($orientacion){
			echo '<ul>';
			if($orientacion == "horizontal"){
				$this->horiz();
			}elseif($orientacion == "vertical"){
				$this->verti();
			}
			echo '</ul>';
		}
		
		private function horiz(){
			for($i = 0; $i < count($this->enlaces); $i++){
				echo '<li style="float:left;"><a href="'.$this->enlaces[$i].'">'.$this->titulos[$i].'</a></li>';
			}
		}
		
		private function verti(){
			for($i = 0; $i < count($this->enlaces); $i++){
				echo '<li><a href="'.$this->enlaces[$i].'">'.$this->titulos[$i].'</a></li>';
			}
		}
		
    }
	
	$lista1 = new cabeceraPagina();
	$lista1->cargar("google","www.google.com.ar");
	$lista1->cargar("yahoo","www.google.com.ar");
	$lista1->cargar("infobae","www.google.com.ar");
	$lista1->cargar("lanacion","www.google.com.ar");
    $lista1->mostrar("horizontal");
?>
