<?php
require_once '../Priority-Queue/PriorityQueue.php';
require_once '../../Common/Comparable.php';
class Freq implements Comparable
{
    public int $e;
    public int $freq;

    public function __construct(int $e, int $freq)
    {
        $this->e = $e;
        $this->freq = $freq;
    }


    public function compareTo($another): int
    {
        if ($this->freq < $another->freq) {
            return 1;
        } elseif ($this->freq > $another->freq) {
            return -1;
        }

        return 0;
    }
}
class Solution
{
    public function topKFrequent(array $nums, int $k):array
    {
        $map = [];
        foreach ($nums as $num) {
            if (isset($map[$num])) {
                $map[$num]++;
            } else {
                $map[$num] = 1;
            }
        }
        $pq = new PriorityQueue();
        foreach ($map as $key => $value) {
            if ($pq->getSize() < $k) {
                $pq->enqueue(new Freq($key, $value));
            } elseif ($value > $pq->getFront()->freq) {
                $pq->dequeue();
                $pq->enqueue(new Freq($key, $value));
            }
        }
        $res = [];
        while (!$pq->isEmpty()) {
            $res[] = $pq->dequeue()->e;
        }

        return $res;
    }
}


$nums = [1, 1, 1, 2, 2, 3];
$k = 2;
$solution = new Solution();

$result = $solution->topKFrequent($nums, $k);

var_dump($result);
