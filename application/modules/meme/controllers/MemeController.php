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
        Registry::setValue('1', 'user');
        $meme = new models\MemeModel();
        $meme->createMeme($_POST['name'], $_POST['path'], $_POST['text']);
        //$meme->createMeme('собака', BASE_URL.'images/memes/base/orig/advice_dog.jpg', array('advice', 'dawg'));
        echo json_encode(['id' => $meme->getMemeId()]);
        die;
    }

    public function viewAction()
    {
        $module = Registry::getValue('module');
        $meme = new models\MemeModel();
        $path = $meme->getMemePath($_GET['id']);
        $v = new View($module, 'view.php');
        $v->assign('title', 'View');
        $v->assign('memePath', $path);

        try {
            $v->addIntoTemplate();
            $v->display();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}