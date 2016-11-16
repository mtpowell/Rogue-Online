<?php
	class board {
		public $map;
		
		public function __construct() {
		}
		
		public static function makeMap() {
			$map = array_fill(0, MAP_HEIGHT, array_fill(0, MAP_WIDTH, array('tile' => '#', 'isWalkable' => FALSE, 'sprite' => 'wall')));
			return $map;
		}
		
		public static function drawMap($map) {
			for($i = 0; $i < MAP_HEIGHT; $i++) {
				for($j = 0; $j < MAP_WIDTH; $j++) {
					echo '<div class="tile">'.$map[$i][$j]['tile'].'</div>';
				}
			}
		}
		
		public static function drawRooms($map) {
			for($y = BORDER_SIZE; $y < MAP_HEIGHT - BORDER_SIZE; $y++) {
				for($x = BORDER_SIZE; $x < MAP_WIDTH - BORDER_SIZE; $x++) {
					$map[$y][$x]['tile'] = '.';
					$map[$y][$x]['isWalkable'] = TRUE;
				}
			}
			return $map;
		}
		
		public static function isWalkable($map, $y, $x) {
			return (isset($map[$y][$x]) ? $map[$y][$x]['isWalkable'] : FALSE);
		}
		
		public static function drawActors($actors) {
			foreach($actors as $actor) {
				$x = $actor['x'] * 16;
				$y = $actor['y'] * 16;
				echo '<div class="actor" style="position: absolute; left:'.$x.'px; top:'.$y.'px;">'.$actor['sprite'].'</div>';
			}
		}
		
		public static function drawObjects($objects) {
			foreach($objects as $object) {
				$x = $object['x'] * 16;
				$y = $object['y'] * 16;
				echo '<div class="actor" style="position: absolute; left:'.$x.'px; top:'.$y.'px;">'.$object['sprite'].'</div>';
			}
			
		}
		
		public static function genEnemies($names, $map, $player) {
			$count = rand(MIN_ENEMY, MAX_ENEMY);
			
			for($i = 0; $i <= $count; $i++) {
				$index = rand(1, count($names));
				$name = $names[$index]['name'];
				$level = rand($player->level - 2, $player->level + 2);
				if ($level <= 0) { $level = 1; }
				$attack = $names[$index]['attack'] + rand(0, 3);
				$hp = $names[$index]['hp'] + rand(1, 3);
				$defense = $names[$index]['defense'] + rand(0, 2);
				$experience = $names[$index]['experience'] * $level - $player->level;
				$sprite = $names[$index]['sprite'];
				$gold = $level * $hp - $player->level * $hp;
				if ($gold <= 0) { $gold = 0; }
				
				$y = rand(BORDER_SIZE, MAP_HEIGHT - BORDER_SIZE);
				$x = rand(BORDER_SIZE, MAP_WIDTH - BORDER_SIZE);
				
				if ($map[$y][$x]['isWalkable'] == TRUE && $player->x != $x && $player->y != $y) {
					$enemy = array(
						'name' => $name, 
						'level' => $level, 
						'attack' => $attack,
						'hp' => $hp, 
						'x' => $x,
						'y' => $y,
						'gold' => $gold,
						'sprite' => $sprite,
						'defense' => $defense, 
						'exp' => $experience,
					);
					$enemies[] = $enemy;
				} else {
					$i--;
				}
			}
			return $enemies;
		}
		
		public static function save($map) {
			$_SESSION['map'] = $map;
		}
		
	}
?>