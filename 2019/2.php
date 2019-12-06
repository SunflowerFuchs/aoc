<?php

if ($argc < 2) {
    echo "Missing input";
    die(127);
} elseif (!preg_match('/^\d+(,\d+)*$/', $argv[1])) {
    echo "Invalid input";
    die(127);
}

$expected = '19690720';


$vals = explode(',', $argv[1]);
for($i = 0; $i < count($vals); $i++) {
    switch($vals[$i]) {
        case 99:
            echo PHP_EOL . "Envountered OP99" . PHP_EOL;
            break 2;
        case 1:
            $in1 = $vals[++$i];
            $in2 = $vals[++$i];
            $out = $vals[++$i];
            $vals[$out] = $vals[$in1] + $vals[$in2];
            break;
        case 2:
            $in1 = $vals[++$i];
            $in2 = $vals[++$i];
            $out = $vals[++$i];
            $vals[$out] = $vals[$in1] * $vals[$in2];
            break;
    }
}

echo implode(', ', $vals);
