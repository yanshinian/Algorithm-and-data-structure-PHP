<?php

include 'AVLMap.php';
include 'AVLSet.php';
//include '../../Set-and-Map/BSTMap/BSTMap.php';
require_once '../../Utils/File.php';

$contents = File::readFile('../../pride-and-prejudice.txt');

//sort($contents, SORT_STRING);

//$startTime = microtime(true);
//
//$bstMap = new BSTMap();
//
//foreach ($contents as $word) {
//    if ($bstMap->contains($word)) {
//        $bstMap->set($word, $bstMap->get($word) + 1);
//    } else {
//        $bstMap->add($word, 1);
//    }
//}
//foreach ($contents as $word) {
//    $bstMap->contains($word);
//}
//
//echo 'Total different words:'.$bstMap->getSize()."\r\n";
//echo 'Frequency of PRIDE:'.$bstMap->get('pride')."\r\n";
//echo 'Frequency of PREJUDICE:'.$bstMap->get('prejudice')."\r\n";
//
//$endTime = microtime(true);
//
//var_dump($endTime - $startTime);

$startTime = microtime(true);

$avl = new AVLMap();

foreach ($contents as $word) {
    if ($avl->contains($word)) {
        $avl->set($word, $avl->get($word) + 1);
    } else {
        $avl->add($word, 1);
    }
}

foreach ($contents as $word) {
    $avl->contains($word);
}

$endTime = microtime(true);

echo 'Total different words:' . $avl->getSize() . "\r\n";
echo 'Frequency of PRIDE:' . $avl->get('pride') . "\r\n";
echo 'Frequency of PREJUDICE:' . $avl->get('prejudice') . "\r\n";

//var_dump($avl->isBalanced());
var_dump($endTime - $startTime);

$startTime = microtime(true);

$avl = new AVLSet();

foreach ($contents as $word) {
    if ($avl->contains($word)) {
        $avl->set($word);
    }
}

foreach ($contents as $word) {
    $avl->contains($word);
}

$endTime = microtime(true);


var_dump($endTime - $startTime);
