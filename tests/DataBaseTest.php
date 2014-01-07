<?php
/**
 * Created by PhpStorm.
 * User: anna
 * Date: 18.12.13
 * Time: 15:15
 */

use core\DataBase;
use \core\classTables\MemesTags;
use \PDO;
use core\classTables\Users;
use core\DataBaseConnection;
use \Exception;
use core\Config;

//require_once ("/var/www/php-education-project/public/bootstart.php");
//require_once "PHPUnit/Extensions/Database/TestCase.php";
class DataBaseTest extends PHPUnit_Extensions_Database_TestCase
{
    public function getConnection()
    {
        $dbConnect = DataBaseConnection::getInstance();
        $pdo = $dbConnect->getDbConfig();
        return $this->createDefaultDBConnection($pdo);
    }

    public function getDataSet()
    {
        //return $this->createXMLDataSet(dirname(__FILE__).'/DataSet.xml');
    }

    public function testGetRowCount()
    {
        $this->assertEquals(3, $this->getConnection()->getRowCount('memes_tags'));
    }
}
