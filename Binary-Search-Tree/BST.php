<?php
declare(strict_types=1);

require_once './Node.php';
require_once '../Utils/Utils.php';

class BST
{
    private ?Node $root;
    private int $size;

    public function __construct()
    {
        $this->root = null;
        $this->size = 0;
    }

    public function size() :int
    {
        return $this->size;
    }

    public function isEmpty() :bool
    {
        return $this->size === 0;
    }

    public function add($e)
    {
        $this->root = $this->_add($this->root, $e);
    }

    public function _add(?Node $node, $e)
    {
        if ($node === null) {
            $this->size++;

            return new Node($e);
        }

        if (Utils::compareTo($e, $node->e) < 0) {
            $node->left = $this->_add($node->left, $e);
        } elseif (Utils::compareTo($e, $node->e) > 0) {
            $node->right = $this->_add($node->right, $e);
        }

        return $node; // $node 就是传入的根节点
    }

    public function contains($e) :bool
    {
        return $this->_contains($this->root, $e);
    }

    private function _contains(Node $node, $e) :bool
    {
        if ($node === null) {
            return false;
        }

        if (Utils::compareTo($e, $node->e) === 0) {
            return true;
        } elseif (Utils::compareTo($e, $node->e) < 0) {
            return $this->_contains($node->left, $e);
        } else {
            return $this->_contains($node->right, $e);
        }
    }

    // 前序（根）遍历
    public function preOrder() :void
    {
        $this->_preorder($this->root);
    }

    public function _preorder(?Node $node):void
    {
        if ($node === null) {
            return ;
        }

        echo $node->e . "\r\n";
        $this->_preorder($node->left);
        $this->_preorder($node->right);
    }

    // 中序（根）遍历 ,由于是二叉搜索树，遍历的结果是有序的
    public function inOrder():void
    {
        $this->_inOrder($this->root);
    }

    public function _inOrder(?Node $node) : void
    {
        if ($node === null) {
            return ;
        }

        $this->_inOrder($node->left);
        echo $node->e . "\r\n";
        $this->_inOrder($node->right);
    }

    public function postOrder() :void
    {
        $this->_postOrder($this->root);
    }
    public function _postOrder(?Node $node) :void
    {
        if ($node === null) {
            return ;
        }

        $this->_preorder($node->left);
        $this->_preorder($node->right);
        echo $node->e . "\r\n";
    }

    // 前序遍历的 非递归写法
    public function preOrderNR():void
    {
        if ($this->root === null) {
            return ;
        }
        $stack = [];
        array_push($stack, $this->root);
        while (count($stack)) {
            $node = array_pop($stack);
            echo $node->e . "\r\n";
            if ($node->right !== null) {
                array_push($stack, $node->right); // 栈是后入先出，先压入右孩子
            }
            if ($node->left !== null) {
                array_push($stack, $node->left);
            }
        }
    }

    // 层序（次）遍历（广度优先遍历 或 叫广度优先搜索 bfs）
    public function levelOrder() :void
    {
        if ($this->root === null) {
            return ;
        }

        $queue = [$this->root];
        while ($node = array_shift($queue)) {
            echo $node->e . "\r\n";
            if ($node->left !== null) {
                $queue[] = $node->left;
            }
            if ($node->right !== null) {
                $queue[] = $node->right;
            }
        }
    }

    public function minimum()
    {
        if ($this->size === 0) {
            throw new Exception('BST is empty');
        }

        return ($this->_minimum($this->root))->e;
    }

    // 二叉树最小的值，在左子树的左子树
    private function _minimum(?Node $node) : Node
    {
        if ($node->left === null) {
            return $node;
        }

        return $this->_minimum($node->left);
    }

    public function maximum()
    {
        if ($this->size === 0) {
            throw  new Exception('BST is empty');
        }

        return ($this->_maximum($this->root))->e;
    }

