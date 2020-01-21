<?php
require_once 'BSTMap.php';
require_once '../../Utils/File.php';

$contents = File::readFile('../../pride-and-prejudice.txt');

$bstMap = new BSTMap();

foreach ($contents as $word) {
    if ($bstMap->contains($word)) {
        $bstMap->set($word, $bstMap->get($word) + 1);
    } else {
        $bstMap->add($word, 1);
    }
}

echo 'Total different words:' . $bstMap->getSize() . "\r\n";
echo 'Frequency of PRIDE:' . $bstMap->get('pride') . "\r\n";
echo 'Frequency of PREJUDICE:' . $bstMap->get('prejudice') . "\r\n";
