<?php
namespace modules\meme\controllers;

use core\Registry;
use core\View;
use \Exception;
use modules\meme\models;

class MemeController
{
    public function createAction()
    {
        $pictures = new models\MemeModel();
        $pictures->getBasePictures();
        $picOutput = $pictures->pictures;
        $inpOutput = $pictures->inputs;


        $module = Registry::getValue('module');
        $v = new View($module, 'create.php');
        $v->assign('title', 'Create new meme');
        $v->assign('images', $picOutput);
        $v->assign('inputs', $inpOutput);

        try {
            $v->addIntoTemplate();
            $v->display();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function generateAction()
    {
        $meme = new models\MemeModel();
        $meme->createMeme($_POST['name'], $_POST['id'], $_POST['text']);
        echo json_encode(['id' => $meme->getMemeId()]);
    }

    public function viewAction()
    {
        $module = Registry::getValue('module');
        $meme = new models\MemeModel();
        $memeInfo = $meme->getMemePath($_GET['id']);
        $comments = $meme->getComments($_GET['id']);
        $v = new View($module, 'view.php');
        $v->assign('title', 'View');
        $v->assign('meme', $memeInfo);
        $v->assign('comments', $comments);

        try {
            $v->addIntoTemplate();
            $v->display();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getImageAction()
    {
        $img = new models\MemeModel();
        echo json_encode($img->getImage($_POST['id']));
    }

    public function addCommentAction()
    {
        $comment = new models\MemeModel();
        $comment->addComment($_SESSION['id'], $_POST['comment'], $_POST['meme_id']);
    }
}