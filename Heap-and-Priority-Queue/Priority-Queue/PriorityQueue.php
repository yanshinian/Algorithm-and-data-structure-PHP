<?php

require_once 'MaxHeap.php';
require_once 'Queue.php';

class PriorityQueue implements Queue
{
    private MaxHeap $maxHeap;

    public function __construct()
    {
        $this->maxHeap = new MaxHeap();
    }

    public function getSize(): int
    {
        return $this->maxHeap->size();
    }

    public function isEmpty(): bool
    {
        return $this->maxHeap->isEmpty();
    }

    public function enqueue($e): void
    {
        $this->maxHeap->add($e);
    }

    public function dequeue()
    {
        return $this->maxHeap->extractMax();
    }

    public function getFront()
    {
        return $this->maxHeap->findMax();
    }
}
