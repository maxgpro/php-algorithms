<?php
/*
 * Что бы отсортировать массив сравниваем числа попарно начиная с самого первого.
 * Например: первая пара — 0, 1; вторая пара — 1, 2 и тд.
 * Если в паре значение первого числа больше значения второго, то меняем их местами и переходим к следующей паре.
 * Если же значение первого числа меньше значения второго, сразу переходим к следующей паре.
 * Когда весь массив будет пройден то наибольшее число массива переместится в его конец. Это реализация внутреннего цикла.
 * После этого нам нужно переместить остальные числа в конец массива. Для этого мы используем внешний цикл.
 * И так как при каждой итерации внешнего цикла мы будем перемещать в конец массива по числу, сравнивать их уже излишне.
 * Для этого каждый раз при полном прохождении по массиву мы будем отнимать от длинны массива количество сделанных итераций.
 * То есть от итераций внутреннего цикла отнимать количество итераций внешнего цикла.
 */

function random_array($int)
{
    $array = [];
    for ($i = 0; $i < $int; $i++) {
        $array[$i] = random_int(0, $int);
    }
    return $array;
}
function give_array_values($array)
{
    $res = '';
    foreach ($array as $value) {
        $res .= $value . " ";
    }
    return $res;
}
function sort_bubble($array)
{
    $step = 1;
    $e = 0;
//    echo "array) " . give_array_values($array) . "<br>";
    for ($i = 0; $i < count($array); $i++) {
        for ($j = 0; $j < count($array) - 1 - $i; $j++) {
            if ($array[$j] > $array[$j + 1]) {
                $tmp = $array[$j + 1];
                $array[$j + 1] = $array[$j];
                $array[$j] = $tmp;
            }
            $step++;
        }
//        echo "step $step) " . give_array_values($array) . "<br>";
    }
    return [$array, $step];
}
if (isset($_GET['length'])) {
    $list = random_array($_GET['length']);
    $start = hrtime(true);
    $res = sort_bubble($list);
    $finish = hrtime(true);


    $time = $finish - $start;
    $time = $time/1e+6; //nanoseconds to milliseconds

    echo "Origin array: ";
    echo give_array_values($list);
    echo "<br>Sorted array: ";
    echo give_array_values($res[0]);
    echo "<br>Speed: $time milliseconds and $res[1] steps.";
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
    <lable>Array length: <input type="text" name="length"></lable>
    <button type="submit">search</button>
</form>
</body>
</html>

