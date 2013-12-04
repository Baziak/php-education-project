<?php
ini_set('display_errors',1);
require_once 'bootstart.php';

use core\Request;
use core\FrontController;

try
{
    $req=new Request();
    FrontController::getInstance()->dispatch($req);

}
catch (Exception $e)
{
    die($e->getMessage());
}
