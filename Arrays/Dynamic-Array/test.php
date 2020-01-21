<?php
require_once './Arrays.php';

$array = new Arrays();

for ($i = 0; $i < 10; $i++) {
    $array->addLast($i);
}

echo $array . "\r\n";

$array->add(1, 100);
echo $array . "\r\n";

echo $array->getSize();
