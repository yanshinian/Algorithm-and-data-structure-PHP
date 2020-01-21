<?php
require_once 'Stack.php';
require_once 'LinkedList.php';
class LinkedListStack implements Stack
{
    private LinkedList $list;

    public function __construct()
    {
        $this->list = new LinkedList();
    }

    public function getSize(): int
    {
        return $this->list->getSize();
    }

    public function isEmpty(): bool
    {
        return $this->list->isEmpty();
    }

    public function push($e)
    {
        $this->list->addFirst($e);
    }

    public function pop()
    {
        return $this->list->removeFirst();
    }

    public function peek()
    {
        return $this->list->getFirst();
    }

    public function __toString():string
    {
        return 'Stack: top ' . $this->list;
    }
}
