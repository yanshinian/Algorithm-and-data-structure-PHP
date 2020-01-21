<?php

require_once 'UF.php';

// 第二版 Union-Find
class UnionFind2 implements UF
{
    // 第二版 并查集，用一个数组构建 一颗 指向父节点的树。
    // $parent[$i] 表示元素指向的父节点
    private SplFixedArray $parent;

    public function __construct(int $size)
    {
        $this->parent = new SplFixedArray($size);
        for ($i = 0; $i < $size; $i++) {
            $this->parent[$i] = $i;
        }
    }

    public function getSize(): int
    {
        return $this->parent->count();
    }

    // 查找过程，查找元素p所对应的集合编号
    // O(h) 复杂度， h 为树的高度
    private function find(int $p) :int
    {
        if ($p < 0 || $p >= $this->parent->count()) {
            throw new Exception('p is out of bound');
        }

        // 不断去查询自己的父亲节点，直到达到根节点
        // 根节点的特点：$this->parent[$p] === $p;
        while ($p !== $this->parent[$p]) {
            $p = $this->parent[$p];
        }

        return $p;
    }

    public function isConnected(int $p, int $q)
    {
        return $this->find($p) === $this->find($q);
    }

    // 合并元素 p 和 元素 q 所属的集合
    // O(h) 复杂度，h为树的高度
    public function unionElements(int $p, int $q)
    {
        $pRoot = $this->find($p);
        $qRoot = $this->find($q);

        if ($pRoot === $qRoot) {
            return ;
        }
        $this->parent[$pRoot] = $qRoot;
    }
}
