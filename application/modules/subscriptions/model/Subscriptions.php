<?php
namespace modules\subscriptions\model;

use core\classTables\Users;
use core\classTables\Subscriptions;


class Subscriptions
{
    public $userId;
    public $userName;
    public $avatar;
    public $targetId;
    public $status;

    // user_id, target_id, status, username, avatar
    public function __constructor($userId)
    {
        $this->userId = $userId;
    }

    public function showSubscriptions()
    {
        $selectSubscriptions = new Subscriptions();
        $selObjSubscriptions = $selectSubscriptions->selectPrepare();
        $this->targetId = $selObjSubscriptions->where(['user_id=' => "$this->userId", 'and status=' => '1'])
            ->selectColumns(['target_id'])->fetch(null);

        $selectUser = new Users();
        $selObjUser = $selectUser->selectPrepare();
        $this->userName = $selObjUser->where(['id=' => "$this->targetId"])->selectColumns(['userName'])->fetch(null);
        $this->avatar = $selObjUser->where(['id=' => "$this->targetId"])->selectColumns(['avatar'])->fetch(null);
    }
}
