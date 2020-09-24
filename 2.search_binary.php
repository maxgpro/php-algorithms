<?php
function search_binary($array, $item)
{

}
$list = range(1, 1000000);
$find = 999;

$first = 0;
$last = count($list) - 1;

while ($first <= $last) {
    $step = 0;
    $mid = floor(($last + $first) / 2);
    $guess = $list[$mid];
    echo $step.') from '.$list[$first].' to '.$list[$last].' = '.$list[$mid].'. It\'s: '.$guess.'<br>';

    if ($guess == $find) {
        return $guess;
    }
    elseif ($guess > $find) {
        $last = $mid;
    }
    else {
        $first = $mid;
    }
    $step++;
}


$start = hrtime(true);
$res = search_binary($list, $find);
$finish = hrtime(true);
if ($res != null) {
    $time = $finish - $start;
    $time = $time/1e+6; //nanoseconds to milliseconds
    echo "Value $find found at position $res in $time milliseconds.";
} else {
    echo "Value $find  not found.";
}