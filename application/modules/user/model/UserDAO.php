<?php
namespace modules\user\model;

use core\classTables\Roles;
use core\classTables\Users;
use core\DataBase;
use \PDO;

class UserDAO
{
    public function getUserId(User $user)
    {
        $selUsers = new Users();
        $selObj = $selUsers->selectPrepare();
        //$result=$selObj->selectColumns(['id'])->where(['username='=>"$user->username",'and password='=>"$user->password"])->fetch(null);
        $result = $selObj->selectColumns(['id'])->where(['username=' => "?", 'and password=' => "?"])->fetch([$user->username, $user->password]);
        return $result;
    }

    public function insert(User $user)
    {
        echo "INSERT   " . $user->username . " " . $user->email;
        $insertUser = new Users();
        $insertUser->insert(['username' => $user->username, 'email' => $user->email, 'password' => $user->password,
            'date_of_birth' => $user->date_of_birth, 'avatar' => 'defaultUser.jpg']);
    }

    public function allUsers()
    {
        $selUsers = new Users();
        $selObj = $selUsers->selectPrepare();
        $result = $selObj->selectColumns(['username', 'password', 'date_of_birth', 'email'])->fetchAll(null);
        return $result;
    }


}