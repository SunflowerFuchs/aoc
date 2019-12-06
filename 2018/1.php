<?php

if ($argc < 2) {
	echo 'No input' . PHP_EOL;
	die(127);
} elseif (!preg_match('/[+\-]\d+(; [+\-]\d+)*/', $argv[1])) {
	// just a simple input check that the format is always something like "+1; -2; +3"
	echo 'Invalid input format' . PHP_EOL;
	die(127);
}

$freq = 0;
$result = null;
$nums = explode('; ', $argv[1]);
$found = [];
while(true) {
	foreach($nums as $change) {
		$freq += (int) $change;

		// array key checks are cheaper than in_array for larger arrays, and since
		// we don't know how big the array is going to be, i prefer using that instead
		if (isset($found[$freq])) {
			echo 'First repeat: ' . $freq . PHP_EOL;
			break 2;
		}
		$found[$freq] = true;
	}

	//save the first result so we can keep solving both parts of the challenge at once
	if (is_null($result)) {
		$result = $freq;
	}
}

echo 'Result: ' . $result . PHP_EOL;