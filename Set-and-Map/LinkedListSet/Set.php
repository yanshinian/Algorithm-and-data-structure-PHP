<?php

interface Set
{
    public function add($e) :void;
    public function contains($e) :bool;
    public function remove($e) :void;
    public function getSize():int;
    public function isEmpty():bool ;
}
