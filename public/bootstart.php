<?php

define('DIR', str_replace('\\','/',dirname(__DIR__)));
define('DIR_PUBLIC',DIR.'/public/');
define('DIR_CORE', DIR.'/application/core/');
define('DIR_APP', DIR.'/application/');
define('DIR_MOD', DIR.'/application/modules/');
define('DIR_TABLES',DIR_CORE.'classTables/');
define('HTTP_URL_PUB', "http://".$_SERVER['SERVER_NAME']
        .str_replace($_SERVER['DOCUMENT_ROOT'],'',DIR_PUBLIC));
define('DIR_TEMP_USERS',DIR.'/temp/users/user_id/');
define('DIR_USERS',"\"http://".$_SERVER['SERVER_NAME']
    .str_replace($_SERVER['DOCUMENT_ROOT'],'',DIR_TEMP_USERS));
function __autoload($file){
    $file = str_replace('\\', '/', $file);
    $file = DIR_APP . $file . '.php';
        require_once($file);
}

