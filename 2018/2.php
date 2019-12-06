<?php

if ($argc < 2) {
	echo 'No input' . PHP_EOL;
	die(127);
} elseif (!preg_match('/\w+(; \w+)*/', $argv[1])) {
	// just a simple input check that the format is always something like "+1; -2; +3"
	echo 'Invalid input format' . PHP_EOL;
	die(127);
}

$result = null;
$ids = explode('; ', $argv[1]);
$twice = $thrice = 0;
foreach($ids as $id) {
	$chars = str_split($id);
	sort($chars);

	$counts = [];
	foreach($chars as $char) {
		$counts[$char] = ( $counts[$char] ?? 0 ) + 1;
	}

	// flipping the array here makes the check easy, and eliminates the
	$counts = array_flip($counts);
	if (isset($counts[2])) {
		$twice++;
	}
	if(isset($counts[3])) {
		$thrice++;
	}
}

echo $twice . PHP_EOL;
echo $thrice . PHP_EOL;
echo 'Checksum: ' . ($twice * $thrice) . PHP_EOL;