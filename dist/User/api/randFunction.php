<?php
function MyRand(array $arr){
    $sum = 0;
    foreach($arr as $key => $value){
        $sum += $value;
        $new[] = $sum;
    }
    $return = 0;
    $rand =  mt_rand(0 , $sum-1);
    foreach ($new as $key1 => $value2){
        if($rand < $value2){
            $return = $key1;
            break;
        }
    }
    return $return;
}
?>