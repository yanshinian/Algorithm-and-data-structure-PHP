<?php

require_once 'Map.php';
require_once '../../Utils/Utils.php';
class Node
{
    public $key;
    public $value;
    public ?Node $left;
    public ?Node $right;

    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
        $this->left = null;
        $this->right = null;
    }

    public function __toString():string
    {
        return $this->key.' : '.$this->value;
    }
}


class BSTMap implements Map
{
    private ?Node $root;
    private int $size;

    public function __construct()
    {
        $this->root = null;
        $this->size = 0;
    }

    public function add($key, $value)
    {
        $this->root = $this->_add($this->root, $key, $value);
    }

    private function _add(?Node $node, $key, $value)
    {
        if ($node === null) {
            $this->size++;
            return new Node($key, $value);
        }

        if (Utils::compareTo($key, $node->key) < 0) {
            $node->left = $this->_add($node->left, $key, $value);
        } elseif (Utils::compareTo($key, $node->key) > 0) {
            $node->right = $this->_add($node->right, $key, $value);
        } else {
            $node->value = $value;
        }

        return $node;
    }

    private function getNode(?Node $node, $key) :?Node
    {
        if ($node === null) {
            return null;
        }

        if ($key === $node->key) {
            return $node;
        } elseif (Utils::compareTo($key, $node->key) < 0) {
            return $this->getNode($node->left, $key);
        } else { //Utils::compareTo($key, $node->key) > 0
            return $this->getNode($node->right, $key);
        }
    }

    public function contains($key): bool
    {
        return $this->getNode($this->root, $key) !== null;
    }

    public function get($key)
    {
        $node = $this->getNode($this->root, $key);
        return $node === null ? null : $node->value;
    }

    public function set($key, $newValue)
    {
        $node = $this->getNode($this->root, $key);
        if ($node === null) {
            throw new Exception('key doesn\'t exist');
        }

        $node->value = $newValue;
    }

    private function minimum(?Node $node)
    {
        if ($node->left === null) {
            return $node;
        }
        return $this->minimum($node->left);
    }

    private function removeMin(Node $node)
    {
        if ($node->left === null) {
            $rightNode = $node->right;
            $node->right = null;
            $this->size--;
            return $rightNode;
        }

        $node->left = $this->removeMin($node->left);
        return $node;
    }

    public function remove($key)
    {
        $node = $this->getNode($this->root, $key);
        if ($node !== null) {
            $root = $this->_remove($this->root, $key);
            return $node->value;
        }
        return null;
    }

    private function _remove(?Node $node, $key)
    {
        if ($node === null) {
            return null;
        }

        if (Utils::compareTo($key, $node->key) < 0) {
            $node->left = $this->_remove($node->left, $key);
            return $node;
        } elseif (Utils::compareTo($key, $node->key) > 0) {
            $node->right = $this->_remove($node->right, $key);
            return $node;
        } else {
            // 待删除节点左子树为空的情况
            if ($node->left === null) {
                $rightNode = $node->right;
                $node->right = null;
                $this->size--;
                return $rightNode;
            }

            // 待删除节点右子树为空的情况
            if ($node->right === null) {
                $leftNode = $node->left;
                $node->left = null;
                $this->size--;
                return $leftNode;
            }

            // 待删除节点左右子树均不为空的情况
            // 找到右侧 最小结点
            $successor = $this->minimum($node->right);
            $successor->right = $this->removeMin($node->right);
            $successor->left = $node->left;

            $node->left = null;
            $node->right = null;
            return $successor;
        }
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
