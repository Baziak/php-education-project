<?php
namespace modules\user\model;

use core\classTables\Users;

class User
{
    public $id;
    public $login;
    public $email;
    public $date_of_birth;
    public $role;
    public $avatar;

    public function profile($user_id)
    {
        $this->id = $user_id;
        /*$selectUser = new Users();
        $select_Object = $selectUser->selectPrepare();
        $this->login = $select_Object->where(['id='=>"$this->id"])->selectColumns(['login']);
        $this->email = $select_Object->where(['id=' => "$this->id"]) -> selectColumns(['email']);*/
    }
}
