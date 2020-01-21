<?php

require_once 'UF.php';

// 第二版 Union-Find
class UnionFind3 implements UF
{
    // 第二版 并查集，用一个数组构建 一颗 指向父节点的树。
    // $parent[$i] 表示元素指向的父节点
    private SplFixedArray $parent; // $parent[i] 表示第一个元素所指向的父节点
    private SplFixedArray $sz; // sz[i] 表示以i为根的集合中元素个数

    public function __construct(int $size)
    {
        $this->parent = new SplFixedArray($size);
        $this->sz = new SplFixedArray($size);

        // 初始化，每一个parent[$i] 指向自己，表示每一个元素自己自成一个集合。
        for ($i = 0; $i < $size; $i++) {
            $this->parent[$i] = $i;
            $this->sz[$i] = 1;
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

        // 根据两个元素所在树的元素个数不同判断合并方向。
        // 将元素个数少的集合合并到元素个数多的集合上。
        if ($this->sz[$pRoot] < $this->sz[$qRoot]) {
            $this->parent[$pRoot] = $qRoot;
            $this->sz[$qRoot] += $this->sz[$pRoot];
        } else {
            $this->parent[$qRoot] = $pRoot;
            $this->sz[$pRoot] += $this->sz[$qRoot];
        }
    }
}
