<?php

	interface IMensajeHTML {
		public function listaDeMensajesDeError();
		public function mensajeExito();
		public function mensajeAlert();
		public function mensajeDeError();
	}