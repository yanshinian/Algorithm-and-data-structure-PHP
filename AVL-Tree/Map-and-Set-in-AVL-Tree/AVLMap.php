<?php

require_once 'AVLTree.php';
require_once 'Map.php';

class AVLMap implements Map
{
    private AVLTree $avl;

    public function __construct()
    {
        $this->avl = new AVLTree();
    }

    public function add($key, $value)
    {
        $this->avl->add($key, $value);
    }

    public function remove($key)
    {
        return $this->avl->remove($key);
    }

    public function contains($key): bool
    {
        return $this->avl->contains($key);
    }

    public function get($key)
    {
        return $this->avl->get($key);
    }

    public function set($key, $newValue)
    {
        return $this->avl->set($key, $newValue);
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
