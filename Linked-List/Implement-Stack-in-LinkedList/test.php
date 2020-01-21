<?php
require_once 'LinkedListStack.php';

$linkedListStack = new LinkedListStack();

for ($i = 0; $i < 10; $i++) {
    $linkedListStack->push($i);
}
echo $linkedListStack;
