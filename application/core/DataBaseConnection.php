<?php
/**
 * Created by PhpStorm.
 * User: anna
 * Date: 18.12.13
 * Time: 16:13
 */
namespace core;

use \PDO;
use \PDOException;
use core\Config;

class DataBaseConnection
{
    private static $instance;
    private $type;
    private $host;
    private $dbname;
    private $user;
    private $password;
    private $charset;
    private function __construct()
    {
        $this->getDbType();
        $this->getDbHost();
        $this->getDbName();
        $this->getDbUser();
        $this->getDbPassword();
        $this->getDbCharset();
    }
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance=new DataBaseConnection();
        }
        return self::$instance;
    }
    public function getDbConfig()
    {
        //$type=Config::getProperty('Database', 'type');
        /*$host=Config::getProperty('Database', 'host');
        $dbname=Config::getProperty('Database', 'dbname');
        $user=Config::getProperty('Database', 'user');
        $password=Config::getProperty('Database', 'password');
        $charset = Config::getProperty('Database', 'charset');*/
        $dsn="$this->type:dbname=$this->dbname;host=$this->host;charset=$this->charset";
        $db = new PDO($dsn, $this->user, $this->password);
        return $db;
    }
    public function getDbType()
    {
        $this->type=Config::getProperty('Database', 'type');
        return $this->type;
    }
    public function getDbHost()
    {
        $this->host=Config::getProperty('Database', 'host');
        return $this->host;
    }
    public function getDbName()
    {
        $this->dbname=Config::getProperty('Database', 'dbname');
        return $this->dbname;
    }
    public function getDbUser()
    {
        $this->user=Config::getProperty('Database', 'user');
        return $this->user;
    }
    public function getDbPassword()
    {
        $this->password=Config::getProperty('Database', 'password');
        return $this->password;
    }
    public function getDbCharset()
    {
        $this->charset = Config::getProperty('Database', 'charset');
        return $this->charset;
    }
}
