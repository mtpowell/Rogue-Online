<?php
	class db {
		public function __construct() {
			
		}
		
		public function getPlayer($player) {
			$stmt = $db->prepare("SELECT * FROM `chars` WHERE `charName`=?");
			$stmt->execute(array($player['name']));
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		
		public function getMap($mapID) {
			$stmt = $db->prepare("SELECT * FROM `maps` WHERE `id`=?");
			$stmt->execute(array($mapID));
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
	}
		
?>