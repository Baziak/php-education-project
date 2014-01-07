<?php
/**
 * Created by PhpStorm.
 * User: anna
 * Date: 18.12.13
 * Time: 16:32
 */
use core\DataBaseConnection;
use \Exception;
use core\Config;

require_once("/var/www/php-education-project/public/bootstart.php");
//require_once "./vendor/autoload.php";
class DataBaseConnectionTest extends PHPUnit_Framework_TestCase
{
    protected $fixture;

    protected function setUp()
    {
        $this->fixture = DataBaseConnection::getInstance();
    }

    protected function tearDown()
    {
        $this->fixture = null;
    }

    public function testGetInstance()
    {
        $this->assertInstanceOf('core\DataBaseConnection', $this->fixture);
    }

    public function testGetDbType()
    {
        $this->assertNotNull($this->fixture->getDbType());
    }

    public function testGetDbConfig()
    {
        $this->assertNotNull($this->fixture->getDbConfig());
    }

    public function testGetDbCharset()
    {
        $this->assertNotNull($this->fixture->getDbCharset());
    }
}
