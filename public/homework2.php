<?php
header('content-type:text/html;charset=utf-8');
      $a = 3;
      $b = 5;
      $c = 7;
      $d = true;
      $d++;
      if($a = 0 || $b++ && $c++){
             $a++;
             $b++;
             $c++;
          }
      echo $a,$b,$c,$d;
      echo "\n";
      echo "\n";
      echo "\n";

      $a = 3;
      $b = 5;
      $c = 7;
      if($a = 5 || $b++ && $c++){
             $a++;
             $b++;
             $c++;
          }
      echo $a,$b,$c;
      echo "\n";
      echo "\n";
      echo "\n";



/*
 *1.
 *  $a = 3;
 *  $b = 5;
 *  $c = 7;
 *  if($a = 0 || $b++ && $c++){
 *     $a++;
 *     $b++;
 *     $c++
 *  } 
 *  echo $a,$b,$c;
 *  
 *  2.
 *  $a = 3;
 *  $b = 5;
 *  $c = 7;
 *  if($a = 5 || $b++ && $c++){
 *     $a++;
 *     $b++;
 *     $c++
 *  } 
 *  echo $a,$b,$c;
 */
$Num1 = fgets(STDIN);
if ($Num1>90 && $Num1<=100){
    echo "优秀";
}
elseif ($Num1>80 && $Num1<=90){
    echo "良上";
}
elseif ($Num1>70 && $Num1<=80){
    echo "良下";
}
elseif ($Num1>=60 && $Num1<=70){
    echo "及格";
}
elseif ($Num1>0 && $Num1<60){
    echo "不及格";
}
else{
    echo "Error!!!";
}
/*
 * 多分支语句或switch
 * [90,100] 输出优秀
 * [80,90)  输出良上
 * [70,80)  输出良下
 * [60,70)  输出及格
 * [0,60)   输出不及格
 * 其他：
 *    判断输出的是合法数字或数字字符串
 *    判断输出的范围是 0-100范围
 */









