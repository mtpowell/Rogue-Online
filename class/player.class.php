<?php
	class player extends actor {
		public function save($player) {
			$_SESSION['player'] = $player;
		}
	}
?>