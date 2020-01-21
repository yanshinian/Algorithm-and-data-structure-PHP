<?php

// Leetcode 211

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

class WordDictionary
{
    private Node $root;

    public function __construct()
    {
        $this->root = new Node();
    }

    // 向Trie 中添加一个新的单词word
    public function addWord(string $word):void
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

    public function search(string $word)
    {
        return $this->match($this->root, $word, 0);
    }

    private function match(Node $node, string $word, int $index):bool
    {
        $strLen = strlen($word);
        if ($index === $strLen) {
            return $node->isWord;
        }

        $c = $word[$index];
        if ($c !== '.') {
            if (!isset($node->next[$c])) {
                return false;
            }

            return $this->match($node->next[$c], $word, $index + 1);
        } else {
            foreach ($node->next as $value) {
                if ($this->match($value, $word, $index + 1)) {
                    return true;
                }
            }

            return false;
        }
    }
}
