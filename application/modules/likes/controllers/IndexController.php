<?php
namespace modules\likes\controllers;

use core\Registry;
use core\Request;
use core\View;

use \Exception;
use modules\likes\model\likesModel;

class IndexController
{
    public function updateLikesAction()
    {
        if (!empty($_POST)) {
            $buttonName=$_POST['buttonName'];
            $id_meme=$_POST['buttonValue'];
            if ($buttonName=='like') {
                likesModel::updateLike($id_meme);
            } elseif ($buttonName=='dislike') {
                likesModel::updateDislike($id_meme);
            }
            $rating=likesModel::getLikesDislikes($id_meme);
            include $file=DIR_MOD."likes/views/ratingMemes.php";
        }
    }
}