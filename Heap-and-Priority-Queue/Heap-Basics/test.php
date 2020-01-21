<?php

require_once 'MaxHeap.php';

//$n = 1000000;
//
//$maxHeap = new MaxHeap();
//
//for ($i = 0; $i < $n; $i++) {
//    $maxHeap->add(random_int(0, PHP_INT_MAX));
//}
//
//$arr = [];
//for ($i = 0; $i < $n; $i++) {
//    $arr[$i] = $maxHeap->extractMax();
//}
//
//for ($i = 1; $i < $n; $i++) {
//    if ($arr[$i - 1] < $arr[$i]) {
//        throw new Exception('Error');
//    }
//}

//echo 'successful test';

function testHeap(array $testData, bool $isHeapify)
{
    $count = count($testData);
    $startTime = microtime(true);
    if ($isHeapify) {
        $maxHeap = new MaxHeap($testData);
    } else {
        $maxHeap = new MaxHeap($count);
        foreach ($testData as $data) {
            $maxHeap->add($data);
        }
    }

    $arr = [];
    for ($i = 0; $i < $count; $i++) {
        $arr[$i] = $maxHeap->extractMax();
    }

    for ($i = 1; $i < $count; $i++) {
        if ($arr[$i - 1] < $arr[$i]) {
            throw new Exception('Error');
        }
    }

    $endTime = microtime(true);

    return $endTime - $startTime;
}

$n = 1000000;
$testData = [];
for ($i = 0; $i < $n; $i++) {
    $testData[$i] = random_int(0, PHP_INT_MAX);
}

$time1 = testHeap($testData, false);
echo 'Without heapify: ' . $time1 . "s \r\n";
$time2 = testHeap($testData, true);

echo 'With heapify: ' . $time2 . "s \r\n";
