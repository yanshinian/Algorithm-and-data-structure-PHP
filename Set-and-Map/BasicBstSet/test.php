<?php

require_once './BST.php';
require_once './BSTSet.php';
require_once '../../Utils/File.php';

$contents = File::readFile('../../pride-and-prejudice.txt');

//var_dump(count($contents));
$bstSet = new BSTSet();

foreach ($contents as $word) {
    $bstSet->add($word);
}

echo 'Total words:' . count($contents) . "\r\n";
echo  'Total different words: ' . $bstSet->getSize() . "\r\n";

$contents = File::readFile('../../a-tale-of-two-cities.txt');

//var_dump(count($contents));
$bstSet = new BSTSet();

foreach ($contents as $word) {
    $bstSet->add($word);
}

echo 'Total words:' . count($contents) . "\r\n";
echo  'Total different words: ' . $bstSet->getSize() . "\r\n";
