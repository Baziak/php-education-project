<?php
require_once(realpath(__DIR__ . '/../bootstart.php'));
require_once(realpath(__DIR__ . '/../application/modules/user/controllers/UserController.php'));

class UserControllerTest extends PHPUnit_Framework_TestCase
{
    public function testProfileAction()
    {
        $UserController = new UserController();
        $this->assertEquals($UserController->profileAction(), DIR_MOD . 'user/controllers/UserController.php');
    }
}
