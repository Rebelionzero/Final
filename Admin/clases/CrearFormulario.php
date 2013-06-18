<?php

	abstract Class CrearFormulario{
		protected $action;
		protected $id;

		protected function OpenCloseForm($data){
			return '<form method="post" enctype="multipart/form-data" action="'.$this->action.'" id="'.$this->id.'">'.$data.'</form>';
		}

		protected function Fieldset($class,$data){
			return '<fieldset class="'.$class.'">'.$data.'</fieldset>';
		}

		protected function Input($data){
			return '<input type="'.$data[0].'" id="'.$data[1].'" class="'.$data[2].'" name="'.$data[3].'" value="'.$data[4].'" '.$data[5].' />'
			//$data[5] = disabled / checked / etc
		}

		protected function Select($id,$name,$options){
			return '<select id="'.$id.'" name="'.$name.'">'.$options.'</select>';
		}

		protected function Option($value,$data){
			return '<option value="'.$value.'">'.$data.'</option>';
		}

		protected function Label($for,$data){
			return '<label for="'.$for.'">'.$data.'</label>';
		}

	}