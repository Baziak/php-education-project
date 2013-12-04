<?php
namespace modules\user\controllers;

use core\Registry;
use core\View;
use \Exception;

class UserController
{
    public function registrationAction()
    {
        $module=Registry::getValue('module');
        $v = new View($module,'registration.php');
        $v->assign('title','New user');

        try{
            $v->addIntoTemplate();
            $v->display();
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
}