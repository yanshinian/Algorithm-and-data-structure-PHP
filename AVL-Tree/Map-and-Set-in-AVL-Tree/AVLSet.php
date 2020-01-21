<?php
require_once 'Set.php';
require_once 'AVLTree.php';

class AVLSet implements Set
{
    private AVLTree $avl;

    public function __construct()
    {
        $this->avl = new AVLTree();
    }

    public function add($e): void
    {
        $this->avl->add($e, null);
    }

    public function contains($e): bool
    {
        return $this->avl->contains($e);
    }

    public function remove($e): void
    {
        $this->avl->remove($e);
    }

    public function getSize(): int
    {
        return $this->avl->getSize();
    }

    public function isEmpty(): bool
    {
        return $this->avl->isEmpty();
    }
}
