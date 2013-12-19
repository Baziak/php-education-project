<?php
namespace core;

class Registry
{
    private static $reg=array();
    public static function setValue($value, $key)
    {
        Registry::$reg[$key]=$value;
    }
    public static function getValue($key)
    {
        return Registry::$reg[$key];
    }
}
