<?php
/**
 * Created by PhpStorm.
 * User: anna
 * Date: 05.12.13
 * Time: 19:08
 */
namespace modules\news\model;

use core\classTables\Ratings;
use core\classTables\Roles;
use core\classTables\Memes;
use core\classTables\Users;
use modules\user\model\User;

class NewsModel
{
    static private $memesOnPage;
    public static function getMemes($startFrom)
    {
        $selectMemes=new Memes();
        $selObj=$selectMemes->selectPrepare();
        $result=$selObj
            ->selectColumns(['username', 'name', 'path', 'likes', 'dislikes', 'memes.date_create', 'memes.id'])
            ->from(['users'])->where(['memes.user_id='=>'users.id'])->order('memes.date_create', 'DESC')
            ->limit($startFrom, 5)->fetchAll(null);
        return $result;
    }
    public static function getMemesByRating($startFrom)
    {
        $selectMemes=new Memes();
        $selObj=$selectMemes->selectPrepare();
        $result=$selObj
            ->selectColumns(['username', 'name', 'path', 'likes', 'dislikes', 'memes.date_create', 'memes.id'])
            ->from(['users'])->where(['memes.user_id='=>'users.id'])->order('likes', 'DESC')
            ->limit($startFrom, 5)->fetchAll(null);
        return $result;
    }

    public static function userRating()
    {
        $ratings=new Ratings();
        if (!empty($_SESSION['userID'])) {
            $userID=$_SESSION['userID'];
            $selObj=$ratings->selectPrepare();
            $getRating=$selObj->selectColumns(['memes_id'])->where(['user_id='=>'?'])
                ->fetchAll([$userID]);
            return $getRating;
        }
        else return;
        /*$selObj=$ratings->selectPrepare();
        $getRating=$selObj->selectColumns(['memes_id'])->where(['user_id='=>'?'])
            ->fetchAll([$userID]);
        return $getRating;*/
    }
    /*public static function updateLike($meme_id)
    {
        $insertMemes=new Memes();
        $ratings=new Ratings();
        $userID=$_SESSION['userID'];
        $selObj=$ratings->selectPrepare();
        $getRating=$selObj->selectColumns(['rating'])->where(['user_id='=>'? and ', 'memes_id='=>'?'])
            ->fetch([$userID, $meme_id]);
        if ($getRating==null && !(empty($userID))) {
            $ratings->insert(['memes_id'=>"$meme_id", 'user_id'=>"$userID", 'rating'=>'1']);
            $insertMemes->update(['likes'=>'likes+1'], 'id=?', ["$meme_id"]);
        }
    }
    public static function updateDislike($meme_id)
    {
        $ratings=new Ratings();
        $insertMemes=new Memes();
        $userID=$_SESSION['userID'];
        $selObj=$ratings->selectPrepare();
        $getRating=$selObj->selectColumns(['rating'])->where(['user_id='=>'? and ', 'memes_id='=>'?'])
            ->fetch([$userID, $meme_id]);
        if ($getRating==null && !(empty($userID))) {
            $ratings->insert(['memes_id'=>"$meme_id", 'user_id'=>"$userID", 'rating'=>'0']);
            $insertMemes->update(['dislikes'=>'dislikes+1'], 'id=?', ["$meme_id"]);
        }
    }
    public static function getLikesDislikes($meme_id)
    {
        $insertMemes=new Memes();
        $selObj2=$insertMemes->selectPrepare();
        $likes=$selObj2->selectColumns(['likes', 'dislikes'])->where(['id='=>'?'])->fetchAll([$meme_id]);
        return $likes;
    }*/
    public static function topUsers()
    {
        $selUsers=new Users();
        $selObj1=$selUsers->selectPrepare();
        $users=$selObj1->selectColumns(['username', 'avatar'])->distinct('1')->join('inner', 'memes', 'id', 'user_id')
            ->where(['year(memes.`date_create`)='=>'year(now()) and',
                'week(memes.`date_create`)='=>'(week(now(),7)-1)'])
            ->order('likes', 'desc')->fetchAll(null);
        return $users;
    }
}
