<?php

	Class FormularioObras extends CrearFormulario{
		var $formulario;

		function __construct($act,$formid){
			$this->action = $act;
			$this->id = $formid;
		}

		public function crearForm(){
			

			$this->formulario = $this->OpenCloseForm();
			$this->formulario = $this->Fieldset();
		}

	}