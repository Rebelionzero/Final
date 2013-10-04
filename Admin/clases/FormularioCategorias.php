<?php

	Class FormularioCategorias extends CrearFormulario{
		var $formulario;
		var $div;
		var $campo;
		var $descripcion;
		var $tipo;
		var $values;
		var $cateId = false;

		function __construct($act,$formid,$clas,$type,$val,$caid){
			$this->action = $act;
			$this->id = $formid;
			$this->class = $clas;
			$this->tipo = $type;
			$this->values = $val;
			$this->cateId = $caid;
		}

		function crearFrom(){
			if($this->cateId == false){
				$this->cateId ='';
			}else{
				$this->cateId = $this->Input(array('hidden','categoria'.$this->cateId,'nrcate',$this->cateId,''));
			}

			$this->div = '<h2>Campos Obligatorios</h2>';
			$this->div .= '<div>'
			.$this->cateId
			.$this->Input(array('hidden','tipo','tipo',$this->tipo,''))
			.$this->Label('categoria','Categoria:')
			.$this->Input(array('text','categoria','categoria',utf8_encode($this->values['categoria']),''))
			.$this->Label('descripcion','Descripcion:')
			.$this->TextArea('desc','descripcion','3','1',utf8_encode($this->values['descripcion'])).'</div>';

			$this->formulario = $this->Fieldset('',$this->div);
			$this->formulario = $this->OpenCloseForm($this->formulario);
		}

	}