<?php

require_once './Set.php';
require_once './LinkedList.php';

class LinkedListSet implements Set
{
    private LinkedList $list;

    public function __construct()
    {
        $this->list = new LinkedList();
    }

    public function add($e): void
    {
        if (!$this->list->contains($e)) {
            $this->list->addFirst($e);
        }
    }

    public function contains($e): bool
    {
        return $this->list->contains($e);
    }

    public function remove($e): void
    {
        $this->list->removeElement($e);
    }

    public function getSize(): int
    {
        return $this->list->getSize();
    }

    public function isEmpty(): bool
    {
        return $this->list->isEmpty();
    }
}