    private function _maximum(?Node $node) : Node
    {
        if ($node->right === null) {
            return $node;
        }

        return $this->_maximum($node->right);
    }

    // 删除二分搜索树最小的结点
    public function removeMin()
    {
        $minNodoe = $this->minimum();
        $this->root = $this->_removeMin($this->root);

        return $minNodoe;
    }

    // 返回删除后新的 二分 搜索树的根。
    private function _removeMin(?Node $node) : ?Node
    {
        if ($node->left === null) {
            $rightNode = $node->right;
            $node->right = null;
            $this->size--;

            return $rightNode;
        }

        $node->left = $this->_removeMin($node->left);

        return $node;
    }

    public function removeMax()
    {
        $maxNode = $this->maximum();
        $this->root = $this->_removeMax($this->root);

        return $maxNode;
    }

    // 返回删除最大结点后的新的 二分搜索树 的根
    public function _removeMax(?Node $node) : ?Node
    {
        if ($node->right === null) {
            $leftNode = $node->left;
            $node->left = null;
            $this->size--;

            return $leftNode;
        }

        $node->right = $this->_removeMax($node->right);

        return $node;
    }

    public function remove($e) : ?Node
    {
        $node = $this->_remove($this->root, $e);

        return $node;
    }

    public function _remove(?Node $node, $e) : ?Node
    {
        if ($node === null) {
            return null;
        }

        if (Utils::compareTo($e, $node->e) < 0) {
            $node->left = $this->_remove($node->left, $e);

            return $node;
        } elseif (Utils::compareTo($e, $node->e) > 0) {
            $node->right = $this->_remove($node->right, $e);

            return $node;
        } elseif (Utils::compareTo($e, $node->e) === 0) {
            if ($node->left === null) {
                $rightNode = $node->right;
                $node->right = null;
                $this->size--;

                return $rightNode;
            }

            if ($node->right === null) {
                $leftNode = $node->left;
                $node->left = null;
                $this->size--;

                return $leftNode;
            }
            // 两边都不为空 选择右子树的最小值 替换掉 (选择左子树的最大节点也可以)， 保证 右小于 根，左大于根即可
            //

            $successor = $this->_minimum($node->right);
            $successor->right = $this->_removeMin($node->right);
            $successor->left = $node->left;
            $node->left = null;
            $node->right = null;

            return $successor;
        }

        $node->left = $this->_remove($node->left, $e);
        $node->right = $this->_remove($node->right, $e);

        return $node;
    }

    public function __toString()
    {
        $str = '';
        $this->generateString($this->root, 0, $str);

        return $str;
    }

    private function generateString(?Node $node, int $depth, &$str)
    {
        if ($node === null) {
            $str .= $this->generateDepthString($depth) . "null \r\n";

            return ;
        }

        $str .= $this->generateDepthString($depth) . $node->e . "\r\n";
        $this->generateString($node->left, $depth + 1, $str);
        $this->generateString($node->right, $depth + 1, $str);
    }

    private function generateDepthString(int $depth)
    {
        $str = '';
        for ($i = 0; $i < $depth; $i++) {
            $str .= '--';
        }

        return $str;
    }
    // 下面代码是方便理解回顾。上面的 add  方法是优化后的。
//    public function add($e) {
//        if ($this->root === null) {
//            $this->root = new Node($e);
//            $this->size++;
//        } else {
//            $this->_add($this->root, $e);
//        }
//    }
//
//    private function _add(Node $node, $e) {
//        if ($e === $node->e) { // 不能加入重复的元素
//            return;
//        } elseif ($e < $node->e && $node->left === null) {
//            $node->left = new Node($e);
//            $this->size++;
//            return ;
//        } elseif ($e > $node->e && $node->right === null) {
//            $node->right = new Node($e);
//            $this->size++;
//            return ;
//        }
//
//        if ($e < $node->e) {
//            $this->_add($node->left, $e);
//        } else {
//            $this->_add($node->right, $e);
//        }
//    }
}
