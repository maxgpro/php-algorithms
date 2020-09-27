<?php
/*
 * Все элементы массива $list начиная с первого, один за другим? сравниваются с искомым числом $find.
 * Когда совпадение найдено программа выходит из цикла.
 */

function search_linear($array, $item)
{
    $step = 0;
    foreach ($array as $key => $value) {
        $step++;
        if ($value == $item) {
            return [$key, $step];
        }
    }
//    for ($i=1; $i<=count($array); $i++) {
//        $step++;
//        if ($array[$i] == $item) {
//            return [$i, $step];
//        }
//    }
    return null;
}
if (isset($_GET['find'])) {
    $list = range(1, 1000000);
    $find = $_GET['find'];
    $start = hrtime(true);
    $res = search_linear($list, $find);
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
