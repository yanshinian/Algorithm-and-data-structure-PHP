<?php
require_once 'LoopQueue.php';
require_once 'Queue.php';
require_once '../Array-Queue/ArrayQueue.php';

$queue = new LoopQueue();

for ($i = 0; $i < 10; $i++) {
    $queue->enqueue($i);
}

echo $queue . "\r\n";

echo $queue->dequeue() . "\r\n";

echo $queue . "\r\n";

$queue->enqueue(11);
$queue->enqueue(12);
$queue->enqueue(13);
echo $queue . "\r\n";
var_dump($queue->getFront());

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
$opCount = 100000;
$loopQueue = new LoopQueue();
$time2 = testQueue($loopQueue, $opCount);
echo 'LoopQueue, time:' . $time2 . '秒' . "\r\n";
