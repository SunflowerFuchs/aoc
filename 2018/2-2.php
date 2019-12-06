<?php

if ($argc < 2) {
	echo 'No input' . PHP_EOL;
	die(127);
} elseif (!preg_match('/\w+(; \w+)*/', $argv[1])) {
	// just a simple input check that the format is always something like "asdasd; dsadasd; asdsdasda"
	echo 'Invalid input format' . PHP_EOL;
	die(127);
}

$ids = explode('; ', $argv[1]);
for ($i = 0; $i < strlen($ids[0]); $i++) {
	echo "Testing character " . ($i + 1) . PHP_EOL;
	foreach($ids as $oKey => $oId) {
		$oId = substr($oId, 0, $i) . substr($oId, $i + 1);
		foreach($ids as $iKey => $iId) {
			if ($iKey <= $oKey) continue;

			$iId = substr($iId, 0, $i) . substr($iId, $i + 1);
			if ($oId == $iId) {
				echo 'Result: ' . $iId;
				die();
			}
		}
	}
}
