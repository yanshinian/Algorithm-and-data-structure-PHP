<?php

require_once 'Queue.php';
require_once 'Arrays.php';
class ArrayQueue implements Queue
{
    private Arrays $array;

    public function __construct()
    {
        $argv = func_get_args();
        switch (func_num_args()) {
            case 1:
                self::__construct1($argv[0]);
                break;
            default:
                self::__construct0();
        }
    }

    public function __construct0()
    {
        $this->array = new Arrays();
    }

    public function __construct1(int $capacity)
    {
        $this->array = new Arrays($capacity);
    }

    public function getSize(): int
    {
        return $this->array->getSize();
    }

    public function isEmpty(): bool
    {
        return $this->array->isEmpty();
    }

    public function getCapacity()
    {
        return $this->getCapacity();
    }

    public function enqueue($e):void
    {
        $this->array->addLast($e);
    }

    public function dequeue()
    {
        return $this->array->removeFirst();
    }

    public function getFront()
    {
        return $this->array->getFirst();
    }

    public function __toString()
    {
        $str = 'Queue: front [';
        $size = $this->array->getSize();
        for ($i = 0; $i < $size; $i++) {
            $str .= $this->array->get($i);
            if ($i != $size - 1) {
                $str .= ', ';
            }
        }

        return $str . '] tail';
    }
}
