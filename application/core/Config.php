<?php

namespace core;

class Config
{
    private static $config;
    private static $section;

    public static function getConfig()
    {
        if (!self::$config) {
            self::parseConfig();
        }

        return self::$config;
    }

    private static function parseConfig()
    {
        $ConfigFiles = glob(DIR_CORE . '*.ini');
        //$ConfigFiles = glob(DIR_CORE . 'config.ini');
        if (is_array($ConfigFiles)) {
            if (count($ConfigFiles) > 1) {
                for ($i = 0; $i < count($ConfigFiles); $i++) {
                    $ConfigArray[$i] = parse_ini_file($ConfigFiles[$i], true);
                }

                $NumberOfConfigFiles = count($ConfigArray);
                self::$config = $ConfigArray[0];
                for ($i = 1; $i < $NumberOfConfigFiles; $i++) {
                    self::$config = array_merge((array)self::$config, $ConfigArray[$i]);
                }

                return self::$config;
            } else {
                self::$config = parse_ini_file($ConfigFiles[0], true);
            }
        }
    }

    public static function getSection($section)
    {

        if (!self::$config) {
            self::parseConfig();
        }

        if (isset(self::$config[$section])) {
            return self::$config[$section];
        } else {
            return null;
        }

    }

    public static function getProperty($section, $property)
    {
        if (!self::$config) {
            self::parseConfig();
        }

        self::$section = self::getSection($section);
        if (isset(self::$section[$property])) {
            return self::$section[$property];
        } else {
            return null;
        }
    }
}
