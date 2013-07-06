<?php

	Class FormularioObras extends CrearFormulario{
		var $formulario;
		var $field_1;
		var $field_2;
		var $field_3;
		var $options;
		var $select;
		var $requerimientos;

		function __construct($act,$formid,$clas,$req){
			$this->action = $act;
			$this->id = $formid;
			$this->class = $clas;
			$this->requerimientos = $req;
		}

		public function crearForm(){
			// PRIMER FIELDSET
			
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

				// creandolos en el form
				$this->field_1 .= '<div>'.$this->Label('categoria','Categoria:').$this->select.'</div>';


				// seteando label, opciones y select de museos
				$this->options = '';
				$this->select = '';
				$this->options = $this->Option('seleccione','Seleccione un museo');
				$this->forEachOptions($this->requerimientos->museos,'museo');
				$this->select = $this->Select('museo','museo',$this->options);

				// creandolos en el form
				$this->field_1 .= '<div>'.$this->Label('museo','Museo:').$this->select.'</div>';


				// seteando label e input de imagen y creandolos en el form
				$this->field_1 .= '<div>'.$this->Label('imagen','Imagen:').$this->Input(array('file','imagen','imagen','','')).'</div></div>';
				

				// SEGUNDO FIELDSET
				$this->field_2 = '<h2>Opciones de Autor:</h2>';
				$this->field_2 .= '<div class="mail-container"><div>'
					.$this->Input(array('radio','mail-autor','mail','autor','class="radio-mail-autor" disabled="true"'))
					.$this->Label('mail-autor','Utilizar mail del autor').'</div><div>'
					.$this->Input(array('radio','mail-museo','mail','museo','class="radio-mail-museo" disabled="true"'))
					.$this->Label('mail-museo','Utilizar mail del museo').'</div></div>';

				$this->field_2 .= '<div class="seudonimo-container"><div>'
				.$this->Input(array('checkbox','seudonimo','seudonimo','','class="check" disabled="true"'))
				.$this->Label('seudonimo','Utilizar seudonimo del autor si este lo posee:')
				.'<p class="no-seu none">El autor/a seleccionado/a no tiene seudonimo disponible</p></div>'
				.'<p class="warn none"><span class="label label-warning">Advertencia:</span> Si el autor utiliza su seudonimo, el mail que figurará en el site será el del museo</p></div>';

			$this->formulario = $this->Fieldset('',$this->field_1);
			$this->formulario .= $this->Fieldset('opciones',$this->field_2);
			$this->formulario = $this->OpenCloseForm($this->formulario);
		}

		private function forEachOptions($array,$valor){
			foreach ($array as $key => $value) {
				$this->options .= $this->Option( utf8_encode($value['valor']),utf8_encode($value[$valor]) );
			}
		}

	}