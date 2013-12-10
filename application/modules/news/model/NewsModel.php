<?php
/**
 * Created by PhpStorm.
 * User: anna
 * Date: 05.12.13
 * Time: 19:08
 */
namespace modules\news\model;

use core\classTables\Roles;
use core\classTables\Memes;
use core\classTables\Users;
use modules\user\model\User;

class NewsModel
{
    static private $memesOnPage;
    public static function displayMemes()
    {
        $selectMemes=new Memes();
        $selObj=$selectMemes->selectPrepare();
        /*$column=count($selObj->selectColumns(['name','path','likes','date_create','dislikes'])
            ->fetchAll(null));*/
        $result=$selObj->selectColumns(['name', 'path', 'likes', 'date_create', 'dislikes'])
            ->fetchAll(null);
        $rows=count($result);
        //var_dump($result);
        /*$result=array();
        for ($i=0;$i<$column;$i++){
            $result[$i]=$selObj->selectColumns(['path'])->fetch(null);
        }*/
        return $result;
    }
    public static function getMemes($page = null)
    {
        self::$memesOnPage=3;
        if ($page == null) {
            $begin=0;
            $end=self::$memesOnPage;
        } else {
            $end=self::$memesOnPage*$page;
            $begin=$end-self::$memesOnPage;
        }
        $selectMemes=new Memes();
        $selObj=$selectMemes->selectPrepare();
        //$result=$selObj->selectColumns(['*'])->fetchAll(null);
        $result=$selObj->selectColumns(['username', 'name', 'path', 'likes', 'dislikes', 'memes.date_create', 'memes.id'])
            ->from(['users'])->where(['memes.user_id='=>'users.id'])->order('memes.date_create', 'DESC')
            ->limit($begin, $end)->fetchAll(null);
        return $result;
    }
    public static function updateLike($meme_id)
    {
        $insertMemes=new Memes();
        $insertMemes->update(['likes'=>'likes+1'], 'id=?', ["$meme_id"]);
    }
    public static function updateDislike($meme_id)
    {
        $insertMemes=new Memes();
        $insertMemes->update(['dislikes'=>'dislikes+1'], 'id=?', ["$meme_id"]);
    }
    public static function getCountPages()
    {
        $selectMemes=new Memes();
        $selObj=$selectMemes->selectPrepare();
        //$result=$selObj->selectColumns(['*'])->fetchAll(null);
        $countPages=
            $selObj->selectColumns(['username', 'name', 'path', 'likes', 'dislikes', 'memes.date_create', 'memes.id'])
            ->from(['users'])->where(['memes.user_id='=>'users.id'])
            ->order('memes.date_create', 'DESC')->fetchAll(null);
        $countPages=ceil(count($countPages)/self::$memesOnPage);
        return $countPages;
    }
    public static function limitPages($page)
    {
        $memesOnPage=3;
        $end=$memesOnPage*$page;
        $begin=$end-$memesOnPage+1;
        echo "begin=".$begin."<br>end=".$end;
        /*self::$page=$begin.",".$end;
        return self::$page;*/
    }
}
