<?php
	class hud {
		public function __construct() {
			
		}
		
		public static function getControls($state) {
			switch($state) {
				case 'battle' :
				echo '
					<form action="index.php?action=battle" method="post">
						<input type="submit" value="attack" name="battle">
						<input type="submit" value="run" name="battle">
					</form>
				';
				break;
				
				case 'normal' :
				echo '
					<form action="index.php?action=move" method="post">
						<input type="submit" value="north" name="direction" id="north">
						<input type="submit" value="east" name="direction" id="east">
						<input type="submit" value="south" name="direction" id="south">
						<input type="submit" value="west" name="direction" id="west">
					</form>
				';
				break;
			}
		}
		
		public static function logMsg($message) {
			if(!array_key_exists('logs', $_SESSION)) {
				$_SESSION['logs'] = array();
			}
			if (array_key_exists('logs', $_SESSION) && count($_SESSION['logs']) === 20) {
				for($i=0; $i<10; $i++) {
					unset($_SESSION['logs'][$i]);
				}
				$_SESSION['logs'] = array_values($_SESSION['logs']);
			}
			$_SESSION['logs'][] = $message;
		}
		
		public static function getMsg($type) {
			switch ($type) {
				case 'move' :
					$message = array(
						'You head :direction: and find nothing.',
						'After going countless footsteps :direction:, you find nothing.'
					);
				break;
				
				case 'blocked' :
					$message = array(
						'There seems to be something blocking your path :direction:.'
					);
				break;
			}
			return $message[rand(0, count($message) - 1)];
		}
		
		public static function cleanMsg($message, array $params) {
			if (array_key_exists('move', $params)) {
				$message = str_replace(':direction:', '<span class="direction">'.$params['move'].'</span>', $message);
			}
			if (array_key_exists('enemy', $params)) {
				$message = str_replace(':enemy:', '<span class="enemy">'.$params['enemy'].'</span>', $message);
			}
			if (array_key_exists('playerattack', $params)) {
				$message = str_replace(':playerattack:', '<span class="playerattack">'.$params['playerattack'].'</span>', $message);
			}
			if (array_key_exists('enemyattack', $params)) {
				$message = str_replace(':enemyattack:', '<span class="enemyattack">'.$params['enemyattack'].'</span>', $message);
			}
			return $message;
		}
	}
?>