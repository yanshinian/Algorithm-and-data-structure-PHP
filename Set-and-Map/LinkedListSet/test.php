<?php

require_once './LinkedListSet.php';
require_once '../../Utils/File.php';
//require_once '../BasicBstSet/BSTSet.php';

$contents = File::readFile('../../pride-and-prejudice.txt');

//var_dump(count($contents));
$linkedListSet = new LinkedListSet();

foreach ($contents as $word) {
    $linkedListSet->add($word);
}

echo 'Total words:' . count($contents) . "\r\n";
echo  'Total different words: ' . $linkedListSet->getSize() . "\r\n";

//$contents = File::readFile('../../a-tale-of-two-cities.txt');
//
////var_dump(count($contents));
//$linkedListSet = new LinkedListSet();
//
//foreach ($contents as $word) {
//    $linkedListSet->add($word);
//}
//
//echo 'Total words:'.count($contents)."\r\n";
//echo  'Total different words: '.$linkedListSet->getSize()."\r\n";
//
function testSet(Set $set, String $fileName)
{
    $startTime = microtime(true);

    $contents = File::readFile($fileName);


    foreach ($contents as $word) {
        $set->add($word);
    }

    $endTime = microtime(true);

    return $endTime - $startTime;
}

//$bstSet = new BSTSet();
//$time1 = testSet($bstSet, '../../pride-and-prejudice.txt');
//echo sprintf("Bst Set: %f s \r\n", $time1);

$linkedListSet = new LinkedListSet();
$time2 = testSet($linkedListSet, '../../pride-and-prejudice.txt');
echo sprintf("Linked List Set: %f s \r\n", $time2);
