<?php
namespace modules\main\model;

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
        $resultRowSet=$selObj->selectColumns(['id', 'login', 'email'])->where(['id>'=>'0'])->fetchAll(null);
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
        /*$resultRowSet2=$selObj->where(['roles.id '=>'IS NULL'])->Join('left', 'roles', 'role', 'id')
            ->select(['*'])->fetchAll(null);
        echo "<br><pre>";
        var_dump($resultRowSet2);*/
        return $resultRowSet;
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
        $email='name1@mail';
        $password='12345';
        $selectUser=new Users();
        $selObj=$selectUser->selectPrepare();
        $user=$selObj->selectColumns(['id','username'])->where(['email='=>'? and ','password='=>'?'])
            ->fetch(["$email","$password"]);
        return $user;
    }
}
