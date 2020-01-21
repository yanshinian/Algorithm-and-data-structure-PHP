<?php


class SegmentTree
{
    private SplFixedArray $tree;
    private SplFixedArray $data;

    public function __construct(array $arr)
    {
        $count = count($arr);
        $this->data = new SplFixedArray($count);
        for ($i = 0; $i < $count; $i++) {
            $this->data[$i] = $arr[$i];
        }

        $this->tree = new SplFixedArray($count << 2);
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
}
