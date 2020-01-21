<?php

interface UF
{
    public function getSize() :int;
    public function isConnected(int $p, int $q);
    public function unionElements(int $p, int $q);
}
