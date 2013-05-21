<?php

	class insertarCM {
		var $tabla;
		var $categoriaMarca;
		var $comprobar;

		public function __construct($tbl,$vl){
			$this->tabla = $tbl;
			$this->categoriaMarca = $vl;
		}

		public function comprobarExistente(){
			$query = "SELECT id FROM ".$this->tabla."s WHERE nombre = '".$this->categoriaMarca."';";
			$this->comprobar = new Queries($query);
			$this->comprobar->select();

		}

		public function insertarEnBd(){
			if($this->comprobar->resultado === false){
				$queryInsertar = "INSERT INTO ".$this->tabla."s"." VALUES(null,'".$this->categoriaMarca."',CURRENT_DATE());";
				$insertar = new Queries($queryInsertar);
				$insertar->insert();
				if($insertar->resultado === true){
					echo "La ".$this->tabla. " ".$this->categoriaMarca." ha sido insertada correctamente.";
					die();
				}else{
					echo "Error ".mysql_errno(). ": los valores ingresados no constituyen un nombre de ".$this->tabla." correcto.";
				}
			}else{
				echo("Error: La ".$this->tabla.": ".$this->categoriaMarca." ya existe.");
			}
		}

	}