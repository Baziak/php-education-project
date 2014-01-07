<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 11/14/13
 * Time: 10:17 AM
 */
//require_once realpath(__DIR__ . "/../../vendor/autoload.php");
use \Exception;
use core\Request;
use core\FrontController;

class FrontControllerTest extends PHPUnit_Framework_TestCase
{
    protected $fixture;

    protected function setUp()
    {
        $this->fixture = FrontController::getInstance();
    }

    protected function tearDown()
    {
        $this->fixture = null;
    }

    public function testGetInstance()
    {
        $this->assertInstanceOf('core\FrontController', $this->fixture);
    }

    /*public function testGetControllerPath()
    {
        $frontController = FrontController::getInstance();
        $this->assertEquals($frontController->getControllerPath('Index', 'main'),
          DIR_MOD.'main/controllers/IndexController.php');
    }*/
    /**
     * @dataProvider providerGetControllerPath
     */
    public function testGetControllerPath($a, $b, $c)
    {
        $this->assertEquals($this->fixture->getControllerPath($a, $b), $c);
        try {
            $this->fixture->getControllerPath('user', 'mod');
        } catch (Exception $e) {
            return;
        }
        $this->fail('Not raise an exception');
    }

    public function testGetControllerPathException()
    {
        $this->setExpectedException('Exception');
        $this->fixture->getControllerPath('user', 'mod');
    }

    /**
     * @expectedException Exception
     */
    public function testGetControllerPathException2()
    {
        $this->fixture->getControllerPath('user', 'mod');
    }

    public function providerGetControllerPath()
    {
        return array(
            array('Index', 'main', DIR_MOD . 'main/controllers/IndexController.php'),
            array('Index', 'news', DIR_MOD . 'news/controllers/IndexController.php'),
            array('Index', 'likes', DIR_MOD . 'likes/controllers/IndexController.php'),
            array('Meme', 'meme', DIR_MOD . 'meme/controllers/MemeController.php'),
            array('User', 'user', DIR_MOD . 'user/controllers/UserController.php')
        );
    }
}
