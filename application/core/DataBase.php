<?php

namespace core;

//use \PDO;
use core\DataBaseConnection;
use \PDOException;

class DataBase
{
    private $db;
    private $className;
    private $where;
    public function __construct()
    {
        $class=get_class($this);
        $this->className=$class::$classTable;
        //$this->getDbConfig();
        $dbConnect=DataBaseConnection::getInstance();
        $this->db=$dbConnect->getDbConfig();
    }

    /*private function getDbConfig()
    {
        $type=Config::getProperty('Database', 'type');
        $host=Config::getProperty('Database', 'host');
        $dbname=Config::getProperty('Database', 'dbname');
        $user=Config::getProperty('Database', 'user');
        $password=Config::getProperty('Database', 'password');
        $charset = Config::getProperty('Database', 'charset');
        $dsn="$type:dbname=$dbname;host=$host;charset=$charset";
        $this->db = new PDO($dsn, $user, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET utf8"));
        return $this->db;
    }*/
    public function selectPrepare()
    {
        return new Select($this->className, $this->db);
    }
    private function quote($arr)
    {
        $res=array();
        for ($i=0; $i<count($arr); $i++) {
            $val=$this->db->quote($arr[$i]);
            $res[$i]=$val;
        }
        $values=implode(",", $res);
        return $values;
    }
    public function insert($col = null)
    {
        //$cols=implode(',', array_keys($col));
        $cols_v=array_keys($col);
        $cols_value=array();
        for ($i=0; $i<count($col); $i++) {
            $cols_value[$i]='`'.$cols_v[$i].'`';
        }
        $cols=implode(',', $cols_value);
        $values=array_values($col);
        $values=$this->quote($values);
        $sql=$this->db->prepare("INSERT INTO `{$this->className}` ($cols) VALUES ($values);");
        $sql->execute();
    }
    public function update($fields, $construct = null, $values = null)
    {
        $fields_res=array();
        for ($i=0; $i<count($fields); $i++) {
            $fields_cols=array_keys($fields);
            $fields_val=array_values(($fields));
            preg_match('/([\*\+-\/])/', $fields_val[$i], $matches, PREG_OFFSET_CAPTURE);
            if (count($matches)!=null) {
                $fields_res[$i]="`$fields_cols[$i]`=$fields_val[$i]";
            } else {
                $fields_res[$i]="`$fields_cols[$i]`='$fields_val[$i]'";
            }
        }
        $fields_res=implode(",", $fields_res);
        if ($construct!=null) {
            $this->where=" where ".$construct;
        }
        $sql=$this->db->prepare("UPDATE `{$this->className}` SET $fields_res $this->where");

        if (!empty($values)) {
            $sql=$this->db->prepare("UPDATE `{$this->className}` SET $fields_res $this->where");
            for ($i=0; $i<count($values); $i++) {
                $sql->bindParam($i+1, $values[$i]);
            }
            $sql->execute();
            //$sql->debugDumpParams();
        } else {
            $sql->execute();
            //$sql->debugDumpParams();
        }
    }
    public function delete($construct = null, $log = null)
    {
        $sql=$this->db->prepare("DELETE FROM `{$this->className}` WHERE $construct ");
        if (!empty($log)) {
            for ($i=0; $i<count($log); $i++) {
                $sql->bindParam($i+1, $log[$i]);
            }
            $sql->execute();
            //$sql->debugDumpParams();
        } else {
            $sql->execute();
            //$sql->debugDumpParams();
        }
    }
}
