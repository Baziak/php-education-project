<?php
namespace modules\main\controllers;

use core\Registry;
use core\View;
use \Exception;

class IndexController
{
    public function indexAction()
    {
        $module=Registry::getValue('module');
        $v = new View($module, 'home.php');
        $v->assign('title', 'Home page');

        try {
            $v->addIntoTemplate();
            $v->display();
            //DefaultModel::printDb();
            //DefaultModel::insertUsers();
            //DefaultModel::deleteUsers();
            //DefaultModel::updateUsers();
            DefaultModel::selectUsers();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}