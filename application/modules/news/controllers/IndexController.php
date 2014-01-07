<?php
/**
 * Created by PhpStorm.
 * User: anna
 * Date: 05.12.13
 * Time: 20:52
 */
namespace modules\news\controllers;

use core\Registry;
use core\Request;
use core\View;

use \Exception;
use modules\news\model\NewsModel;
use modules\subscriptions\controllers\SubscriptionsController;

class IndexController
{
    public function indexAction()
    {
        $module = Registry::getValue('module');
        $v = new View($module, 'memes.php');
        $v->assign('title', 'News');
        $startFrom = 0;
        $v->assign('memes', NewsModel::getMemes($startFrom));
        $v->assign('topUsers', NewsModel::topUsers());
        $v->assign('userRating', NewsModel::userRating());
        $request = new Request();
        $action = $request->getAction();
        $v->assign('action', $action);
        try {
            $v->addIntoTemplate();
            $v->display();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function memesAction()
    {
        $module = Registry::getValue('module');
        $userRating = NewsModel::userRating();
        if (isset($_POST['startFrom'])) {
            $startFrom = $_POST['startFrom'];
        } else {
            die();
        }
        if (isset($_POST['action'])) {
            $act = $_POST['action'];
        }
        if ($act == 'index') {
            $memes = NewsModel::getMemes($startFrom);
        } elseif ($act == 'rating'){
            $memes = NewsModel::getMemesByRating($startFrom);
        }
        else {
            $memes = NewsModel::userSubs($startFrom);
        }
        //echo "<br start from=>".$startFrom;
        include $file = DIR_MOD . $module . "/views/printMemes.php";
    }

    public function ratingAction()
    {
        $startFrom = 0;
        $module = Registry::getValue('module');
        $v = new View($module, 'memes.php');
        $v->assign('topUsers', NewsModel::topUsers());
        $v->assign('userRating', NewsModel::userRating());
        $request = new Request();
        $action = $request->getAction();
        $v->assign('action', $action);
        $v->assign('title', 'News');
        $v->assign('memes', NewsModel::getMemesByRating($startFrom));
        try {
            $v->addIntoTemplate();
            $v->display();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function subsAction()
    {
        $startFrom = 0;
        $module = Registry::getValue('module');
        $v = new View($module, 'memes.php');
        $v->assign('title', 'News');
        $v->assign('topUsers', NewsModel::topUsers());
        $v->assign('userRating', NewsModel::userRating());
        $request = new Request();
        $action = $request->getAction();
        $v->assign('action', $action);
        $v->assign('memes',NewsModel::userSubs($startFrom));
        try {
            $v->addIntoTemplate();
            $v->display();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    /*public function updateLikesAction()
    {
        $module=Registry::getValue('module');
        if (!empty($_POST)) {
            $buttonName=$_POST['buttonName'];
            $id_meme=$_POST['buttonValue'];
            if ($buttonName=='like') {
                NewsModel::updateLike($id_meme);
            } elseif ($buttonName=='dislike') {
                NewsModel::updateDislike($id_meme);
            }
            $rating=NewsModel::getLikesDislikes($id_meme);
            include $file=DIR_MOD.$module."/views/ratingMemes.php";
        }

    }*/
}
