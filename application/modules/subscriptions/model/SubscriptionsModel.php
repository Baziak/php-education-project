<?php
namespace modules\subscriptions\model;

use core\classTables\Roles;
use core\classTables\Subscription;
use core\classTables\Users;

class SubscriptionsModel
{
    public $userId;
    public $dataSubscriptions;
    public $targetId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function showSubscriptions()
    {
        $selectSubscriptions = new Subscription();
        $selObjSubscriptions = $selectSubscriptions->selectPrepare();

        $result = $selObjSubscriptions->where(['user_id=' => "$this->userId", ' and status=' => '1'])
            ->selectColumns(['target_id'])->fetchAll(null);
        for ($i = 0; $i < count($result); $i++) {
            $this->targetId = $result[$i]['target_id'];
            $selectUser = new Users();
            $selObjUser = $selectUser->selectPrepare();
            $this->dataSubscriptions[$i] = $selObjUser->where(['id=' => $this->targetId])->selectColumns(['id', 'username', 'avatar', 'date_update'])->fetchAll(null);
        }
        return $this->dataSubscriptions;
    }

    public function unsubscribeFromUser($targetId)
    {
        $this->targetId = $targetId;
        $updateSubscriptions = new Subscription();
        $updateSubscriptions->update(['status' => '0'], 'target_id=? and user_id=?', [$this->targetId, $this->userId]);
    }

    public function subscribeFromUser($targetId)
    {
        $this->targetId = $targetId;
        $selectSubscriptions = new Subscription();
        $selObjSubscriptions = $selectSubscriptions->selectPrepare();
        $subExist = $selObjSubscriptions->where(['target_id=' => "$this->targetId", ' and user_id=' => "$this->userId",])->selectColumns(['status'])->fetch(null);
        if (empty($subExist)) {
            $insertSubscriptions = new Subscription();
            $insertSubscriptions->insert(
                ['user_id' => "$this->userId", 'target_id' => "$this->targetId", 'status' => "1", 'date_create' => "null", 'date_update' => "null"]
            );
        } elseif ($subExist['status'] == 0) {
            $updateSubscriptions = new Subscription();
            $updateSubscriptions->update(['status' => '1'], 'target_id=? and user_id=?', [$this->targetId, $this->userId]);
        }
    }

    function isSubscribed($targetId)
    {
        $this->targetId = $targetId;
        $selectSubscriptions = new Subscription();
        $selObjSubscriptions = $selectSubscriptions->selectPrepare();
        $subExist = $selObjSubscriptions->where(['target_id=' => "$this->targetId", ' and user_id=' => "$this->userId",])->selectColumns(['status'])->fetch(null);
        if (!empty($subExist)) {
            return (bool)$subExist['status'];
        }
        return false;
    }

}
