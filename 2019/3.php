<?php

if ($argc < 3) {
	echo 'Not enough wires given' . PHP_EOL;
	die(127);
}

$visualOnly = true;

$field = [];
$wires = array_slice( $argv, 1 );
$maxx = $maxy = 0;
$minx = $miny = 0;
foreach($wires as $num => $wire) {
	if (!preg_match('/^[UDLR]\d+(,[UDLR]\d+)*$/', $wire)) {
		// just a simple input check that the format is always something like "R6,U2,L13"
		echo 'Invalid input format for wire ' . ($num + 1) . PHP_EOL;
		die(127);
	}

	$x = $y = 0;
	foreach(explode( ',', $wire) as $move) {
		$dir = substr( $move, 0, 1 );
		$distance = substr( $move, 1 );

		for ($i = 1; $i <= $distance; $i++) {
			switch($dir) {
				case 'U':
					$y--;
					break;
				case 'D':
					$y++;
					break;
				case 'L':
					$x--;
					break;
				case 'R':
					$x++;
					break;
			}

			$field[$x] = $field[$x] ?? [];
			$field[$x][$y] = ($field[$x][$y] ?? 0) + 1;
		}

		$maxx = max($maxx, $x);
		$maxy = max($maxy, $y);

		$minx = min($minx, $x);
		$miny = min($miny, $y);
	}
}

$nearest    = null;
for($y = $miny ; $y <= $maxy; $y++) {
	for($x = $minx ; $x <= $maxx; $x++) {
		if ($visualOnly) echo ( $x == 0 && $y == 0) ? '!' : ( (isset( $field[ $x][ $y]) ? '█' : ' ') );

		if (isset($field[$x][$y])) {
			if ($field[$x][$y] > 1) {
				$distance = abs($x) + abs($y);
				$nearest = is_null( $nearest ) ? $distance : min($distance, $nearest);
			}
		}
	}
	if ($visualOnly) echo PHP_EOL;
}

if (!$visualOnly) echo 'Nearest: ' . $nearest . PHP_EOL;