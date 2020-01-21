<?php

require_once 'UF.php';

class UnionFind1 implements UF
{
    private SplFixedArray $id;

    public function __construct(int $size)
    {
        $this->id = new SplFixedArray($size);
        for ($i = 0; $i < $size; $i++) {
            $this->id[$i] = $i;
        }
    }

    public function getSize(): int
    {
        return $this->id->count();
    }

    // 查找元素 p 对应的集合编号
    private function find(int $p) :int
    {
        if ($p < 0 || $p >= $this->id->count()) {
            throw new Exception('p is out of bound');
        }

        return $this->id[$p];
    }

    // 查询 p 跟 q 是否 属于一个集合
    public function isConnected(int $p, int $q)
    {
        return $this->find($p) === $this->find($q);
    }

    // 合并元素 p 和元素 q 到一个集合
    // O(n) 复杂度
    public function unionElements(int $p, int $q)
    {
        $pId = $this->find($p);
        $qId = $this->find($q);

        if ($pId === $qId) {
            return;
        }

        // 合并过程中需要遍历一遍所有元素，将两个元素的所属集合编号合并。
        $count = $this->id->count();
        for ($i = 0; $i < $count; $i++) {
            if ($this->id[$i] === $pId) {
                $this->id[$i] = $qId;
            }
        }
    }
}
