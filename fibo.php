<?php

$num = 30;
$a = 0;
$b = 1;
$c = 0;
for ($i = $num;    $i>0;    $i--) {
    $c = $a + $b;
	$a = $b;
	$b = $c;
    echo "$c <br>";
}

