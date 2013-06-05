<?php

	Class TablaObras extends DibujarTabla{
		var $th;
		var $content = $array();		
		var $table;

		function __construct($data){
			$this->content['obra'] = utf8_encode($data['obra']);
		}

		public function crearTabla(){
			$this->table = $this->StartTable();
			
			for ($i=0; $i < 4; $i++) {

				$this->table .= $this->StartTr();
				$this->table .= $this->Td("obra: ");
				$this->table .= $this->Td($this->content['obra']);
				$this->table .= $this->EndTr();
			}
			

			$this->table .= $this->EndTable();
		}

	}