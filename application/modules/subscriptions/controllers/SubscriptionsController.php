<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 12/12/13
 * Time: 10:44 AM
 */

namespace modules\subscriptions\controllers;

use core\Registry;
use core\View;
use \Exception;
use modules\subscriptions\model\SubscriptionsModel;

class SubscriptionsController
{
    /**/
    public function printSubscriptionsAction()
    {
        $module = Registry::getValue('module');
        $v = new View($module, 'listSubscriptions.php');
        $obj = new SubscriptionsModel($_SESSION['id']);
        $result = $obj->showSubscriptions();
        $v->assign('listSubscriptions', $result);
        try {
            $v->addIntoTemplate();
            $v->display();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function subscribeFromUserAction()
    {
        $module = Registry::getValue('module');
        $v = new View($module, 'listSubscriptions.php');
        $obj = new SubscriptionsModel($_SESSION['id']);
        $result = $obj->subscribeFromUser($_POST['targetId']);
        $v->assign('listSubscriptions', $result);
        try {
            $v->addIntoTemplate();
            $v->display();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function unsubscribeFromUserAction()
    {
        $module = Registry::getValue('module');
        $v = new View($module, 'listSubscriptions.php');
        $obj = new SubscriptionsModel($_SESSION['id']);
        $result = $obj->unsubscribeFromUser($_POST['targetId']);
        $v->assign('listSubscriptions', $result);
        try {
            $v->addIntoTemplate();
            $v->display();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


} 