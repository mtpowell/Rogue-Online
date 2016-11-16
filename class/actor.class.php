<?php
	class actor {
		public $name;
		public $sprite;
		public $state;
		public $x;
		public $y;
		public $level;
		public $exp;
		public $gold;
		public $hp;
		public $mana;
		public $attack;
		public $defense;
		
		public function __construct($actor) {
			$this->name = (isset($actor['name']) ? $actor['name'] : NULL);
			$this->sprite = (isset($actor['sprite']) ? $actor['sprite'] : NULL);
			$this->state = (isset($actor['state']) ? $actor['state'] : NULL);
			$this->x = (isset($actor['x']) ? $actor['x'] : NULL);
			$this->y = (isset($actor['y']) ? $actor['y'] : NULL);
			$this->level = (isset($actor['level']) ? $actor['level'] : NULL);
			$this->exp = (isset($actor['exp']) ? $actor['exp'] : NULL);
			$this->gold = (isset($actor['gold']) ? $actor['gold'] : NULL);
			$this->hp = (isset($actor['hp']) ? $actor['hp'] : NULL);
			$this->mana = (isset($actor['mana']) ? $actor['mana'] : NULL);
			$this->attack = (isset($actor['attack']) ? $actor['attack'] : NULL);
			$this->defense = (isset($actor['defense']) ? $actor['defense'] : NULL);
		}
		
		public function setName($value) {
			$this->name = $value;
		}

		public function setState($value) {
			$this->state = $value;
		}
		
		public function setX($value) {
			$this->x = $value;
		}
		
		public function setY($value) {
			$this->y = $value;
		}
		
		public function setLevel($value) {
			$this->level = $value;
		}
		
		public function setExp($value) {
			$this->exp = $value;
		}
		
		public function setGold($value) {
			$this->gold = $value;
		}
		
		public function setHp($value) {
			$this->hp = $value;
		}
		
		public function setMana($value) {
			$this->mana = $value;
		}
		
		public function setAttack($value) {
			$this->attack = $value;
		}
		
		public function setDefense($value) {
			$this->defense = $value;
		}
	}
?>