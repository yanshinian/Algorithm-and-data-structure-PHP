<?php

interface Map
{
    public function add($key, $value);
    public function remove($key);
    public function contains($key):bool;
    public function get($key);
    public function set($key, $newValue);
    public function getSize():int;
    public function isEmpty():bool;
}
