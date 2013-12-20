<?php
namespace modules\main\controllers;

use core\Registry;
use core\View;
use \Exception;
use modules\main\model\DefaultModel;

class IndexController
{
    public function indexAction()
    {
        $module=Registry::getValue('module');
        $v = new View($module, 'home.php');
        $v->assign('title', 'Home page');
        $v->assign('users', DefaultModel::test());
        //$v->assign('sub',DefaultModel::ptinSub());
        //DefaultModel::updateUsers();
        //DefaultModel::testSelect();
        try {
            $v->addIntoTemplate();
            $v->display();
            //DefaultModel::printDb();

            //DefaultModel::deleteUsers();
            //DefaultModel::updateUsers();
            //DefaultModel::selectUsers();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function loginAction()
    {
        $module=Registry::getValue('module');
        $v = new View($module, 'login.php');
        $v->assign('title', 'Log In');
        $user=DefaultModel::login();
        if ($user!=null) {
            $_SESSION['userID']=$user['id'];
        } else {
            //header("Location:".BASE_URL."user/user/registration");
        }
        $v->assign('userLogIn', DefaultModel::login());
        try {
            $v->addIntoTemplate();
            $v->display();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
