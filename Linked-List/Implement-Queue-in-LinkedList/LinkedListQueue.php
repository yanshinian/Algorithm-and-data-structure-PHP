<?php

require_once 'Queue.php';
class Node
{
    public $e;
    public ?Node $next;
    public function __construct()
    {
        $argv = func_get_args();
        switch (func_num_args()) {
            case 1:
                self::__construct1($argv[0]);
                break;
            case 2:
                self::__construct2($argv[0], $argv[1]);
                break;
            default:
                self::__construct0();
        }
    }
    private function __construct0()
    {
        $this->__construct2(null, null);
    }
    private function __construct1($e)
    {
        $this->__construct2($e, null);
    }

    private function __construct2($e, ?Node $next)
    {
        $this->e = $e;
        $this->next = $next;
    }

    public function __toString() :string
    {
        return (string)$this->e;
    }
}


class LinkedListQueue implements Queue
{
    private ?Node $head;
    private ?Node $tail;
    private int $size;

    public function __construct()
    {
        $this->head = null; // 这次不用 dummyhead 是因为不针对中间元素进行操作。
        $this->tail = null;
        $this->size = 0;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function isEmpty(): bool
    {
        return $this->size === 0;
    }

    public function enqueue($e): void
    {
        if ($this->tail === null) {
            $this->tail = new Node($e);
            $this->head = $this->tail;
        } else {
            $this->tail->next = new Node($e);
            $this->tail = $this->tail->next;
        }
        $this->size++;
    }

    public function dequeue()
    {
        if ($this->isEmpty()) {
            throw new Exception('queue is empty');
        }

        $retNode = $this->head;
        $this->head = $this->head->next;
        $retNode->next = null; // 彻底断开
        if ($this->head === null) {
            $this->tail = null;
        }
        $this->size--;

        return $retNode->e;
    }

    public function getFront()
    {
        if ($this->isEmpty()) {
            throw new Exception('Queue is empty');
        }

        return $this->head->e;
    }

    public function __toString() :string
    {
        $str = 'Queue: front ';
        $cur = $this->head;

        while ($cur !== null) {
            $str .= $cur . '->';
            $cur = $cur->next;
        }

        return $str . 'null tail';
    }
}
