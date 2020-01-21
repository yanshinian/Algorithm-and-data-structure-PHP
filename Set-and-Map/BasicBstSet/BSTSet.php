<?php
declare(strict_types=1);
require_once 'BST.php';
require_once 'Set.php';

class BSTSet implements Set
{
    private BST $bst;

    public function __construct()
    {
        $this->bst = new BST();
    }

    public function add($e): void
    {
        $this->bst->add($e);
    }

    public function contains($e): bool
    {
        return $this->bst->contains($e);
    }

    public function remove($e): void
    {
        $this->remove($e);
    }

    public function getSize(): int
    {
        return $this->bst->size();
    }

    public function isEmpty(): bool
    {
        return $this->bst->isEmpty();
    }
    public function __toString()
    {
        return json_encode($this->bst);
    }
}
