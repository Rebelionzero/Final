<?php
	include_once("../interfaces/IFormularios.php");

	Class FormularioAutores extends CrearFormulario implements IFormularios{
		var $formulario;
		var $div;
		var $descripcion;
		var $tipo;
		var $values;
		var $autorId = false;
		var $cancelarButtons = false;

		function __construct($act,$formid,$clas,$type,$val,$autid){
			$this->action = $act;
			$this->id = $formid;
			$this->class = $clas;
			$this->tipo = $type;
			$this->values = $val;
			$this->autorId = $autid;
		}

		public function cancelBtns(){
			$this->cancelarButtons = true;
		}

		function crearForm(){

			$this->autorId = ($this->autorId == false) ? '' : $this->Input(array('hidden','autor'.$this->autorId,'nraut',$this->autorId,''));
			
			$this->values['seudonimo'] = ( $this->values['seudonimo'] == '-No tiene-' ) ? '' : $this->values['seudonimo'];

			$this->div = '<h2>Campos Obligatorios</h2>';
			$this->div .= '<div>'
			.$this->autorId
			.$this->Input(array('hidden','tipo','tipo',$this->tipo,''))
			.$this->Label('autor','Autor:')
			.$this->Input(array('text','autor','autor',utf8_encode($this->values['nombre']),''))
			.$this->Label('seudonimo','Seudonimo:')
			.$this->Input(array('text','seudonimo','seudonimo',utf8_encode($this->values['seudonimo']),''))
			.$this->Label('mail','Mail:')
			.$this->Input(array('text','mail','mailAutor',utf8_encode($this->values['mail']),''));

			if($this->cancelarButtons == false){
				$this->div .= '<div class="botones">'.$this->Input(array('submit','submit-autor','','Cargar','class="btn btn-primary"')).'<a class="btn clear-fields" href="#">Limpiar Campos</a></div>';
			}elseif($this->cancelarButtons == true){
				$this->div .= '';
			}

			$this->formulario = $this->Fieldset('',$this->div);
			$this->formulario = $this->OpenCloseForm($this->formulario);
		}

	}