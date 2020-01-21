<?php

class Arrays
{
    private SplFixedArray $data;
    private int $size;

    public function __construct()
    {
        $argv = func_get_args();
        switch (func_num_args()) {
            case 1:
                self::__construct1($argv[0]);
                break;
            case 2:
                self::__construct2($argv[0], $argv[1]);
                break;
            default:
                self::__construct0();
        }
    }

    private function __construct0()
    {
        $this->__construct1(10);
    }

    private function __construct1(int $capacity)
    {
        $this->data = new  SplFixedArray($capacity); // spl 的数组默认值为NULL
        $this->size = 0;
    }

    // 获取数组的容量
    public function getCapacity():int
    {
        return count($this->data);
    }

    public function getSize():int
    {
        return $this->size;
    }

    // 返回数组是否为空
    public function isEmpty():bool
    {
        return $this->size === 0;
    }

    // 向后添加
    public function addLast($e):void
    {
        $this->add($this->size, $e);
    }

    public function addFirst($e):void
    {
        $this->add(0, $e);
    }

    public function add(int $index, $e)
    {
        if ($this->size === count($this->data)) {
            throw new Exception('Add failed. Arrays is full.');
        }

        if ($index < 0 || $index > $this->size) {
            throw new Exception('Add failed. Illegal index.');
        }

        for ($i = $this->size - 1; $i >= $index; $i--) {
            $this->data[$i + 1] = $this->data[$i];
        }

        $this->data[$index] = $e;
        $this->size++;
    }

    public function get(int $index)
    {
        if ($index < 0 || $index > $this->size) {
            throw  new Exception('Get failed. Index is Illegal.');
        }

        return $this->data[$index];
    }

    // 修改指定索引的值
    public function set(int $index, $e)
    {
        if ($index < 0 || $index > $this->size) {
            throw  new Exception('Set failed. Index is Illegal.');
        }

        $this->data[$index] = $e;
    }

    // 查找数组中是否包含指定元素
    public function contains($e) :bool
    {
        for ($i = 0; $i < $this->size; $i++) {
            if ($this->data[$i] === $e) {
                return true;
            }
        }

        return false;
    }

    // 查找指定元素的 索引值，查不到 return -1
    public function find($e):int
    {
        for ($i = 0; $i < $this->size; $i++) {
            if ($this->data[$i] === $e) {
                return $i;
            }
        }

        return -1;
    }

    // 删除指定索引的元素
    public function remove(int $index)
    {
        if ($index < 0 || $index >= $this->size) {
            throw new Exception('Remove failed. Index is Illegal');
        }

        $result = $this->data[$index];
        for ($i = $index + 1; $i < $this->size; $i++) {
            $this->data[$i - 1] = $this->data[$i];
        }
        $this->size--;

        return $result;
    }

    public function removeFirst()
    {
        return $this->remove(0);
    }

    public function removeLast()
    {
        return $this->remove($this->size - 1);
    }

    public function removeElement($e):void
    {
        $index = $this->find($e);
        if ($index != -1) {
            $this->remove($index);
        }
    }


    public function __toString():string
    {
        $str = 'Array: size =' . $this->size . ', capactity = ' . count($this->data);
        $str .= '[';
        for ($i = 0; $i < $this->size; $i++) {
            $str .= $this->data[$i];
            if ($i != ($this->size - 1)) {
                $str .= ', ';
            }
        }

        return $str . ']';
    }
}
