<?php

	interface IQueries {
		public function select();
		public function insert();
		public function update();
		public function delete();
	}