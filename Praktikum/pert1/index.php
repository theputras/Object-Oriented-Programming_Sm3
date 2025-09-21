<?php

//memanggil motor.php
include './motor.php';


//memanggil class
$obj = new motor();

//isi data motor
$obj->setMerk("Manchester United");



//memunculkan ke browser
echo $obj->getMerk();