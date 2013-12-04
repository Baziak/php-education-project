<?php

define('DIR', str_replace('\\','/',dirname(__DIR__)));
define('DIR_PUBLIC',DIR.'/public/');
define('DIR_CORE', DIR.'/application/core/');
define('DIR_APP', DIR.'/application/');
define('DIR_MOD', DIR.'/application/modules/');
define('DIR_TABLES',DIR_CORE.'classTables/');
function __autoload($file){
    $file = str_replace('\\', '/', $file);
    $file = DIR_APP . $file . '.php';
    require_once($file);
}

