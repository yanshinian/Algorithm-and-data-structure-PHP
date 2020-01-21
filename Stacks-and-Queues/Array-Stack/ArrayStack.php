<?php
require_once 'Stack.php';
require_once 'Arrays.php';

class ArrayStack implements Stack
{
    private Arrays $array;

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
        return $this->array->getCapacity();
    }
    public function push($e)
    {
        $this->array->addLast($e);
    }

    public function pop()
    {
        return $this->array->removeLast();
    }

    public function peek()
    {
        return $this->array->getLast();
    }

    public function __toString():string
    {
        $str = 'Stack: [';
        $size = $this->array->getSize();
        for ($i = 0; $i < $size; $i++) {
            $str .= $this->array->get($i);
            if ($i != $size - 1) {
                $str .= ', ';
            }
        }

        return $str .= '] top';
    }
}
