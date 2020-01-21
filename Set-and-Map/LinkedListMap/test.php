<?php

require_once 'LinkedListMap.php';
require_once '../../Utils/File.php';

$contents = File::readFile('../../pride-and-prejudice.txt');

//var_dump(count($contents));
$linkedListMap = new LinkedListMap();

foreach ($contents as $word) {
    if ($linkedListMap->contains($word)) {
        $linkedListMap->set($word, $linkedListMap->get($word) + 1);
    } else {
        $linkedListMap->add($word, 1);
    }
}

echo 'Total different words:' . $linkedListMap->getSize() . "\r\n";
echo 'Frequency of PRIDE:' . $linkedListMap->get('pride') . "\r\n";
echo 'Frequency of PREJUDICE:' . $linkedListMap->get('prejudice') . "\r\n";

// php 统计到的单个单词的数量跟教程中一致
//Total different words:6524
//Frequency of PRIDE:53
//Frequency of PREJUDICE:11
