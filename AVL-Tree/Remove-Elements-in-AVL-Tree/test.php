<?php

include 'AVLTree.php';
require_once '../../Utils/File.php';

$contents = File::readFile('../../pride-and-prejudice.txt');

//sort($contents, SORT_STRING);



$avl = new AVLTree();

foreach ($contents as $word) {
    if ($avl->contains($word)) {
        $avl->set($word, $avl->get($word) + 1);
    } else {
        $avl->add($word, 1);
    }
}

foreach ($contents as $word) {
    $avl->remove($word);
    if (!$avl->isBST() || !$avl->isBalanced()) {
        var_dump('不是 平衡树');
    }
}

$endTime = microtime(true);

echo 'Total different words:' . $avl->getSize() . "\r\n";
echo 'Frequency of PRIDE:' . $avl->get('pride') . "\r\n";
echo 'Frequency of PREJUDICE:' . $avl->get('prejudice') . "\r\n";

//var_dump($avl->isBalanced());
