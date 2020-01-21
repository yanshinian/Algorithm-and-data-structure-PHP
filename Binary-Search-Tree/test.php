<?php

include './BST.php';

$bst = new BST();
$nums = [5, 3, 6, 8, 4, 2];

foreach ($nums as $num) {
    $bst->add($num);
}
//var_dump($bst->size());

//print_r("--------\r\n");
//
//$bst->preOrder();
//$bst->preOrderNR();
//print_r("--------\r\n");
//echo $bst;
//print_r("--------\r\n");
//$bst->levelOrder();
//print_r("--------\r\n");
//
//$minNode =  $bst->minimum();
//echo $minNode;
//print_r("--------\r\n");
//$maxNode =  $bst->maximum();
//echo $maxNode;
//print_r("--------\r\n");

//$bst->removeMin();
//echo $bst;
//
//$bst->removeMax();
//echo $bst;

// 验证删除最小值，是否是有序

//$nums = [];
//while(!$bst->isEmpty()) {
//    $nums[] = $bst->removeMin();
//}
//var_dump($nums);

$bst->remove(3);

echo $bst->inOrder();
