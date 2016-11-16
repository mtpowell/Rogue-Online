<?php
	//require our files
	require_once('includes/config.php');
	require_once('includes/autoload.php');
	require_once('includes/error_handler.php');
	
	//Start the session
	ob_start();
	session_start();
	
	//start heads up display
	$hud = new hud();
	
	//Get map
	$board = new board();
	$map = (isset($_SESSION['map']) ? $_SESSION['map'] : $board::makeMap());
	$map = $board::drawRooms($map);

	//Get player 
	$player = (isset($_SESSION['player']) ? $_SESSION['player'] : new player(array('name' => 'Player', 'sprite' => '@', 'state' => 'normal', 'fov' => 5, 'x' => 10, 'y' => 10, 'level' => 1, 'exp' => 0, 'gold' => 0, 'hp' => 10, 'mana' => 10, 'attack' => 3, 'defense' => 1)));
	
	//Get enemy if it exists, if not, create some for testing
	if (isset($_SESSION['enemy'])) { 
		$enemy = $_SESSION['enemy']; 
	}
	
	//Get objects if it exists, if not make some
	if (isset($_SESSION['objects'])) { 
		$objects = $_SESSION['objects']; 
	} else {
		$objects = array( 1 => array('name' => 'sword', 'sprite' => 'S', 'attack' => 3, 'x' => 12, 'y' => 12));
	}
	
	//get actors if not gen them
	if (isset($_SESSION['actors'])) {
		$actors = $_SESSION['actors'];
	} else {
		$actors = $board::genEnemies($enemies, $map, $player);
	}
	
	//check movement
	switch($player->state) {
			//player is in battle
			case 'battle' :
				if (isset($_POST['battle'])) {
					switch($_POST['battle']) {
						case 'attack' :
							if ($player->attack <= $enemy->defense) {
								$enemy->setHP($enemy->hp - 1);
							} else {
								$enemy->setHp($enemy->hp + $enemy->defense - $player->attack);
							}
							if ($enemy->attack <= $player->defense) {
								$player->setHP($player->hp - 1);
							} else {
								$player->setHp($player->hp + $player->defense - $enemy->attack);
							}
							if ($enemy->hp <= 0) {
								$player->setExp($player->exp + $enemy->exp);
								$player->setGold($player->gold + $enemy->gold);
								unset($enemy);
								unset($_SESSION['enemy']);
								$player->setState('normal');
							}
						break;
						
						case 'run' :
						break;
					}
				}
			break;
			
			//player is moving/default
			case 'normal' :
				if (isset($_GET['action'])) {
					switch($_GET['action']) {
						case 'move' :
							if (isset($_POST['direction'])) {
								switch($_POST['direction']) {
									case 'north' :
										if ($board::isWalkable($map, $player->y - 1, $player->x)) {
											$player->setY($player->y - 1);
											$message = $hud::getMsg($_GET['action'], $_POST['direction']);
											$message = $hud::cleanMsg($message, array($_GET['action'] => $_POST['direction']));
										} else {
											$message = $hud::getMsg('blocked', $_POST['direction']);
											$message = $hud::cleanMsg($message, array('move' => $_POST['direction']));
										}
									break;
									case 'east' :
										if ($board::isWalkable($map, $player->y, $player->x + 1)) {
											$player->setX($player->x + 1);
											$message = $hud::getMsg($_GET['action'], $_POST['direction']);
											$message = $hud::cleanMsg($message, array($_GET['action'] => $_POST['direction']));
										} else {
											$message = $hud::getMsg('blocked', $_POST['direction']);
											$message = $hud::cleanMsg($message, array('move' => $_POST['direction']));
										}
									break;
									case 'south' :
										if ($board::isWalkable($map, $player->y + 1, $player->x)) {
											$player->setY($player->y + 1);
											$message = $hud::getMsg($_GET['action'], $_POST['direction']);
											$message = $hud::cleanMsg($message, array($_GET['action'] => $_POST['direction']));
										} else {
											$message = $hud::getMsg('blocked', $_POST['direction']);
											$message = $hud::cleanMsg($message, array('move' => $_POST['direction']));
										}
									break;
									case 'west' :
										if ($board::isWalkable($map, $player->y, $player->x - 1)) {
											$player->setX($player->x - 1);
											$message = $hud::getMsg($_GET['action'], $_POST['direction']);
											$message = $hud::cleanMsg($message, array($_GET['action'] => $_POST['direction']));
										} else {
											$message = $hud::getMsg('blocked', $_POST['direction']);
											$message = $hud::cleanMsg($message, array('move' => $_POST['direction']));
										}
									break;
								}
							}
						break;
					}
				}
				//check enemy collision
				if (!empty($actors)) {
					foreach($actors as $key => $actor) {
						If ($player->x == $actor['x'] && $player->y == $actor['y']) {
							$enemy = new actor($actor);
							unset($actors[$key]);
							$player->setState('battle');
						}
					}
				}
			break;
	}
	
	//save
	$player->save($player);
	$board->save($map);
	
	if (isset($enemy)) { 
		//$enemy->save($enemy); 
		$_SESSION['enemy'] = $enemy;
	}
	
	if (isset($actors)) {
		$_SESSION['actors'] = $actors;
	}
	
	if (isset($message)) {
		$hud::logMsg($message);
	}
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/main.css" />
		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
	</head>
	<body>
		<div id="map">
			<?php 
				$board::drawMap($map); 
				if (!empty($actors)) { $board::drawActors($actors); }
				if (!empty($objects)) { $board::drawObjects($objects); }
			?>
		<?php echo '<div class="player" style="position: absolute; top: '.$player->y*16 .'px; left: '.$player->x*16 .'px; ">'.$player->sprite.'</div>'; ?>
		</div>
		<div id="controls">
			<?php $hud::getControls($player->state); ?>
		</div>
		<?php
			//debug
			var_dump($player);
			if (isset($_SESSION['logs'])) { var_dump($_SESSION['logs']); }
			if (isset($enemy)) { var_dump($enemy); }
		?>
	</body>
</html>