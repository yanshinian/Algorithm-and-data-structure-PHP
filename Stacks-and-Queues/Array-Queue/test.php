<?php
require_once 'ArrayQueue.php';

$queue = new ArrayQueue();

for ($i = 0; $i < 5; $i++) {
    $queue->enqueue($i);
}

echo $queue . "\r\n";

echo $queue->dequeue() . "\r\n";

echo $queue . "\r\n";
