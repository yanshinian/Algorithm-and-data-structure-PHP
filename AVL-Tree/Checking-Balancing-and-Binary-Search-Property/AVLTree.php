<?php

require_once '../../Utils/Utils.php';

class Node
{
    public $key;
    public $value;
    public ?Node $left;
    public ?Node $right;
    public int $height;

    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
        $this->left = null;
        $this->right = null;
        $this->height = 1;
    }
}

class AVLTree
{
    private ?Node $root;
    private int $size;

    public function __construct()
    {
        $this->root = null;
        $this->size = 0;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function isEmpty()
    {
        return $this->size === 0;
    }

    // 判断该二叉树是否是一颗二分搜索树
    public function isBST():bool
    {
        $keys = [];
        $this->inOrder($this->root, $keys);
        $count = count($keys);
        for ($i = 1; $i < $count; $i++) {
            if (Utils::compareTo($keys[$i - 1], $keys[$i]) > 0) {
                return false;
            }
        }

        return true;
    }

    private function inOrder(?Node $node, array &$keys)
    {
        if ($node === null) {
            return ;
        }
        $this->inOrder($node->left, $keys);
        $keys[] = $node->key;
        $this->inOrder($node->right, $keys);
    }

    // 判断二叉树是否是一颗平衡二叉树
    public function isBalanced():bool
    {
        return $this->_isBalanced($this->root);
    }

    // 判断以Node 为根的二叉树是否是一颗平衡二叉树
    private function _isBalanced(?Node $node):bool
    {
        if ($node === null) {
            return true;
        }
        $balanceFactor = $this->getBalanceFactor($node);
        if (abs($balanceFactor) > 1) {
            return false;
        }

        return $this->_isBalanced($node->left) && $this->_isBalanced($node->right);
    }

    // 获得结点 node 的高度
    private function getHeight(?Node $node)
    {
        if ($node === null) {
            return 0;
        }

        return $node->height;
    }

    // 获得结点 node 的平衡因子
    private function getBalanceFactor(?Node $node)
    {
        if ($node === null) {
            return 0;
        }

        return $this->getHeight($node->left) - $this->getHeight($node->right);
    }

    public function add($key, $value):void
    {
        $this->root = $this->_add($this->root, $key, $value);
    }
    // 向以node 为根的二分搜索树插入元素($key, $value)
    // 返回插入新节点后二分搜索树的 根
    private function _add(?Node $node, $key, $value) : Node
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

        // 更新height
        $node->height = 1 + max($this->getHeight($node->left), $this->getHeight($node->right));

        // 计算平衡因子
        $balanceFactor = $this->getBalanceFactor($node);
        if (abs($balanceFactor) > 1) {
            echo "unbalanced : $balanceFactor \r\n";
        }

        return $node;
    }

    private function getNode(?Node $node, $key): ?Node
    {
        if ($node === null) {
            return null;
        }

        if ($key === $node->key) {
            return $node;
        } elseif (Utils::compareTo($key, $node->key) < 0) {
            return $this->getNode($node->left, $key);
        } else {
            return $this->getNode($node->right, $key);
        }
    }

    public function contains($key)
    {
        return $this->getNode($this->root, $key) !== null;
    }

    public function get($key)
    {
        $node = $this->getNode($this->root, $key);

        return $node === null ? null : $node->value;
    }

    public function set($key, $value)
    {
        $node = $this->getNode($this->root, $key);
        if ($node === null) {
            throw new Exception($key . ' doesn\'t exist');
        }

        $node->value = $value;
    }

    // 返回以$node 为根的二分搜索树的最小值所在的节点。
    private function minimum(?Node $node)
    {
        if ($node->left === null) {
            return $node;
        }

        return $this->minimum($node->left);
    }

    // 删除掉以 $node 为 根的二分搜索树中的 最小节点
    // 返回删除节点后新的二分搜索树的根
    private function removeMin(?Node $node)
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

    // 删除指定key 的节点
    public function remove($key)
    {
        $node = $this->getNode($this->root, $key);
        if ($node !== null) {
            $this->root = $this->_remove($this->root, $key);

            return $node->value;
        }

        return null;
    }

    private function _remove(?Node $node, $key):?Node
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
            // 待删除节点 左子树为空的情况
            if ($node->left === null) {
                $rightNode = $node->right;
                $node->right = null;
                $this->size--;

                return $rightNode;
            }

            // 待删除节点 右子树为空的情况
            if ($node->right === null) {
                $leftNode = $node->left;
                $node->left = null;
                $this->size--;

                return $leftNode;
            }

            // 待删除节点左右子树均不为空的情况
            // 找到比待删除节点大的最小节点， 即待删除节点右子树的最小节点
            // 用这个节点顶替待删除节点的位置。

            $successor = $this->minimum($node->right);
            $successor->right = $this->removeMin($node->right);
            $successor->left = $node->left;

            $node->left = null;
            $node->right = null;

            return $successor;
        }
    }
}
