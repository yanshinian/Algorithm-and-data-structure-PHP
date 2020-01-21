<?php

require_once 'Merger.php';
class SegmentTree
{
    private SplFixedArray $tree;
    private SplFixedArray $data;
    private Merger $merger;

    public function __construct(array $arr, Merger $merger)
    {
        $this->merger = $merger;
        $count = count($arr);
        $this->data = new SplFixedArray($count);
        for ($i = 0; $i < $count; $i++) {
            $this->data[$i] = $arr[$i];
        }

        $this->tree = new SplFixedArray($count << 2);
        $this->buildSegmentTree(0, 0, $count - 1);
    }

    // 在 treeIndex 的位置创建表示区间[l...r] 的线段树
    private function buildSegmentTree(int $treeIndex, int $l, int $r)
    {
        if ($l === $r) { // 不能再划分就递归到底了。
            $this->tree[$treeIndex] = $this->data[$l];

            return ;
        }

        $leftTreeIndex = $this->leftChild($treeIndex);
        $rightTreeIndex = $this->rightChild($treeIndex);

        $mid = $l + (($r - $l) >> 1);
        $this->buildSegmentTree($leftTreeIndex, $l, $mid);
        $this->buildSegmentTree($rightTreeIndex, $mid + 1, $r);

        $this->tree[$treeIndex] = $this->merger->merge($this->tree[$leftTreeIndex], $this->tree[$rightTreeIndex]);
    }
    public function getSize()
    {
        return $this->data->count();
    }

    public function get(int $index)
    {
        if ($index < 0 || $index >= $this->data->count()) {
            throw new Exception('Index is illegal');
        }

        return $this->data[$index];
    }

    // 返回 完全二叉树的 数组表示中  一个 指定 索引 元素的 左孩子 索引
    private function leftChild(int $index): int
    {
        return ($index << 1) + 1;
    }

    // 返回 完全二叉树的 数组表示中  一个 指定 索引 元素的 右孩子 索引
    private function rightChild(int $index):int
    {
        return ($index << 1) + 2;
    }

    // 返回区间[$queryL, $queryR] 的值
    public function query(int $queryL, int $queryR)
    {
        $count = $this->data->count();
        if ($queryL < 0 || $queryL >= $count || $queryR < 0 || $queryR >= $count || $queryL > $queryR) {
            throw new Exception('Index is illegal.');
        }

        return $this->_query(0, 0, $count - 1, $queryL, $queryR);
    }

    // 在以treeIndex 为根的线段树中[$l...$r]的范围里，搜索区间[$queryL...$queryR] 的值
    private function _query(int $treeIndex, int $l, int $r, int $queryL, int $queryR)
    {
        if ($l === $queryL && $r === $queryR) {
            return $this->tree[$treeIndex];
        }

        $mid = $l + (($r - $l) >> 1);
        // 以treeIndex 的结点 分为 [$l...$mid] 和 [$mid+1 ... $r] 两部分

        $leftTreeIndex = $this->leftChild($treeIndex);

        $rightTreeIndex = $this->rightChild($treeIndex);

        if ($queryL >= $mid + 1) {
            return $this->_query($rightTreeIndex, $mid + 1, $r, $queryL, $queryR);
        } elseif ($queryR <= $mid) {
            return $this->_query($leftTreeIndex, $l, $mid, $queryL, $queryR);
        }

        $leftResult = $this->_query($leftTreeIndex, $l, $mid, $queryL, $mid);
        $rightResult = $this->_query($rightTreeIndex, $mid + 1, $r, $mid + 1, $queryR);

        return $this->merger->merge($leftResult, $rightResult);
    }

    // 更新指定索引的 元素 以及对应的区间
    public function set(int $index, $e)
    {
        $count = $this->data->count();
        if ($index < 0 || $index >= $count) {
            throw new Exception('Index is illegal');
        }

        $this->data[$index] = $e;

        $this->_set(0, 0, $count - 1, $index, $e);
    }

    private function _set(int $treeIndex, int $l, int $r, int $index, $e)
    {
        if ($l === $r) {
            $this->tree[$treeIndex] = $e;

            return ;
        }

        $mid = $l + (($r - $l) >> 1);
        // treeIndex 的结点分为 [$l...$mid] 和 [$mid+1...$r]两部分

        $leftTreeIndex = $this->leftChild($treeIndex);
        $rightTreeIndex = $this->rightChild($treeIndex);
        if ($index >= $mid + 1) {
            $this->_set($rightTreeIndex, $mid + 1, $r, $index, $e);
        } else {
            $this->_set($leftTreeIndex, $l, $mid, $index, $e);
        }

        $this->tree[$treeIndex] = $this->merger->merge($this->tree[$leftTreeIndex], $this->tree[$rightTreeIndex]);
    }
    public function __toString() :string
    {
        $str = '[';
        $count = $this->tree->count();
        for ($i = 0; $i < $count; $i++) {
            if ($this->tree[$i] !== null) {
                $str .= $this->tree[$i];
            } else {
                $str .= 'null';
            }
            if ($i !== $count - 1) {
                $str .= ',';
            }
        }

        return $str . ']';
    }
}
