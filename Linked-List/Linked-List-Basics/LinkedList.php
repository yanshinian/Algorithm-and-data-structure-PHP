<?php

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
}

class LinkedList
{
    private ?Node $head;
    private int $size;
    public function __construct()
    {
        $this->head = null;
        $this->size = 0;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function isEmpty():bool
    {
        return $this->size === 0;
    }

    public function addFirst($e):void
    {
        $this->head = new Node($e, $this->head);
        $this->size++;
    }

    public function add(int $index, $e) :void
    {
        if ($index < 0 || $index > $this->size) {
            throw new Exception('Add failed. Illegal Index');
        }

        if ($index === 0) {
            $this->addFirst($e);
        } else {
            $prev = $this->head;
            for ($i = 0; $i < $index - 1; $i++) {
                $prev = $prev->next;
            }
            $prev->next = new Node($e, $prev->next);
            $this->size++;
        }
    }


    public function addLast($e):void
    {
        $this->add($this->size, $e);
    }

    public function __toString()
    {
        return json_encode($this->head) . "\r\n";
    }
}
