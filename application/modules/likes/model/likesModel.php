<?php
namespace modules\likes\model;

use core\classTables\Ratings;
use core\classTables\Roles;
use core\classTables\Memes;
use core\classTables\Users;

class likesModel
{
    public static function updateLike($meme_id)
    {
        $insertMemes=new Memes();
        $ratings=new Ratings();
        if (!empty($_SESSION['id'])) {
        $userID=$_SESSION['id'];
        }
        $selObj=$ratings->selectPrepare();
        $getRating=$selObj->selectColumns(['rating'])->where(['user_id='=>'?', ' and memes_id='=>'?'])
            ->fetch([$userID, $meme_id]);
        if ($getRating==null /*&& !(empty($userID))*/) {
            $ratings->insert(['memes_id'=>"$meme_id", 'user_id'=>"$userID", 'rating'=>'1']);
            $insertMemes->update(['likes'=>'likes+1'], 'id=?', ["$meme_id"]);
        }

    }
    public static function updateDislike($meme_id)
    {
        $ratings=new Ratings();
        $insertMemes=new Memes();
        if (!empty($_SESSION['id'])) {
        $userID=$_SESSION['id'];
        $selObj=$ratings->selectPrepare();
        $getRating=$selObj->selectColumns(['rating'])->where(['user_id='=>'?', ' and memes_id='=>'?'])
            ->fetch([$userID, $meme_id]);
        if ($getRating==null && $getRating!='1' /*&& !(empty($userID))*/) {
            $ratings->insert(['memes_id'=>"$meme_id", 'user_id'=>"$userID", 'rating'=>'0']);
            //debug_print_backtrace();
            $insertMemes->update(['dislikes'=>'dislikes+1'], 'id=?', ["$meme_id"]);
        }
        }
    }
    public static function getLikesDislikes($meme_id)
    {
        $insertMemes=new Memes();
        $selObj2=$insertMemes->selectPrepare();
        $likes=$selObj2->selectColumns(['likes', 'dislikes'])->where(['id='=>'?'])->fetchAll([$meme_id]);
        return $likes;
    }
}