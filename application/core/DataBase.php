<?php
namespace core;

class DataBase {
    private $db;
    private $className;
    private $dsn;
    private $user;
    private $password;
    public function __construct(){
        $this->className=get_class($this);
        $this->getDbConfig();
    }
    public function getDbConfig()
    {
        $type=Config::getProperty('Database', 'type');
        $host=Config::getProperty('Database', 'host');
        $dbname=Config::getProperty('Database', 'dbname');
        $user=Config::getProperty('Database', 'user');
        $password=Config::getProperty('Database', 'password');
        $dsn="$type:dbname=$dbname;host=$host";
        $this->db = new PDO($dsn,$user,$password);
        return $this->db;
    }
   function selectPrepare() {
       return new Select($this->className,$this->db);
    }
   private function quote($arr){
        $res=array();
        for ($i=0;$i<count($arr);$i++){
            $val=$this->db->quote($arr[$i]);
            $res[$i]=$val;
        }
        $values=implode(",",$res);
        return $values;
    }
    function insert($col=null)
    {
        $cols=implode(',', array_keys($col));
        $values=array_values($col);
        $values=$this->quote($values);
        $sql=$this->db->prepare("INSERT INTO `{$this->className}` ($cols) VALUES ($values);");
        $sql->execute();
        $sql->debugDumpParams();
    }
   function update($fields,$construct=null,$values=null)
    {
        $fields_res=array();
        for ($i=0;$i<count($fields);$i++) {
            $fields_cols=array_keys($fields);
            $fields_val=array_values(($fields));
            $fields_res[$i]="$fields_cols[$i]='$fields_val[$i]'";
        }
        $fields_res=implode(",",$fields_res);
        $sql=$this->db->prepare("UPDATE `{$this->className}` SET $fields_res where $construct");

        if (!empty($values)){
            $sql=$this->db->prepare("UPDATE `{$this->className}` SET $fields_res where $construct");
            for($i=0;$i<count($values);$i++){
                $sql->bindParam($i+1, $values[$i]);
            }
            $sql->execute();
            $sql->debugDumpParams();
        }
        else {
            $sql->execute();
            $sql->debugDumpParams();
        }
    }
   function delete($construct=null,$log=null)
   {
        $sql=$this->db->prepare("DELETE FROM `{$this->className}` WHERE $construct ");
        if (!empty($log)){
            for($i=0;$i<count($log);$i++){
                $sql->bindParam($i+1, $log[$i]);
            }
            $sql->execute();
            $sql->debugDumpParams();
        }
        else {
            $sql->execute();
            $sql->debugDumpParams();
        }
    }

}