<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8"/>
  <title>Sorting alrorithms</title>
 </head>
<body>

<?php
 set_time_limit ( 0 ); //Время выполнения не ограничено!
 $select_values = array ( //( подписи, названия функций сортировки, сортирует ли на месте, ссылка)
  array( 'Не выбран', '', false, ''),
  array( 'Пузырьком', 'bubbleSort', true, 'https://ru.wikipedia.org/wiki/%D0%A1%D0%BE%D1%80%D1%82%D0%B8%D1%80%D0%BE%D0%B2%D0%BA%D0%B0_%D0%BF%D1%83%D0%B7%D1%8B%D1%80%D1%8C%D0%BA%D0%BE%D0%BC'),
  array( 'Перемешиванием', 'cocktailSort', false, 'https://ru.wikipedia.org/wiki/%D0%A1%D0%BE%D1%80%D1%82%D0%B8%D1%80%D0%BE%D0%B2%D0%BA%D0%B0_%D0%BF%D0%B5%D1%80%D0%B5%D0%BC%D0%B5%D1%88%D0%B8%D0%B2%D0%B0%D0%BD%D0%B8%D0%B5%D0%BC'),
  array( 'Расчёской', 'combSort', false, 'https://ru.wikipedia.org/wiki/%D0%A1%D0%BE%D1%80%D1%82%D0%B8%D1%80%D0%BE%D0%B2%D0%BA%D0%B0_%D1%80%D0%B0%D1%81%D1%87%D1%91%D1%81%D0%BA%D0%BE%D0%B9'),
  array( 'Гномья', 'gnomeSort', false, 'https://ru.wikipedia.org/wiki/%D0%93%D0%BD%D0%BE%D0%BC%D1%8C%D1%8F_%D1%81%D0%BE%D1%80%D1%82%D0%B8%D1%80%D0%BE%D0%B2%D0%BA%D0%B0'),
  array( 'Вставками', 'insertionSort', true, 'https://ru.wikipedia.org/wiki/%D0%A1%D0%BE%D1%80%D1%82%D0%B8%D1%80%D0%BE%D0%B2%D0%BA%D0%B0_%D0%B2%D1%81%D1%82%D0%B0%D0%B2%D0%BA%D0%B0%D0%BC%D0%B8'),
  array( 'Слиянием', 'mergesort', false, 'https://ru.wikipedia.org/wiki/%D0%A1%D0%BE%D1%80%D1%82%D0%B8%D1%80%D0%BE%D0%B2%D0%BA%D0%B0_%D1%81%D0%BB%D0%B8%D1%8F%D0%BD%D0%B8%D0%B5%D0%BC'),
  array( 'Терпеливая', 'patience_sort', true, 'https://en.wikipedia.org/wiki/Patience_sorting'),
  array( 'Быстрая', 'quicksort', false, 'https://ru.wikipedia.org/wiki/%D0%91%D1%8B%D1%81%D1%82%D1%80%D0%B0%D1%8F_%D1%81%D0%BE%D1%80%D1%82%D0%B8%D1%80%D0%BE%D0%B2%D0%BA%D0%B0'),
  array( 'Выбором', 'selection_sort', true, 'https://ru.wikipedia.org/wiki/%D0%A1%D0%BE%D1%80%D1%82%D0%B8%D1%80%D0%BE%D0%B2%D0%BA%D0%B0_%D0%B2%D1%8B%D0%B1%D0%BE%D1%80%D0%BE%D0%BC'),
  array( 'Шелла', 'shellSort', false, 'https://ru.wikipedia.org/wiki/%D0%A1%D0%BE%D1%80%D1%82%D0%B8%D1%80%D0%BE%D0%B2%D0%BA%D0%B0_%D0%A8%D0%B5%D0%BB%D0%BB%D0%B0')
 ); 
 $n = isset($_POST['n']) ? abs(intval($_POST['n'])) : 100; $n = ($n>999 ? 999 : $n);
 $min = isset($_POST['min']) ? intval($_POST['min']) : -100; 
 $min = ($min<-999 ? -999 : ($min > 9999 ? 9999 : $min));
 $max = isset($_POST['max']) ? intval($_POST['max']) : 100; 
 $max = ($max<-99 ? -99 : ($max > 999 ? 999 : $max));
 if ($min > $max) { $d = $min; $min = $max; $max = $d; }
 else if ($min == $max) { $min = -100; $max = 100; }
 $alg = isset($_POST['alg']) ? abs(intval($_POST['alg'])) : 0; 
 $alg = ($alg>count($select_values)-1 ? count($select_values)-1 : $alg);
 $action = isset($_POST['action']) ? 1 : 0; 

 echo '
 <form method="post" action="'.$_SERVER['PHP_SELF'].'">
  <p>Размерность массива: 
   <input type="text" name="n" maxlength="3" size="4" value="'.$n.'">
     Минимум: 
   <input type="text" name="min" maxlength="4" size="5" value="'.$min.'">
     Максимум: 
   <input type="text" name="max" maxlength="3" size="4" value="'.$max.'">
     Алгоритм сортировки: 
   <select name="alg" size="1">
 ';
 foreach ($select_values as $key=>$value) {
  echo '<option value="'.$key.'"'.($alg==$key?' selected':'').'>'.$value[0]."\n";
 }
 echo '</select>
  <input type="submit" name="action" value="Выполнить"> 
  </p>';
 $result = '';
 if (!empty($action)) {
  if ($n<2) $result = 'Меньше 2 элементов, нечего сортировать!';
  else if (!empty($select_values[$alg][1])) {
   require_once ('functions.php');
   require_once ('timer.php');
   $f = $select_values[$alg][1];
   $a = generateArray ($n,$min,$max);
   $a0 = $a;
   $t = new timer(); $t->start();
   if ($select_values[$alg][2]) $f ($a0);
   else $a0 = $f ($a0);
   $time = $t->finish();
   $result = 'Отсортировано алгоритмом: <a href="'.$select_values[$alg][3].
    '" target="_blank">'.$select_values[$alg][0].'</a>, время = '.$time.' с.</p>'."\n";
   $result .= print_array ('Исходный массив:',$a);
   $result .= print_array ('Отсортированный массив:',$a0);
  }
  else $result = 'Не выбран алгоритм!';
 }
 echo '<p>'.$result.'</p>';
?>
</body></html>