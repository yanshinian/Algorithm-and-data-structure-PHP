<?php

require_once './LinkedList.php';

$linkedList = new LinkedList();

$nums = [1, 2, 3, 4, 5, 6];
foreach ($nums as $num) {
    $linkedList->addFirst($num);
}

echo $linkedList;

$linkedList->addLast(0);

$linkedList->add(1, 7);

echo $linkedList;
