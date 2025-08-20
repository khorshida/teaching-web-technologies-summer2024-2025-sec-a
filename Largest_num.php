<?php
$x=3;
$y=5;
$z=7;

if($x>$y && $x>$z){
  echo $x.":is the largest number";
}
elseif($y>$x && $y>$z){
  echo $y.":is the largest number";
}
else{
  echo $z.":is the largest number";
}
?>