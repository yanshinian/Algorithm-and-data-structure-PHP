<?php
require_once 'Arrays.php';
require_once '../../Utils/Utils.php';
class MaxHeap
{
    private Arrays $data;

    public function __construct()
    {
        $argv = func_get_args();
        switch (func_num_args()) {
            case 1:
                if (is_int($argv[0])) {
                    self::__construct1($argv[0]);
                } elseif (is_array($argv[0])) {
                    $this->__constructWithArray($argv[0]);
                }
                break;
            default:
                self::__construct0();
        }
    }

    private function __construct0()
    {
        $this->data = new Arrays();
    }

    private function __construct1(int $capacity)
    {
        $this->data = new Arrays($capacity);
    }
    private function __constructWithArray(array $arr)
    {
        $this->data = new Arrays($arr);
        for ($i = $this->parent(count($arr) - 1); $i >= 0; $i--) {
            $this->siftDown($i);
        }
    }

    public function size() :int
    {
        return $this->data->getSize();
    }

    public function isEmpty():bool
    {
        return $this->data->isEmpty();
    }

    // 返回完全二叉树的数组中，一个索引元素对应的父亲元素的索引
    private function parent(int $index) :int
    {
        if ($index === 0) {
            throw new Exception('index 0 doesn\'t have parent.');
        }

        return ($index - 1) >> 1;
    }

    // 返回完全二叉树数组中，一个索引元素对应的左孩子元素的索引
    public function leftChild(int $index):int
    {
        return ($index << 1) + 1;
    }

    public function rightChild(int $index)
    {
        return ($index << 1) + 2;
    }

    public function add($e)
    {
        $this->data->addLast($e);
        $this->siftUp($this->data->getSize() - 1);
    }

    private function siftUp(int $k)
    {
        // 添加的元素比父亲节点元素大那么就要上浮
        while ($k > 0 && Utils::compareTo($this->data->get($this->parent($k)), $this->data->get($k)) < 0) {
            $this->data->swap($k, $this->parent($k));
            $k = $this->parent($k);
        }
    }

    // 看堆最大元素
    public function findMax()
    {
        if ($this->data->getSize() === 0) {
            throw new Exception('heap is empty');
        }

        return $this->data->get(0);
    }

    // 取出堆中最大的元素
    public function extractMax()
    {
        $ret = $this->findMax();
        $this->data->swap(0, $this->data->getSize() - 1);
        $this->data->removeLast();
        $this->siftDown(0);

        return $ret;
    }

    public function siftDown(int $k)
    {
        while ($this->leftChild($k) < $this->data->getSize()) {
            $j = $this->leftChild($k);
            if ($j + 1 < $this->data->getSize() && Utils::compareTo($this->data->get($j + 1), $this->data->get($j)) > 0) {
                $j++;
            }
            // $data[$j] 是leftChild 跟rightChild 中最大的值
            if (Utils::compareTo($this->data->get($k), $this->data->get($j)) >= 0) {
                break;
            }
            $this->data->swap($k, $j);
            $k = $j;
        }
    }

    // 取出堆中的最大元素，并且替换成元素e
    public function replace($e)
    {
        $ret = $this->findMax();
        $this->data->set(0, $e);
        $this->siftDown(0);

        return $ret;
    }
}
