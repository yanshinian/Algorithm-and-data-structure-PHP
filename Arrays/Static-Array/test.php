<?php

require_once './Arrays.php';
require_once './Student.php';

$array = new Arrays(20);

for ($i = 0; $i < 10; $i++) {
    $array->addFirst($i);
}
echo $array . "\r\n";
$array->addFirst(-1);
echo $array . "\r\n";
$array->set(0, -2);
echo $array . "\r\n";
echo $array->get(0) . "\r\n";
$array->remove(0);
echo $array . "\r\n";
$array->removeFirst(0);
echo $array . "\r\n";

$array = new Arrays();
$array->addLast(new Student('周杰伦', 100));
$array->addLast(new Student('苏志燮', 99));
$array->addLast(new Student('木村拓哉', 98));

echo $array;
