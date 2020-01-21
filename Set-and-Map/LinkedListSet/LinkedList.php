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
            case 3:
                self::__construct2($argv[0], $argv[1], $argv[2]);
                // no break
            default:
                self::__construct0();
        }
    }
    public function __construct0()
    {
        $this->__construct2(null, null);
    }
    public function __construct1($e)
    {
        $this->__construct2($e, null);
    }

    public function __construct2($e, ?Node $next)
    {
        $this->e = $e;
        $this->next = $next;
    }

    public function __toString() :string
    {
        return (string)$this->e;
    }
}

class LinkedList
{
    private ?Node $dummyHead;
    private int $size;

    public function __construct()
    {
        $this->dummyHead = new Node();
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
        $this->add(0, $e);
    }

    public function add(int $index, $e) :void
    {
        if ($index < 0 || $index > $this->size) {
            throw new Exception('Add failed. Illegal Index');
        }

        $prev = $this->dummyHead;
        for ($i = 0; $i < $index; $i++) {
            $prev = $prev->next;
        }
        $prev->next = new Node($e, $prev->next);
        $this->size++;
    }

    public function addLast($e):void
    {
        $this->add($this->size, $e);
    }

    public function get(int $index)
    {
        if ($index < 0 || $index >= $this->size) {
            throw new  Exception('Get failed. Illegal Index.');
        }

        $cur = $this->dummyHead->next;
        for ($i = 0; $i < $index; $i++) {
            $cur = $cur->next;
        }

        return $cur->e;
    }

    // 获取链表的第一个元素
    public function getFirst()
    {
        return $this->get(0);
    }

    // 获取链表的最后一个元素
    public function getLast()
    {
        return $this->get($this->size - 1);
    }

    // 修改链表的第index（0-based）个位置的元素为e；
    // 在链表中不是一个常用的操作，练习用。
    public function set(int $index, $e) :void
    {
        if ($index < 0 || $index > $this->size) {
            throw new Exception('Set failed. Illegal index.');
        }

        $cur = $this->dummyHead->next;
        for ($i = 0; $i < $index; $i++) {
            $cur = $cur->next;
        }
        $cur->e = $e;
    }

    public function contains($e)
    {
        $cur = $this->dummyHead->next;

        while ($cur !== null) {
            if ($cur->e === $e) {
                return true;
            }
            $cur = $cur->next;
        }

        return false;
    }

    // 从链表中删除指定位置的元素
    // 在链表中不是常用的操作。练习用
    public function remove(int $index)
    {
        if ($index < 0 || $index >= $this->size) {
            throw new Exception('Remove Error. Illegal Index.');
        }

        $prev = $this->dummyHead;
        for ($i = 0; $i < $index; $i++) {
            $prev = $prev->next;
        }

        $nextNode = $prev->next;
        $prev->next = $nextNode->next;
        $nextNode->next = null; // 与这个链表断开
        $this->size--;

        return $nextNode->e;
    }

    public function removeFirst()
    {
        return $this->remove(0);
    }

    public function removeLast()
    {
        return $this->remove($this->size - 1);
    }

    public function removeElement($e)
    {
        $prev = $this->dummyHead;
        while ($prev->next !== null) {
            if ($prev->next->e === $e) {
                break;
            }
            $prev = $prev->next;
        }

        if ($prev->next != null) {
            $delNode = $prev->next;
            $prev->next = $delNode->next;
            $delNode->next = null;
            $this->size--;
        }
    }

    public function __toString():string
    {
        $str = '';
        for ($cur = $this->dummyHead->next; $cur !== null; $cur = $cur->next) {
            $str .= $cur . '->';
        }
        $str .= "null\r\n";

        return $str;
    }
}
