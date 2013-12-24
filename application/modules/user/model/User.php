<?php

namespace modules\user\model;

use core\classTables\Users;
use core\classTables\Memes;
use core\classTables\Subscription;
use core\Config;
use \Imagick;

class User
{
    public $id;
    public $sub_id;
    public $username;
    public $email;
    public $password;
    public $date_of_birth;
    public $role;
    public $avatar;
    public $paths_to_my_memes;
    public $user_error = null;
    public $targetId;

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function profile($user_id)
    {
        $this->id = $user_id;
        $selectUser = new Users();
        $select_User_Object = $selectUser->selectPrepare();
        $user = $select_User_Object->where(['id=' => "$this->id"])
            ->selectColumns(['username, email, date_of_birth, role, avatar'])->fetchAll();
        $this->username = $user[0]['username'];
        $this->email = $user[0]['email'];
        $this->date_of_birth = $user[0]['date_of_birth'];
        $this->role = $user[0]['role'];
        $this->avatar = $user[0]['avatar'];
        $selectMemes = new Memes();
        $select_Memes_Object = $selectMemes->selectPrepare();
        $this->paths_to_my_memes = $select_Memes_Object->where(['user_id=' => "$this->id"])
            ->selectColumns(['*'])->order('id', 'DESC')->fetchAll();
    }

    public function changeProfile($ChangeData, $UserId)
    {
        if (!empty($ChangeData['name'])) {
            $UpdateUser = new Users();
            $UpdateUser->update(['username' => $ChangeData['name']], 'id=?', [$UserId]);
        }

        if (!empty($ChangeData['password']) && !empty($ChangeData['password-repeat'])) {
            if ($password = $ChangeData['password'] == $password_repeat = $ChangeData['password-repeat']) {
                if (preg_match('/((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,})/', $password)) {
                    /*$password = md5($password);*/
                    $UpdateUser = new Users();
                    $UpdateUser->update(['password' => $password], 'id=?', [$UserId]);
                } else {
                    $this->user_error['password'] = 'Пароль не соответствует условию!';
                }

            } else {
                $this->user_error['password'] = 'Неверный пароль, повторите ввод!';
            }
        }

        if (!empty($_FILES['userfile']['size'])) {
            if ($_FILES['userfile']['size'] <= 200000) {
                $tmp_path = $_FILES['userfile']['tmp_name'];
                $avatar = new Imagick($tmp_path);
                $avatar->thumbnailimage(Config::getProperty('avatar', 'width'), 0, false) or die('error in resizing');
                $UploadDir = DIR_PUBLIC . 'images/user_avatars/';
                $UploadFile = $UploadDir . basename($_FILES['userfile']['name']);
                $avatar->writeimage($UploadFile) or die('error in writing image');
                rename($UploadFile, $UploadDir . $UserId . '_user.jpg') or die('error in renaming');
                $this->avatar = $UploadDir . $UserId . '_user.jpg';
                $UpdateUserAvatar = new Users();
                $UpdateUserAvatar->update(['avatar' => $UserId.'_user.jpg'], 'id=?', [$UserId]);
            } else {
                $this->user_error['avatar'] = 'Слишком большой размер картинки!';
            }
        }
    }

    function isSubscribed($targetId)
    {
        $this->sub_id = $_SESSION['id'];
        $this->targetId = $targetId;
        $selectSubscriptions = new Subscription();
        $selObjSubscriptions = $selectSubscriptions->selectPrepare();
        $subExist = $selObjSubscriptions->where(['target_id=' => "$this->targetId", ' and user_id=' => "$this->sub_id",])->selectColumns(['status'])->fetch(null);
        if (!empty($subExist)) {
            return (bool)$subExist['status'];
        }
        return false;
    }
}
