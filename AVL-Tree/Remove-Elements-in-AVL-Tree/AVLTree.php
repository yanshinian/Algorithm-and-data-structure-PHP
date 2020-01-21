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

    // 对节点y进行向右旋转操作，返回旋转后新的根节点x
    //        y                              x
    //       / \                           /   \
    //      x   T4     向右旋转 (y)        z     y
    //     / \       - - - - - - - ->    / \   / \
    //    z   T3                       T1  T2 T3 T4
    //   / \
    // T1   T2
    private function rightRotate(Node $y) :Node
    {
        $x = $y->left;
        $t3 = $x->right;

        // 向右旋转过程
        $x->right = $y;
        $y->left = $t3;

        // 更新height
        $y->height = max($this->getHeight($y->left), $this->getHeight($y->right)) + 1;
        $x->height = max($this->getHeight($x->left), $this->getHeight($x->right)) + 1;

        return $x;
    }

    // 对节点y进行向左旋转操作，返回旋转后新的根节点x
    //    y                             x
    //  /  \                          /   \
    // T1   x      向左旋转 (y)       y     z
    //     / \   - - - - - - - ->   / \   / \
    //   T2  z                     T1 T2 T3 T4
    //      / \
    //     T3 T4

    private function leftRotate(Node $y) :Node
    {
        $x = $y->right;
        $t2 = $x->left;

        // 向左旋转过程
        $x->left = $y;
        $y->right = $t2;

        // 更新height
        $y->height = max($this->getHeight($y->left), $this->getHeight($y->right)) + 1;
        $x->height = max($this->getHeight($x->left), $this->getHeight($x->right)) + 1;

        return $x;
    }

    public function add($key, $value) :void
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

        // 平衡维护 左左 不平衡
        if ($balanceFactor > 1 && $this->getBalanceFactor($node->left) >= 0) {
            return $this->rightRotate($node);
        }

        // 右右 不平衡
        if ($balanceFactor < -1 && $this->getBalanceFactor($node->right) <=0) {
            return $this->leftRotate($node);
        }

        // 左右不平衡
        if ($balanceFactor > 1 && $this->getBalanceFactor($node->left) < 0) {
            // 先 左旋，后 右旋
            $node->left = $this->leftRotate($node->left);
            return $this->rightRotate($node);
        }

        // 右左不平衡
        if ($balanceFactor < -1 && $this->getBalanceFactor($node->right) > 0) {
            $node->right = $this->rightRotate($node->right);
            return $this->leftRotate($node);
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

    // 废弃：由于 removeMin没有维护 平衡
    // 删除掉以 $node 为 根的二分搜索树中的 最小节点
    // 返回删除节点后新的二分搜索树的根
//    private function removeMin(?Node $node)
//    {
//        if ($node->left === null) {
//            $rightNode = $node->right;
//            $node->right = null;
//            $this->size--;
//
//            return $rightNode;
//        }
//
//        $node->left = $this->removeMin($node->left);
//
//        return $node;
//    }

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
            $retNode = $node;
        } elseif (Utils::compareTo($key, $node->key) > 0) {
            $node->right = $this->_remove($node->right, $key);
            $retNode = $node;
        } else {
            // 待删除节点 左子树为空的情况
            if ($node->left === null) {
                $rightNode = $node->right;
                $node->right = null;
                $this->size--;
                $retNode = $rightNode;
            } elseif ($node->right === null) {// 待删除节点 右子树为空的情况
                $leftNode = $node->left;
                $node->left = null;
                $this->size--;

                $retNode = $leftNode;
            } else {
                // 待删除节点左右子树均不为空的情况
                // 找到比待删除节点大的最小节点， 即待删除节点右子树的最小节点
                // 用这个节点顶替待删除节点的位置。
                $successor = $this->minimum($node->right);
//                $successor->right = $this->removeMin($node->right); //因为removeMin里面并不会维持平衡故废弃
                $successor->right = $this->_remove($node->right, $successor->key);
                $successor->left = $node->left;

                $node->left = null;
                $node->right = null;

                $retNode = $successor;
            }
        }

        if ($retNode === null) {
            return null;
        }

        // 更新height
        $retNode->height = max($this->getHeight($retNode->left), $this->getHeight($retNode->right)) + 1;

        // 计算平衡因子
        $balanceFactor = $this->getBalanceFactor($retNode);
        // 平衡维护 针对删除后 返回的根节点进行平衡的维护
        // LL
        if ($balanceFactor > 0 && $this->getBalanceFactor($retNode->left) >= 0) {
            return $this->rightRotate($retNode);
        }

        // RR
        if ($balanceFactor < -1 && $this->getBalanceFactor($retNode->right) <= 0) {
            return $this->leftRotate($retNode);
        }

        // LR
        if ($balanceFactor > 1 && $this->getBalanceFactor($retNode->left) < 0) {
            $retNode->left = $this->leftRotate($retNode->left);
            return $this->rightRotate($retNode);
        }

        // RL
        if ($balanceFactor < -1 && $this->getBalanceFactor($retNode->right) > 0) {
            $retNode->right = $this->rightRotate($retNode->right);
            return $this->leftRotate($retNode);
        }

        return $retNode;
    }
}
