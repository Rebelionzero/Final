<?php

	Class FormularioObras extends CrearFormulario{
		var $formulario;
		var $field_1;
		var $options;
		var $select;
		var $requerimientos;

		function __construct($act,$formid,$req){
			$this->action = $act;
			$this->id = $formid;
			$this->requerimientos = $req;
		}

		public function crearForm(){
			$this->field_1 = '<h2>Campos Obligatorios</h2>';
			// primera linea div (label, titulo, label textarea)
			$this->field_1 .= '<div class="primera-linea">'
				.$this->Label('titulo','Titulo:')
				.$this->Input(array('text','titulo','titulo','value','asd'))
				.$this->Label('desc','Descripción:')
				.$this->TextArea('desc','descripcion','3','1','value').'</div>';			
			
			// segunda linea div (label, autores, label, año, label, categoria, label, museo, label, imagen)
				// seteando label, opciones y select de autor
				$this->options = $this->Option('seleccione','Seleccione un autor');
				$this->forEachOptions($this->requerimientos->autores,'autor');
				$this->select = $this->Select('autor','autor',$this->options);
				
				// creandolos en el form
				$this->field_1 .= '<div class="segunda-linea">
					<div>'
						.$this->Label('autor','Autor:')
						.$this->select;

				$this->options = '';
				$this->select = '';

				// seteando label, opciones y select de año
				$this->options = $this->Option('seleccione','Seleccione un año');
				for($i = 1950; $i < ( intval(date('Y')) + 1); $i++ ) {
					$this->options .= $this->Option($i,$i);
				}
				$this->select = $this->Select('anio','anio',$this->options);
				
				// creandolos en el form
				$this->field_1 .= $this->Label('anio','Año:').$this->select.'</div>';
				

				// seteando label, opciones y select de categorias
				$this->options = '';
				$this->select = '';
				$this->options = $this->Option('seleccione','Seleccione una categoria');
				$this->forEachOptions($this->requerimientos->categorias,'categoria');
				$this->select = $this->Select('categoria','categoria',$this->options);

				$this->field_1 .= '<div>'.$this->Label('categoria','Categoria:').$this->select.'</div>';

			$this->formulario = $this->Fieldset('',$this->field_1);
			$this->formulario = $this->OpenCloseForm($this->formulario);
		}

		private function forEachOptions($array,$valor){
			foreach ($array as $key => $value) {
				$this->options .= $this->Option( utf8_encode($value['valor']),utf8_encode($value[$valor]) );
			}
		}

	}