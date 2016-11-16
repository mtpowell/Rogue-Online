<?php
	class enemy extends actor {
		public $key;

		public function __construct($enemy) {
			
		}
		
		public function save($enemy) {
			$_SESSION['enemy'] = $enemy;
		}
		
		public function setKey($value) {
			$this->key = $value;
		}
	}
?>