<?php
	class CabeceraPagina {
		private $titulo;
		private $alineacion;
		private $fondo;
		private $color;
		
		public function __construct($tit,$ali,$fon,$col){
			$this->titulo=$tit;
			$this->alineacion=$ali;
			$this->fondo=$fon;
			$this->color=$col;
		}
		
		public function generar_mensaje(){
			echo '<h1 style="text-align:'.$this->alineacion.';background-color:'.$this->fondo.';color:'.$this->color.';">'.$this->titulo.'</h1>';			
		}
		
	}
	
	$cabecera = new CabeceraPagina('mi pagina', 'right', '#0a01fe', '#00e63e');
	$cabecera->generar_mensaje();
	
?>