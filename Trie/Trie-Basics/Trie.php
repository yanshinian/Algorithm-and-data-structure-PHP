<?php

class Node
{
    public bool $isWord;
    public array $next;

    public function __construct()
    {
        $argv = func_get_args();
        switch (func_num_args()) {
            case 1:
                self::__construct1($argv[0]);
                break;
            default:
                self::__construct0();
        }
    }

    public function __construct0()
    {
        $this->__construct1(false);
    }

    public function __construct1(bool $isWord)
    {
        $this->isWord = $isWord;
    }
}

class Trie
{
    private Node $root;
    private int $size;

    public function __construct()
    {
        $this->root = new Node();
        $this->size = 0;
    }

    // 获得Trie 中存储的单词数量
    public function getSize():int
    {
        return $this->size;
    }

    // 向Trie 中添加一个新的单词word
    public function add(string $word):void
    {
        $cur = $this->root;
        $strLen = strlen($word);
        for ($i = 0; $i < $strLen; $i++) {
            $c = $word[$i];
            if (!isset($cur->next[$c])) {
                $cur->next[$c] = new Node();
            }
            $cur = $cur->next[$c];
        }

        if (!$cur->isWord) {
            $cur->isWord = true;
            $this->size++;
        }
    }

    // 查询单词word是否在Tire中
    public function contains(string $word) :bool
    {
        $strLen = strlen($word);
        $cur = $this->root;
        for ($i = 0; $i < $strLen; $i++) {
            $c = $word[$i];
            if (!isset($cur->next[$c])) {
                return false;
            }
            $cur = $cur->next[$c];
        }

        return $cur->isWord;
    }

    // 查询是否在Trie 中有单词以 prefix 为前缀
    public function isPrefix(string $prefix)
    {
        $strLen = strlen($prefix);
        $cur = $this->root;
        for ($i = 0; $i < $strLen; $i++) {
            $c = $prefix[$i];
            if (!isset($cur->next[$c])) {
                return false;
            }
            $cur = $cur->next[$c];
        }

        return true;
    }
}
