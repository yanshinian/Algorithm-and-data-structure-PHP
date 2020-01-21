<?php

require_once '../../Common/Comparable.php';

class Utils
{
    public static function compareTo($a, $b) :int
    {
        if (is_int($a) && is_int($b)) {
            if ($a>$b) {
                return 1;
            } elseif ($a === $b) {
                return 0;
            } else {
                return -1;
            }
        } elseif (is_float($a) && is_float($b)) {
            if ($a>$b) {
                return 1;
            } elseif ($a === $b) {
                return 0;
            } else {
                return -1;
            }
        } elseif (is_string($a) && is_string($b)) {
            return strcmp($a, $b);
        } elseif ($a instanceof Comparable && $b instanceof Comparable) {
            return $a->compareTo($b);
        }
        throw new Exception('type error');
    }
}
