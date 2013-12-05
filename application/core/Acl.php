<?php
namespace core;
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
        $result = $selectObj->where(['role' => "$this->role"])->selectColumn(['module', 'controller', 'action']);
        /*while ($result = $result->fetchAll()) {
            foreach ($result as $value) {
                if ($value['module'] == $module && $value['controller'] == $controller && $value['action'] == $action) {
                    return true;
                }
            }
        }*/
        var_dump($result);
    }

    public function setPermission($role, $module, $controller = null, $action = null)
    {
        $insertAccess = new Access();
        $insertAccess->insert(
            ['role' => "$role", 'module' => "$module", 'controller' => "$controller", 'action' => "$action"]
        );
    }
}

$obj = new Acl('admin');
$obj->setPermission('admin','user','mem','delete');
