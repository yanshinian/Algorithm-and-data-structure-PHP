<?php
require_once 'Trie.php';
//require_once '../../Set-and-Map/BasicBstSet/BSTSet.php';
require_once '../../Utils/File.php';

$contents = File::readFile('../../pride-and-prejudice.txt');


function test(callable $f, $contents)
{
    $startTime = microtime(true);

    $size = call_user_func($f, $contents);
    $endTime = microtime(true);

    return [$size, $endTime - $startTime];
}

//$result = test(function ($contents) {
//    $bstSet = new BSTSet();
//
//    foreach ($contents as $word) {
//        $bstSet->add($word);
//    }
//
//    foreach ($contents as $word) {
//        $bstSet->contains($word);
//    }
//
//    return $bstSet->getSize();
//}, $contents);
//
//[$size, $time] = $result;
//echo 'Total different words: '.$size."\r\n";
//echo 'BSTSet: '.$time." s\r\n";


$result = test(function ($contents) {
    $trie = new Trie();
    foreach ($contents as $word) {
        $trie->add($word);
    }

    foreach ($contents as $word) {
        $trie->contains($word);
    }

    return $trie->getSize();
}, $contents);

[$size, $time] = $result;
echo 'Total different words: ' . $size . "\r\n";
echo 'Trie: ' . $time . " s\r\n";
