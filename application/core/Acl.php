<?php
namespace core;

use core\classTables\Access;

class Acl
{
    public $role;

    public function __construct($role)
    {
        $this->role = $role;
    }

    public function hasPermission($module, $controller, $action)
    {
        $selectAccess = new Access();
        $selectObj = $selectAccess->selectPrepare();
        $result = $selectObj->where(['role=' => "$this->role"])->selectColumns(['module', 'controller', 'action'])->fetchAll();
        for ( $i=0; $i < count($result); $i++ ) {
            foreach ($result as $value) {
                if ($value['module'] == "$module" && $value['controller'] == "$controller" && $value['action'] == "$action") {
                    return true;
                }
            }
        }
    }

    public function setPermission($role, $module, $controller = null, $action = null)
    {
        $insertAccess = new Access();
        $insertAccess->insert(
            ['role' => "$role", 'module' => "$module", 'controller' => "$controller", 'action' => "$action"]
        );
    }
}
