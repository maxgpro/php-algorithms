<?php
function generateArray ($n,$min,$max) {
 $arr = Array ();
 for ($i = 0; $i < $n; $i++) $arr[] = mt_rand ($min, $max);
 return $arr;
}

function print_array ($hdr,$a) {
 if (!is_array($a)) return '<p>Object with header '.$hdr.' is not Array!</p>';
 $n = count ($a); 
 $s = '<p>'.$hdr.' ';
 for ($i = 0; $i < $n; $i++) $s .= $a[$i].($i<$n-1?', ':'');
 return $s.'</p>'."\n";
}

//Пузырьком

function bubbleSort(array &$array) {
  $c = count($array) - 1;
  do {
    $swapped = false;
    for ($i = 0; $i < $c; ++$i) {
      if ($array[$i] > $array[$i + 1]) {
        list($array[$i + 1], $array[$i]) =
                array($array[$i], $array[$i + 1]);
        $swapped = true;
      }
    }
  } while ($swapped);
  return $array;
}

//Перемешиванием

function cocktailSort($arr){
	if (is_string($arr)) $arr = str_split(preg_replace('/\s+/','',$arr));
 
	do{
		$swapped = false;
		for($i=0;$i<count($arr);$i++){
			if(isset($arr[$i+1])){
				if($arr[$i] > $arr[$i+1]){
					list($arr[$i], $arr[$i+1]) = array($arr[$i+1], $arr[$i]);
					$swapped = true;
				}
			}			
		}
 
		if ($swapped == false) break;
 
		$swapped = false;
		for($i=count($arr)-1;$i>=0;$i--){
			if(isset($arr[$i-1])){
				if($arr[$i] < $arr[$i-1]) {
					list($arr[$i],$arr[$i-1]) = array($arr[$i-1],$arr[$i]);
					$swapped = true;
				}
			}
		}
	}while($swapped);
 
	return $arr;
}

//Расчёской

function combSort($arr){
	$gap = count($arr);
        $swap = true;
	while ($gap > 1 || $swap){
		if($gap > 1) $gap /= 1.25;
 
		$swap = false;
		$i = 0;
		while($i+$gap < count($arr)){
			if($arr[$i] > $arr[$i+$gap]){
				list($arr[$i], $arr[$i+$gap]) = array($arr[$i+$gap],$arr[$i]);
				$swap = true;
			}
			$i++;
		}
	}
	return $arr;
}


//Гномья

function gnomeSort($arr){
	$i = 1;
	$j = 2;
	while($i < count($arr)){
		if ($arr[$i-1] <= $arr[$i]){
			$i = $j;
			$j++;
		}else{
			list($arr[$i],$arr[$i-1]) = array($arr[$i-1],$arr[$i]);
			$i--;
			if($i == 0){
				$i = $j;
				$j++;
			}
		}
	}
	return $arr;
}


//Вставками

function insertionSort(&$arr){
	for($i=0;$i<count($arr);$i++){
		$val = $arr[$i];
		$j = $i-1;
		while($j>=0 && $arr[$j] > $val){
			$arr[$j+1] = $arr[$j];
			$j--;
		}
		$arr[$j+1] = $val;
	}
}


//Слиянием

function mergesort($arr){
	if(count($arr) == 1 ) return $arr;
	$mid = count($arr) / 2;
    $left = array_slice($arr, 0, $mid);
    $right = array_slice($arr, $mid);
	$left = mergesort($left);
	$right = mergesort($right);
	return merge($left, $right);
}
 
function merge($left, $right){
	$res = array();
	while (count($left) > 0 && count($right) > 0){
		if($left[0] > $right[0]){
			$res[] = $right[0];
			$right = array_slice($right , 1);
		}else{
			$res[] = $left[0];
			$left = array_slice($left, 1);
		}
	}
	while (count($left) > 0){
		$res[] = $left[0];
		$left = array_slice($left, 1);
	}
	while (count($right) > 0){
		$res[] = $right[0];
		$right = array_slice($right, 1);
	}
	return $res;
}

//Терпеливая

class PilesHeap extends SplMinHeap {
    public function compare($pile1, $pile2) {
        return parent::compare($pile1->top(), $pile2->top());
    }
}
 
function patience_sort(&$n) {
    $piles = array();
    // sort into piles
    foreach ($n as $x) {
        // binary search
        $low = 0; $high = count($piles)-1;
        while ($low <= $high) {
            $mid = (int)(($low + $high) / 2);
            if ($piles[$mid]->top() >= $x)
                $high = $mid - 1;
            else
                $low = $mid + 1;
        }
        $i = $low;
        if ($i == count($piles))
            $piles[] = new SplStack();
        $piles[$i]->push($x);
    }
 
    // priority queue allows us to merge piles efficiently
    $heap = new PilesHeap();
    foreach ($piles as $pile)
        $heap->insert($pile);
    for ($c = 0; $c < count($n); $c++) {
        $smallPile = $heap->extract();
        $n[$c] = $smallPile->pop();
        if (!$smallPile->isEmpty())
        $heap->insert($smallPile);
    }
    assert($heap->isEmpty());
}


//Быстрая

function quicksort($arr){
	$loe = $gt = array();
	if(count($arr) < 2){
		return $arr;
	}
	$pivot_key = key($arr);
	$pivot = array_shift($arr);
	foreach($arr as $val){
		if($val <= $pivot){
			$loe[] = $val;
		}elseif ($val > $pivot){
			$gt[] = $val;
		}
	}
	return array_merge(quicksort($loe),array($pivot_key=>$pivot),quicksort($gt));
}

//Выбором

function selection_sort(&$arr) {
    $n = count($arr);
    for($i = 0; $i < count($arr); $i++) {
        $min = $i;
        for($j = $i + 1; $j < $n; $j++){
            if($arr[$j] < $arr[$min]){
                $min = $j;
            }
        }
        list($arr[$i],$arr[$min]) = array($arr[$min],$arr[$i]);
    }
}

//Шелла

function shellSort($arr)
{
	$inc = round(count($arr)/2);
	while($inc > 0)
	{
		for($i = $inc; $i < count($arr);$i++){
			$temp = $arr[$i];
			$j = $i;
			while($j >= $inc && $arr[$j-$inc] > $temp)
			{
				$arr[$j] = $arr[$j - $inc];
				$j -= $inc;
			}
			$arr[$j] = $temp;
		}
		$inc = round($inc/2.2);
	}
	return $arr;
}

?>