<?php
namespace core;

class Request
{
    private $controller="index";
    private $action="index";
    private $module="main";
    private $params;
    // private $view;
    public function __construct()
    {
        $this->parseURI();
        //echo "controller=".$this->controller."<br>module=".$this->module."<br>action=".$this->action;
        //echo "<br>dir=".DIR_PUBLIC;
        //echo "<br>document_root=".$_SERVER['DOCUMENT_ROOT'];
    }
    public function getController()
    {
        return $this->controller;
    }
    public function getAction()
    {
        return $this->action;
    }
    public function getModule()
    {
        return $this->module;
    }
    public function getParams()
    {
        return $this->params;
    }

    private function parseURI()
    {
        $rep=str_replace($_SERVER['DOCUMENT_ROOT'], '', DIR_PUBLIC);
        //echo "<br>rep=".$rep;
        //$rout=str_replace($rep,'',$_SERVER['REQUEST_URI']);
        //echo "rout=".$rout;
        //$routes = explode('/', $_SERVER['REQUEST_URI']);
        $routes = explode('/', str_replace($rep, '', $_SERVER['REQUEST_URI']));
        //print_r($routes);
        echo $this->isCssFile();
        /*if (!empty($routes[1]) && !empty($routes[2])) {
            $this->module=$routes[1];
            $this->controller=$routes[2];
        }
        if (!empty($routes[3])) {
            $temp=preg_split("/\?/", $routes[3]);
            if (!empty($temp)) {
                $this->action=array_shift($temp);
                for ($j=0; $j<count($temp); $j++) {
                    $key_val=explode('&', $temp[$j]);
                    $eq=strpos($key_val[$j], '=');
                    $key=substr($key_val[$j], 0, $eq);
                    $value=substr($key_val[$j], $eq+1);
                    $this->params[$key][$value];
                }
            } else {
                $this->action = $routes[3];
            }
        }*/
        if (!empty($routes[0]) && !empty($routes[1])) {
            $this->module=$routes[0];
            $this->controller=$routes[1];
        }
        if (!empty($routes[2])) {
            $temp=preg_split("/\?/", $routes[2]);
            if (!empty($temp)) {
                $this->action=array_shift($temp);
                for ($j=0; $j<count($temp); $j++) {
                    $key_val=explode('&', $temp[$j]);
                    $eq=strpos($key_val[$j], '=');
                    $key=substr($key_val[$j], 0, $eq);
                    $value=substr($key_val[$j], $eq+1);
                    $this->params[$key][$value];
                }
            } else {
                $this->action = $routes[2];
            }
        }
    }

    private function isCssFile()
    {
        if (end(explode(".", $_SERVER['REQUEST_URI']))=='css') {
            return 'css';
        }
    }
}
