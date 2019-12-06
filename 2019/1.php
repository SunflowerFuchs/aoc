<?php

if ($argc < 2) {
	echo 'No input' . PHP_EOL;
	die(127);
} elseif (!preg_match('/\d+(; \d+)*/', $argv[1])) {
	// just a simple input check that the format is always something like "1; 12; 333"
	echo 'Invalid input format' . PHP_EOL;
	die(127);
}

$inputs = explode('; ', $argv[1]);
$sum = 0;
foreach($inputs as $num) {
	while ($num > 0) {
		$num = floor($num / 3) - 2;
		if ($num > 0) {
			$sum += $num;
		}
	}
}

echo 'Result: ' . $sum;