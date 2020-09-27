<?php
/* Алгоритм двоичного поиска работает с отсортированным массивом представляя его
 * как ограниченный верхним и нижним значениями диапазон поиска.
 * Находим средний элемент. Если он совпадает с искомым то завершаем программу.
 * Если не совпадает то смотрим в какой части диапазона находится искомое число, и в ту сторону сдвигает диапазон поиска.
 * Если искомое число в меньшей части, то середина становится верней границей массива (диапазон сдвигается влево на числовой линии).
 * Если искомое число в большей части, то середина становится нижней границей массива (диапазон сдвигается влево на числовой линии).
 * После этого сравнение повторяется пока искомый элемент не окажется средним.
 */

function search_binary($array, $item, $first, $last)
{
    $step = 0;
    while ($first <= $last) {
        $step++;
        $mid = floor(($last + $first) / 2);
        $guess = $array[$mid];
//    echo $step.') from '.$array[$first].' to '.$array[$last].' = '.$array[$mid].'. It\'s: '.$guess.'<br>';
        if ($guess == $item) {
            return [$mid, $step];
        }
        elseif ($item < $guess) {
            $last = $mid;
        }
        elseif ($item > $guess) {
            $first = $mid;
        } else {
            return null;
        }
    }
}
if (isset($_GET['find'])) {
    $list = range(1, 1000000);
    $find = $_GET['find'];
    $first = 0;
    $last = count($list) - 1;

    $start = hrtime(true);
    $res = search_binary($list, $find, $first, $last);
    $finish = hrtime(true);
    if ($res != null) {
        $time = $finish - $start;
        $time = $time/1e+6; //nanoseconds to milliseconds
        echo "Value $find found at $res[0] position in $time milliseconds and $res[1] steps.";
    } else {
        echo "Value $find  not found.";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="<?= $_SERVER['PHP_SELF']; ?>" method="get">
    <lable>Enter a number from 1 to 1000000: <input type="text" name="find"></lable>
    <button type="submit">search</button>
</form>
</body>
</html>
