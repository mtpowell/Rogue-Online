<?php
	//DB
	const DB_NAME = 'rogue';
	const DB_USER = 'root';
	const DB_PASS = '';
	const DB_HOST = '127.0.0.1';
	
	//MAP
	const MAP_WIDTH = 48;
	const MAP_HEIGHT = 32;
	
	const MIN_ENEMY = 1;
	const MAX_ENEMY = 10;
	
	const BORDER_SIZE = 2;
	
	//DICE
	const S_DICE = 4;
	const M_DICE = 8;
	const L_DICE = 12;
	
	$mapTypes = array('normal', 'underworld', 'dungeon', 'boss', 'fight');
	
	//Experience shenanigans
	
	//Character Classes
	$classes = array(
		'paladin' => array(
			'description' => 'A noble warrior of the light, prefers melee orientated weapons and heavy armors.',
			'level' => 1,
			'hp' => 12,
			'mana' => 10,
			'attack' => 3,
			'defense' => 5
		),
		'rogue' => array(
			'description' => 'Quick and dangerous. Skilled in poisons and stealth.',
			'level' => 1,
			'hp' => 10,
			'mana' => 15,
			'attack' => 3,
			'defense' => 3
		),
	);
	
	//Enemies
	$enemies = array(
		1 => array(
			'name' => 'Orc',
			'hp' => 15,
			'attack' => 5,
			'defense' => 3,
			'experience' => 3,
			'sprite' => 'X',
		),
		2 => array(
			'name' => 'Skeleton',
			'hp' => 8,
			'attack' => 3,
			'defense' => 1,
			'experience' => 2,
			'sprite' => 'X',
		),
		3 => array(
			'name' => 'Undead',
			'hp' => 12,
			'attack' => 6,
			'defense' => 2,
			'experience' => 4,
			'sprite' => 'X',
		),
	);
?>