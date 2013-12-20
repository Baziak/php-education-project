<?php
namespace modules\user\model;

use core\classTables\Users;
use core\classTables\Memes;
use \Imagick;

class User
{
    public $id;
    public $username;
    public $email;
    public $password;
    public $date_of_birth;
    public $role;
    public $avatar;
    public $paths_to_my_memes;
    public $error = null;

    public function __set($name,$value){
        $this->$name=$value;
    }

    public function profile($user_id)
    {
        $this->id = $user_id;
        $selectUser = new Users();
        $select_User_Object = $selectUser->selectPrepare();
        $user = $select_User_Object->where(['id='=>"$this->id"])
            ->selectColumns(['username, email, date_of_birth, role, avatar'])->fetchAll();
        $this->username = $user[0]['username'];
        $this->email = $user[0]['email'];
        $this->date_of_birth = $user[0]['date_of_birth'];
        $this->role = $user[0]['role'];
        $this->avatar = $user[0]['avatar'];
        $selectMemes = new Memes();
        $select_Memes_Object = $selectMemes->selectPrepare();
        $this->paths_to_my_memes = $select_Memes_Object->where(['user_id='=>"$this->id"])
            ->selectColumns(['*'])->fetchAll();
    }

    public function changeProfile($ChangeData, $UserId)
    {
        if (!empty($ChangeData['name'])) {
            $UpdateUser = new Users();
            $UpdateUser->update(['username'=>$ChangeData['name']], 'id=?', [$UserId]);
        }

        if (!empty($ChangeData['password']) && !empty($ChangeData['password-repeat'])) {
            if ($password = $ChangeData['password'] == $password_repeat = $ChangeData['password-repeat']) {
                if(preg_match('/((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,})/', $password))
                {
                    $password = md5($password);
                    $UpdateUser = new Users();
                    $UpdateUser->update(['password'=>$password], 'id=?', [$UserId]);
                } else
                {
                    $this->error = 'Пароль не соответствует условию!';
                }

            } else
            {
                $this->error = 'Неверный пароль, повторите ввод!';
            }
        } else
        {
            $this->error = 'Нужно повторить введенный пароль! Введите пароли снова.';
        }

        if (!empty($_FILES['userfile']['size'])) {
            $UploadDir = DIR_PUBLIC.'images/user_avatars/';
            $UploadFile = $UploadDir . basename($_FILES['userfile']['name']);
            move_uploaded_file($_FILES['userfile']['tmp_name'], $UploadFile);
            rename($UploadFile, $UploadDir.$UserId.'_user.jpg');
            $this->avatar = $UploadDir.$UserId.'_user.jpg';
        }
    }
}
