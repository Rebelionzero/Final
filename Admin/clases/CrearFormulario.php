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
			return '<input type="'.$data[0].'" id="'.$data[1].'" name="'.$data[2].'" value="'.$data[3].'" '.$data[4].' />';
			//$data[4] = disabled / checked / class
		}

		protected function TextArea($id,$name,$rows,$cols,$value){
			return '<textarea id="'.$id.'" name="'.$name.'" rows="'.$rows.'" cols="'.$cols.'">'.$value.'</textarea>';
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