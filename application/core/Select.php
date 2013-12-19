<?php

namespace core;

use \PDO;

class Select
{
    private $table;
    private $where;
    private $db;
    private $sql;
    private $order;
    private $limit;
    private $join;
    private $cols;
    private $group;
    private $tables;
    private $distinct;
    public function __construct($table, PDO $db)
    {
        $this->table = $table;
        $this->db = $db;
    }

    public function printSmt()
    {
        $result = $this->table;
        var_dump($result);
    }

    public function selectColumns($cols)
    {
        $this->cols = implode(",", $cols);
        return $this;
    }

    public function where($construct = null)
    {
        $keys = array_keys($construct);
        $values = array_values($construct);
        $convert = "";
        for ($i = 0; $i < count($construct); $i++) {
            preg_match('/([`()])/', $values[$i],$matches,PREG_OFFSET_CAPTURE);
            preg_match('/(\/)/', $values[$i],$slash,PREG_OFFSET_CAPTURE);
            if ($values[$i] != '?' && strtoupper($values[$i]) != 'IS NULL' && count($slash)!=null && count($matches)==null) {
                $values[$i] = $this->db->quote($values[$i]);
            }
            $convert .= $keys[$i] . $values[$i] . " ";
        }
        $this->where = "WHERE " . $convert;
        return $this;
    }

    public function order($field, $flag = null)
    {
        switch ($flag) {
            case 'ASC':
                $this->order = 'ORDER BY ' . $field . ' ASC'; //в восходящем порядке
                break;
            case 'DESC':
                $this->order = 'ORDER BY ' . $field . ' DESC'; //в обратном
                break;
            default:
                $this->order = 'ORDER BY ' . $field;
        }
        return $this;
    }

    public function limit($count = null, $end = null)
    {
        if (empty($end)) {
            $this->limit = ' LIMIT ' . $count;
        } else {
            $this->limit = ' LIMIT ' . $count . ',' . $end;
        }
        return $this;
    }

    public function group($field, $table = null)
    {
        if (empty($table)) {
            $this->group = ' GROUP BY ' . $field;
        } else {
            $this->group = ' GROUP BY ' . $table . '.' . $field;
        }
        return $this;
    }

    public function join($flag, $table2, $col1, $col2)
    {
        $flag = strtoupper($flag);
        $this->join = " " . $flag . " JOIN `$table2` ON {$this->table}.`$col1`=$table2.`$col2` ";
        return $this;
    }
    public function distinct($flag)
    {
        if ($flag=='1') {
            $this->distinct="DISTINCT ";
        } else {
            $this->distinct="";
        }
        return $this;
    }

    public function fetchAll($values = null)
    {
        $this->sql = "SELECT " . $this->distinct . $this->cols . " FROM `$this->table` ".$this->tables
            . $this->join . $this->where . $this->group . $this->order . $this->limit;
        $sql = $this->db->prepare($this->sql);
        if (!empty($values)) {
            for ($i = 0; $i < count($values); $i++) {
                $sql->bindParam($i + 1, $values[$i]);
            }
        }
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        //$sql->debugDumpParams();
        return $result;
    }

    public function fetch($values = null)
    {
        $this->sql = "SELECT " . $this->distinct . $this->cols . " FROM `$this->table` " .$this->tables
            . $this->join . $this->where . $this->order . $this->limit;
        $sql = $this->db->prepare($this->sql);
        if (!empty($values)) {
            for ($i = 0; $i < count($values); $i++) {
                $sql->bindParam($i + 1, $values[$i]);
            }
        }
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        //$sql->debugDumpParams();
        return $result;
    }

    public function from($tables = null)
    {
        $t_old=array();
        if ($tables!=null) {
            for ($i=0; $i<count($tables); $i++) {
                $t_old[$i]="`".$tables[$i]."`";
            }
            $this->tables=",".implode(",", $t_old);
            return $this;
        }
    }
}
