<?php

require_once 'Queue.php';

class LoopQueue implements Queue
{
    private SplFixedArray $data;
    private int $front;
    private int $tail;
    private int $size;

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
        $this->__construct1(10);
    }

    public function __construct1(int $capacity)
    {
        $this->data = new SplFixedArray($capacity);
        $this->front = 0;
        $this->tail = 0;
        $this->size = 0;
    }

    public function getCapacity()
    {
        return count($this->data) - 1;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function isEmpty(): bool
    {
        return $this->front === $this->tail;
    }

    public function enqueue($e): void
    {
        if (($this->tail + 1) % $this->data->count() === $this->front) { // 满了
            $this->resize($this->getCapacity() * 2);
        }
        $this->data[$this->tail] = $e;
        $this->tail = ($this->tail + 1) % $this->data->count();
        $this->size++;
    }

    public function dequeue()
    {
        if ($this->isEmpty()) {
            throw new Exception('queue is empty');
        }

        $e = $this->data[$this->front];
        $this->data[$this->front] = null;
        $this->front = ($this->front + 1) % $this->data->count();
        $this->size--;
        if ($this->size === (int)($this->getCapacity() / 4) && (int)($this->getCapacity() / 2) !== 0) {
            $this->resize((int)($this->getCapacity() / 2));
        }

        return $e;
    }

    public function getFront()
    {
        if ($this->isEmpty()) {
            throw new Exception('queue is empty');
        }

        return $this->data[$this->front];
    }

    public function resize(int $newCapacity)
    {
        $newData = new SplFixedArray($newCapacity);
        for ($i = 0; $i < $this->size; $i++) {
            $newData[$i] = $this->data[($i + $this->front) % $this->data->count()];
        }

        $this->data = $newData;
        $this->front = 0;
        $this->tail = $this->size;
    }

    public function __toString():string
    {
        $str = 'Queue：size =' . $this->size . ', capacity = ' . $this->getCapacity() . "\n";
        $str .= 'front [';
        for ($i = $this->front; $i != $this->tail; $i = ($i + 1) % $this->data->count()) {
            $str .= $this->data[$i];
            if (($i + 1) % $this->data->count() !== $this->tail) {
                $str .= ', ';
            }
        }

        return $str . ' ] tail';
    }
}
