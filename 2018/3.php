<?php

if ($argc < 2) {
	echo 'No input' . PHP_EOL;
	die(127);
} elseif (!preg_match('/#\d+ @ \d+,\d+: \d+x\d+(; #\d+ @ \d+,\d+: \d+x\d+)*/', $argv[1])) {
	// just a simple input check that the format is always something like "#16 @ 572,613: 11x22; #45 @ 70,536: 16x12"
	echo 'Invalid input format' . PHP_EOL;
	die(127);
}

$inputs = explode('; ', $argv[1]);
$d = [];
$area = [];
$overlaps = 0;
$oClaims = [];
foreach($inputs as $input) {
	preg_match('/#(?<id>\d+) @ (?<x>\d+),(?<y>\d+): (?<w>\d+)x(?<h>\d+)/', $input, $d);
	$d['x'];
	$d['y'];

	for($i = $d['x']; $i < $d['x'] + $d['w']; $i++) {
		for($j = $d['y']; $j < $d['y'] + $d['h']; $j++) {
			if (!isset($area[$i][$j])) {
				$area[$i][$j] = $d['id'];
				$noOverlap[$d['id']] = true;
			} else {
				$oClaims[$d['id']] = true;
				if ($area[$i][$j] !== 'OVERLAP') {
					$oClaims[$area[$i][$j]] = true;
					$overlaps++;
					$area[$i][$j] = 'OVERLAP';
				}
			}
		}
	}
}

echo 'Overlaps: ' . $overlaps . PHP_EOL;
echo 'Standalone: ' . PHP_EOL;
for($i = 1; $i <= $d['id']; $i++) {
	if (!isset($oClaims[$i])) echo $i . PHP_EOL;
}

