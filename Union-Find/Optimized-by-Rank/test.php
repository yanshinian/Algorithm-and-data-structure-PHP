<?php

require_once 'UnionFind4.php';
require_once '../Optimized-by-Size/UnionFind2.php';
require_once '../Optimized-by-Size/UnionFind3.php';

function testUF(UF $uf, int $m)
{
    $startTime = microtime(true);
    $size = $uf->getSize();
    for ($i = 0; $i < $m; $i++) {
        $a = random_int(0, $size - 1);
        $b = random_int(0, $size - 1);
        $uf->unionElements($a, $b);
    }

    for ($i = 0; $i < $m; $i++) {
        $a = random_int(0, $size - 1);
        $b = random_int(0, $size - 1);
        $uf->isConnected($a, $b);
    }

    $endTime = microtime(true);

    return $endTime - $startTime;
}

$size = 30000;
$m = 30000;



$uf2 = new UnionFind2($size);

echo 'UnionFind2：' . testUF($uf2, $m) . " s \r\n";

$uf3 = new UnionFind3($size);

echo 'UnionFind3：' . testUF($uf3, $m) . " s \r\n";

$uf4 = new UnionFind4($size);

echo 'UnionFind4：' . testUF($uf4, $m) . " s \r\n";
