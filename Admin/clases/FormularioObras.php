<?php

	Class FormularioObras extends CrearFormulario{
		var $formulario;
		var $field_1;
		var $field_2;
		var $field_3;
		var $options;
		var $select;
		var $requerimientos;
		var $values;
		var $autores;
		var $categorias;
		var $museos;
		var $cancelarButtons = false;

		function __construct($act,$formid,$clas,$req,$val){
			$this->action = $act;
			$this->id = $formid;
			$this->class = $clas;
			$this->requerimientos = $req;
			$this->values = $val;
		}

		public function cancelBtns(){
			$this->cancelarButtons = true;
		}

		public function crearForm(){
			// PRIMER FIELDSET
			
			// separando requerimientos en arrays simples para usarlos despues
			foreach ($this->requerimientos as $key => $value) {
				if($key == 'autores'){$this->autores = $value;}
				if($key == 'categorias'){$this->categorias = $value;}
				if($key == 'museos'){$this->museos = $value;}
			}

			$this->field_1 = '<h2>Campos Obligatorios</h2>';
			// primera linea div (label, titulo, label textarea)
			$this->field_1 .= '<div class="primera-linea">'
				.$this->Label('titulo','Titulo:')
				.$this->Input(array('text','titulo','titulo',utf8_encode($this->values['titulo']),''))
				.$this->Label('desc','Descripción:')
				.$this->TextArea('desc','descripcion','3','1',utf8_encode($this->values['descripcion'])).'</div>';			
			
			// segunda linea div (label, autores, label, año, label, categoria, label, museo, label, imagen)
				// seteando label, opciones y select de autor
				$this->options = $this->Option('seleccione','Seleccione un autor','');
				$this->forEachOptions($this->autores,'autor',utf8_encode($this->values['autor']));
				$this->select = $this->Select('autor','autor',$this->options);
				
				// creandolos en el form
				$this->field_1 .= '<div class="segunda-linea">
					<div>'
						.$this->Label('autor','Autor:')
						.$this->select;

				$this->options = '';
				$this->select = '';

				// seteando label, opciones y select de año
				$this->options = $this->Option('seleccione','Seleccione un año','');
				for($i = 1950; $i < ( intval(date('Y')) + 1); $i++ ) {
					if($i == intval($this->values['anio'])){
						$this->options .= $this->Option($i,$i," selected='selected'");
					}else{
						$this->options .= $this->Option($i,$i,'');
					}
				}
				$this->select = $this->Select('anio','anio',$this->options);
				
				// creandolos en el form
				$this->field_1 .= $this->Label('anio','Año:').$this->select.'</div>';
				

				// seteando label, opciones y select de categorias
				$this->options = '';
				$this->select = '';
				$this->options = $this->Option('seleccione','Seleccione una categoria','');
				$this->forEachOptions($this->categorias,'categoria',utf8_encode($this->values['categoria']));
				$this->select = $this->Select('categoria','categoria',$this->options);

				// creandolos en el form
				$this->field_1 .= '<div>'.$this->Label('categoria','Categoria:').$this->select.'</div>';


				// seteando label, opciones y select de museos
				$this->options = '';
				$this->select = '';
				$this->options = $this->Option('seleccione','Seleccione un museo','');
				$this->forEachOptions($this->museos,'museo',utf8_encode($this->values['museo']));
				$this->select = $this->Select('museo','museo',$this->options);

				// creandolos en el form
				$this->field_1 .= '<div>'.$this->Label('museo','Museo:').$this->select.'</div>';


				// seteando label e input de imagen y creandolos en el form
				$this->field_1 .= '<div>'.$this->Label('imagen','Imagen:').$this->Input(array('file','imagen','imagen','','')).'</div></div>';
				

				// SEGUNDO FIELDSET
				$autor_selected ='';
				$museo_selected ='';
				$disabled_rad = '';
				if(utf8_encode($this->values['autor']) == 'seleccione' ){ $disabled_rad = "disabled='true'";}
				if($this->values['mail'] == 'museo'){					
					$museo_selected = ' checked="true"';
				}elseif($this->values['mail'] == 'autor'){					
					$autor_selected = ' checked="true"';
				}

				$checkbox = '';
				$disabled_ch = 'disabled="true"';
				$showWarning = 'none';
				$showNote = 'none';
				$seu = '';
				// si el false significa que no esta checkeado
				if(gettype($this->values['seudonimo']) == 'boolean'){$checkbox = '';}else{$showWarning = 'block';$checkbox =' checked="checked"';$museo_selected = ' checked="true"';$autor_selected = '';$disabled_rad = "disabled='true'";}
				
				// este verifica si la opcion seleccionada tiene seudonimo, si lo hay, el atributo disabled es false
				if($this->values['autor'] == 'seleccione'){
					$disabled_ch = 'disabled="true"';
				}else{
					for($i = 0; $i < count($this->autores); $i++){
						if($this->autores[$i]['valor'] == $this->values['autor'] ){
							if($this->autores[$i]['seud'] == '-No tiene-'){
								$disabled_ch = ' disabled="true"';
								$showNote = 'in-bl';
							}else{
								// tiene seudonimo
								$seu = '<p class="seu">El autor/a seleccionado/a tiene el seudonimo <span class="label label-info">'.$this->autores[$i]['seud'].'</span></p>';
								$disabled_ch = '';
							}
							break;
						}else{
							$disabled_ch = '';
							continue;	
						}
					}
				}

				$this->field_2 = '<h2>Opciones de Autor:</h2>';
				$this->field_2 .= '<div class="mail-container"><div>'
					.$this->Input(array('radio','mail-autor','mail','autor','class="radio-mail-autor" '.$disabled_rad.''.$autor_selected))
					.$this->Label('mail-autor','Utilizar mail del autor').'</div><div>'
					.$this->Input(array('radio','mail-museo','mail','museo','class="radio-mail-museo" '.$disabled_rad.''.$museo_selected))
					.$this->Label('mail-museo','Utilizar mail del museo').'</div></div>';

				$this->field_2 .= '<div class="seudonimo-container"><div>'
				.$this->Input(array('checkbox','seudonimo','seudonimo','','class="check" '.$disabled_ch.$checkbox))
				.$this->Label('seudonimo','Utilizar seudonimo del autor si este lo posee:')
				.'<p class="no-seu '.$showNote.'">El autor/a seleccionado/a no tiene seudonimo</p>'.$seu.'</div>'
				.'<p class="warn '.$showWarning.'"><span class="label label-warning">Advertencia:</span> Si el autor utiliza su seudonimo, el mail que figurará en el site será el del museo</p></div>';

			

				// TERCER FIELDSET
				// este fieldset corresponde a los botones
				if($this->cancelarButtons == false){
					$this->field_3 = $this->Input(array('submit','submit-obra','','Cargar','class="btn btn-primary"')).'<a class="btn clear-fields" href="#">Limpiar Campos</a>';
				}elseif($this->cancelarButtons == true){
					$this->field_3 = '';
				}
				//if($variable_cancelar == true ){$this->field_3.= $this->Button('btn','Cancelar','data-dismiss="modal" aria-hidden="true"');}

				// CERRANDO EL FORMULARIO
				$this->formulario = $this->Fieldset('',$this->field_1);
				$this->formulario .= $this->Fieldset('opciones',$this->field_2);
				$this->formulario .= $this->Fieldset('botones',$this->field_3);
				$this->formulario = $this->OpenCloseForm($this->formulario);
		}

		private function forEachOptions($array,$valor,$default){

			foreach ($array as $key => $value) {

				if( isset($value['seud']) && $value['seud'] != '-No tiene-'){
					$seudonimo = 'data-seudonimo="'.$value['seud'].'"';
				}else{
					$seudonimo = '';
				}
				if(utf8_encode($value['valor']) == $default){$seudonimo.= " selected='selected'";}else{$seudonimo.= '';}
				$this->options .= $this->Option(utf8_encode($value['valor']),utf8_encode($value[$valor]),utf8_encode($seudonimo));
				
			}

		}

	}