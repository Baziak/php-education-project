<?php
namespace modules\main\model;

use core\classTables\Memes;
use core\classTables\Roles;
use core\classTables\Subscription;
use core\classTables\Users;

class DefaultModel
{
    public static function printDb()
    {
        $roles=new Roles();
        $sel=$roles->selectPrepare();
        $result=$sel->select(['*'])->fetchAll(null);
        echo "<br><pre>";
        var_dump($result);
    }
    public static function ptinSub()
    {
        $sub=new Subscription();
        $selObj=$sub->selectPrepare();
        $result=$selObj->selectColumns(['*'])->fetchAll(null);
        return $result;
    }
    public static function insertUsers()
    {
        $insertUser=new Users();
        $insertUser->insert(['login'=>'user@mail.ru', 'email'=>'user@mail.ru', 'password'=>'354546']);
    }
    public static function deleteUsers()
    {
        $deleteUser=new Users();
        //$deleteUser->delete('login=?',['user@mail.ru']);
        //$deleteUser->delete("login='name5'",null);
        $deleteUser->delete('login=? or id>?', ['name4', 2]);
    }
    public static function updateUsers()
    {
        $updateUser=new Users();
        $pass='likes/1';
        $updateUser->update(['login'=>'new@mail', 'password'=>"$pass"], 'id=?', [3]);
    }
    public static function selectUsers()
    {
        $selectUser=new Users();
        $selObj=$selectUser->selectPrepare(); //для создания объекта класса Select
        /* example 1 */
        //возвращает ассициативный массив, содержащий все строки:
        //3 записи с полями login и password, отсортированные по полю role
        //$resultRowSet=$selObj->limit(3,null)->order('role','ASC')->select(['login','password'])->fetchAll(null);
        //$resultRowSet=$selObj->selectColumns(['id', 'login', 'email'])->where(['id>'=>'0'])->fetchAll(null);
        /* example 2 */
        //возвращает 1 запись в виде массива: с полями login и password,
        //отсортированными по полю role
        /*$result=$selObj->order('role','ASC')->select(['login','password'])->fetch(null);
        print "<br>login: <b>".$result['login']
            ."</b><br>password: <b>".$result['password']."</b>";*/
        //echo "<br><pre>";
        //var_dump($resultRowSet);

        /* example 3 */
        //возвращает ассициативный массив, содержащий все строки:
        //с полями login,password и role, где id=1 или role=1
        //$resultRowSet=$selObj->where(['id='=>'1','or role='=>'1'])
        //->select(['login','password','role'])->fetchAll(null);

        //возвращает ассициативный массив, содержащий все строки:
        //с полямиlogin,password и role, где id>2 и login=name4 или role=2
        /*$selObj2=$selectUser->selectPrepare();
        $resultRowSet2=$selObj2->where(['id>'=>'2','and login='=>'?','or role='=>'?'])
            ->select(['login','password','role'])->fetchAll(['name4','2']);
        echo "<br><pre>";
        var_dump($resultRowSet2);*/

        /* example 4 joins */
        $resultRowSet2=$selObj->where(['roles.id '=>'IS NULL'])->Join('left', 'roles', 'role', 'id')
            ->selectColumns(['*'])->fetchAll(null);
        /*echo "<br><pre>";
        var_dump($resultRowSet2);*/
        return $resultRowSet2;
    }
    /* public static function selectRoles()
    {
        $selRoles=new Roles();
        $selObj=$selRoles->selectPrepare();
        $resultRowSet=$selObj->select(['*'])->fetchAll(null);
        echo "<br><pre>";
        var_dump($resultRowSet);
    }*/
    public static function login()
    {
        $email='bob@marley.com';
        $password='312';
        $selectUser=new Users();
        $selObj=$selectUser->selectPrepare();
        $user=$selObj->selectColumns(['id', 'username'])->where(['email='=>'? and ', 'password='=>'?'])
            ->fetch(["$email", "$password"]);
        return $user;
    }
    public static function test()
    {
       $selUsers=new Users();
        $selObj1=$selUsers->selectPrepare();
        $result=$selObj1->selectColumns(['username','avatar'])->distinct('1')->join('inner','memes','id','user_id')
            ->where(['year(memes.`date_create`)='=>'year(now()) and','week(memes.`date_create`)='=>'(week(now(),7)-1)'])
            ->order('likes','desc')->fetchAll(null);

        return $result;
    }
    public static function testUpdate()
    {
        $ins=new Memes();
        $ins->update(['dislikes'=>'dislikes+1'], 'id=?', ["2"]);
    }
    public static function testSelect()
    {
        $insertMemes=new Memes();
        $selObj2=$insertMemes->selectPrepare();
        $likes=$selObj2->selectColumns(['likes', 'dislikes'])->where(['id='=>'?'])->fetchAll(["2"]);
        return $likes;
    }
}
