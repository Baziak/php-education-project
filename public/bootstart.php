<?php
use core\Registry as Registry;

session_start();
define('DIR', str_replace('\\', '/', dirname(__DIR__)));
define('DIR_PUBLIC', DIR . '/public/');
define('DIR_CORE', DIR . '/application/core/');
define('DIR_APP', DIR . '/application/');
define('DIR_MOD', DIR . '/application/modules/');
define('DIR_TABLES', DIR_CORE . 'classTables/');
define('BASE_URL', "http://" . $_SERVER['SERVER_NAME']
    . str_replace($_SERVER['DOCUMENT_ROOT'], '', DIR_PUBLIC));
define('HTTP_URL_PUB', "http://" . $_SERVER['SERVER_NAME']
    . str_replace($_SERVER['DOCUMENT_ROOT'], '', DIR_PUBLIC));
define('DIR_TEMP_USERS', DIR . '/temp/users/user_id/');

define('DIR_USERS', "\"http://" . $_SERVER['SERVER_NAME']
    . str_replace($_SERVER['DOCUMENT_ROOT'], '', DIR_TEMP_USERS));
define('ROOT', str_replace('\\', '/', dirname(__DIR__)));
function __autoload($file)
{
    $file = str_replace('\\', '/', $file);
    $file = DIR_APP . $file . '.php';
    require_once($file);
}

/**
 * Проверить настроен ли в VirtualHost DOCUMENT_ROOT
 */
function isConfiguredDocRoot()
{
    $arr = explode('/', ROOT);
    if (is_array($arr) && $arr !== null) {
        Registry::setValue(array_pop($arr) . '/public', 'rootDirName');
    }
    $match = strstr($_SERVER['DOCUMENT_ROOT'], Registry::getValue('rootDirName'));
    if ($match) {
        return true;
    } else {
        echo $match;
        return false;
    }
}

