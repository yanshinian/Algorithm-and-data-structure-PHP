<?php

declare(strict_types=1);
class Node
{
    public $e;
    public ?Node $left;
    public ?Node $right;
    public function __construct($e)
    {
        $this->e = $e;
        $this->left = null;
        $this->right = null;
    }
}
