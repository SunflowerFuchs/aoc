<?php

if ($argc < 2) {
    echo "Missing input";
    die(127);
} elseif (!preg_match('/^\d+(,\d+)*$/', $argv[1])) {
    echo "Invalid input";
    die(127);
}

$origVals = explode(',', $argv[1]);

$expected = 19690720;

for($i = 0; $i <= 99; $i++) {
    for($j = 0; $j <= 99; $j++) {
        $vals = $origVals;
        $vals[1] = $i;
        $vals[2] = $j;

        for($k = 0; $k < count($vals); $k++) {
            switch($vals[$k]) {
                case 99:
                    echo PHP_EOL . "Encountered OP99" . PHP_EOL;
                    break 2;
                case 1:
                    $in1 = $vals[++$k];
                    $in2 = $vals[++$k];
                    $out = $vals[++$k];
                    $vals[$out] = $vals[$in1] + $vals[$in2];
                    break;
                case 2:
                    $in1 = $vals[++$k];
                    $in2 = $vals[++$k];
                    $out = $vals[++$k];
                    $vals[$out] = $vals[$in1] * $vals[$in2];
                    break;
            }
        }

        if ($vals[0] == $expected) {
            echo "Verb: " . $vals[1] . PHP_EOL;
            echo "Noun: " . $vals[2] . PHP_EOL;
            echo "Final result: " . (100 * $vals[1] + $vals[2]) . PHP_EOL;
            die();
        }
    }
}

# echo implode(', ', $vals);
