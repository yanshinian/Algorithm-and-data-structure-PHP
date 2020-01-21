<?php

require_once 'ArrayStack.php';

$stack = new ArrayStack();

for ($i = 0; $i < 5; $i++) {
    $stack->push($i);
}

echo $stack . "\r\n";

$e = $stack->pop();

echo $e . "\r\n";

echo $stack;
