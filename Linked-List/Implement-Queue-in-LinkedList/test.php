<?php
require_once 'LinkedListQueue.php';
require_once '../../Stacks-and-Queues/Array-Queue/ArrayQueue.php';
require_once '../../Stacks-and-Queues/Loop-Queue/LoopQueue.php';

function testQueue(Queue $q, int $opCount)
{
    $startTime = microtime(true);
    for ($i = 0; $i < $opCount; $i++) {
//        $q->enqueue(random_int(0, $opCount));
        $q->enqueue($i);
    }

    for ($i = 0; $i < $opCount; $i++) {
        $q->dequeue();
    }

    $endTime = microtime(true);

    return $endTime - $startTime;
}

$opCount = 30000;
$arrayQueue = new ArrayQueue();
$time1 = testQueue($arrayQueue, $opCount);

echo 'ArrayQueue, time:' . $time1 . '秒' . "\r\n";
$opCount = 30000;
$loopQueue = new LoopQueue();
$time2 = testQueue($loopQueue, $opCount);
echo 'LoopQueue, time:' . $time2 . '秒' . "\r\n";

$opCount = 30000;
$loopQueue = new LinkedListQueue();
$time2 = testQueue($loopQueue, $opCount);
echo 'LinkedListQueue, time:' . $time2 . '秒' . "\r\n";
