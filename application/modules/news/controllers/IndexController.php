<?php
/**
 * Created by PhpStorm.
 * User: anna
 * Date: 05.12.13
 * Time: 20:52
 */
namespace modules\news\controllers;

use core\Registry;
use core\View;

use \Exception;
use modules\news\model\NewsModel;

class IndexController
{
    public function indexAction()
    {
        $module=Registry::getValue('module');
        $v = new View($module, 'memes.php');
        $v->assign('title', 'News');
        if (!empty($_GET)) {
            $page=(int)$_GET['page'];
        } else {
            $page=1;
        }
        $v->assign('memes', NewsModel::getMemes($page));
        $v->assign('countPages', NewsModel::getCountPages());
        try {
            $v->addIntoTemplate();
            $v->display();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function likeAction()
    {
        if (!empty($_POST)) {
            $id_meme=$_POST['like'];
            NewsModel::updateLike($id_meme);
            header("Location:".HTTP_URL_PUB."news/index/index");
        }
    }
    public function dislikeAction()
    {
        if (!empty($_POST)) {
            $id_meme=$_POST['dislike'];
            NewsModel::updateDislike($id_meme);
            header("Location:".HTTP_URL_PUB."news/index/index");
        }
    }
    public function paginationAction()
    {
        if (!empty($_GET)) {
            $pagesNumber=(int)$_GET['page'];
            var_dump($pagesNumber);
        }
    }
}
