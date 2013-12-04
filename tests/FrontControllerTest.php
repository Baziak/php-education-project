<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 11/14/13
 * Time: 10:17 AM
 */
//require_once realpath(__DIR__ . "/../../vendor/autoload.php");
require_once realpath(__DIR__ . "/../application/core/FrontController.php");
require_once realpath(__DIR__ . "/../bootstart.php");

class FrontControllerTest extends PHPUnit_Framework_TestCase
{
    public function testGetInstance()
    {
        $frontController = FrontController::getInstance();
        $this->assertInstanceOf('FrontController', $frontController);
    }

    public function testGetControllerPath()
    {
        $frontController = new FrontController();
        $this->assertEquals($frontController->getControllerPath('Index', 'main'), DIR_MOD.'main/controllers/IndexController.php');
    }
}
