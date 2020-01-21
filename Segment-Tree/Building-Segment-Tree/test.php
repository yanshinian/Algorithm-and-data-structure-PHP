<?php

require_once 'SegmentTree.php';

$nums = [-2, 0, 3, -5, 2, -1];

$segTree = new SegmentTree($nums, new class implements Merger {
    public function merge($a, $b) : int
    {
        return $a + $b;
    }
});

echo $segTree."\r\n";
var_dump($segTree->query(0, 5));
$segTree->set(0, 4);
var_dump($segTree->query(0, 5));

echo $segTree."\r\n";
