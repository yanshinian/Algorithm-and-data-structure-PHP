<?php

require_once 'Map.php';
class Node
{
    public $key;
    public $value;
    public ?Node $next;

    public function __construct()
    {
        $argv = func_get_args();
        switch (func_num_args()) {
            case 2:
                self::__construct2($argv[0], $argv[1]);
                break;
            case 3:
                self::__construct3($argv[0], $argv[1], $argv[2]);
                break;
            default:
                self::__construct0();
        }
    }
    private function __construct0()
    {
        $this->__construct3(null, null, null);
    }

    private function __construct2($key, $value)
    {
        $this->__construct3($key, $value, null);
    }

    private function __construct3($key, $value, ?Node $next)
    {
        $this->key = $key;
        $this->value = $value;
        $this->next = $next;
    }

    public function __toString():string
    {
        return $this->key . ' : ' . $this->value;
    }
}
class LinkedListMap implements Map
{
    private Node $dummyHead;
    private int $size;

    public function __construct()
    {
        $this->dummyHead = new Node();
        $this->size = 0;
    }

    private function getNode($key)
    {
        $cur = $this->dummyHead->next;
        while ($cur !== null) {
            if ($cur->key === $key) {
                return $cur;
            }
            $cur = $cur->next;
        }

        return null;
    }

    public function add($key, $value)
    {
        $node = $this->getNode($key);
        if ($node === null) {
            $this->dummyHead->next = new Node($key, $value, $this->dummyHead->next); //头插法
            $this->size++;
        } else {
            $node->value = $value; //更新操作
        }
    }

    public function remove($key)
    {
        $prev = $this->dummyHead;
        while ($prev->next !== null) {
            if ($prev->next->key === $key) {
                break;
            }
            $prev = $prev->next;
        }

        if ($prev->next !== null) {
            $delNode = $prev->next;
            $prev->next = $delNode->next;
            $delNode->next = null;
            $this->size--;

            return $delNode->value;
        }

        return null;
    }

    public function contains($key): bool
    {
        return $this->getNode($key) !== null;
    }

    public function get($key)
    {
        $node = $this->getNode($key);

        return $node === null ? null : $node->value;
    }
    public function set($key, $newValue)
    {
        $node = $this->getNode($key);
        if ($node === null) {
            throw new Exception('key doesn\'t exist');
        }
        $node->value = $newValue;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function isEmpty(): bool
    {
        return $this->size === 0;
    }
}
