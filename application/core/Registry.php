<?php
namespace core;

class Registry
{
    private static $mass=array();
    public static function setValue($value, $key = '')
    {
        Registry::$mass[$key]=$value;
    }
    public static function getValue($key)
    {
        return Registry::$mass[$key];
    }
}
