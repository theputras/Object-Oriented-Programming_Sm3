<?php
include_once  'manusia.php';
include_once 'laki.php';
include_once 'perempuan.php';

$tinggiL = 170;
$tinggiP = 160;

$l = new laki($tinggiL);
$p = new perempuan($tinggiP);

echo $l -> BMI();
echo '<br>';
echo $p -> BMI();