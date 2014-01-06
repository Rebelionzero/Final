<?php
	Class FormularioMuseos extends CrearFormulario{
		var $formulario;
		var $div;
		var $direccion;
		var $tipo;
		var $values;
		var $museoId = false;
		var $cancelarButtons = false;

		function __construct($act,$formid,$clas,$type,$val,$museid){
			$this->action = $act;
			$this->id = $formid;
			$this->class = $clas;
			$this->tipo = $type;
			$this->values = $val;
			$this->museoId = $museid;
		}

		public function cancelBtns(){
			$this->cancelarButtons = true;
		}

		function crearForm(){
			if($this->museoId == false){
				$this->museoId ='';
			}else{
				$this->museoId = $this->Input(array('hidden','museo'.$this->museoId,'nrmus',$this->museoId,''));
			}

			$this->div = '<h2>Campos Obligatorios</h2>';
			$this->div .= '<div>'
			.$this->museoId
			.$this->Input(array('hidden','tipo','tipo',$this->tipo,''))
			.$this->Label('museo','Museo:')
			.$this->Input(array('text','museo','museo',utf8_encode($this->values['museo']),''))
			.$this->Label('direccion','Direccion:')
			.$this->Input(array('text','direccion','direccion',utf8_encode($this->values['direccion']),''))
			.$this->Label('mail','Mail:')
			.$this->Input(array('text','mail','mailMuseo',utf8_encode($this->values['mail']),''))
			.$this->Label('imagen','Imagen:')
			.$this->Input(array('file','imagen','imagenMuseo','',''));

			if($this->cancelarButtons == false){
				$this->div .= '<div class="botones">'.$this->Input(array('submit','submit-museo','','Cargar','class="btn btn-primary"')).'<a class="btn clear-fields" href="#">Limpiar Campos</a></div>';
			}elseif($this->cancelarButtons == true){
				$this->div .= '';
			}

			$this->formulario = $this->Fieldset('',$this->div);
			$this->formulario = $this->OpenCloseForm($this->formulario);
		}

	}