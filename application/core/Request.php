<?php
namespace core;

class Request
{
    private $controller = "index";
    private $action = "index";
    private $module = "news";
    private $params;

    // private $view;
    public function __construct()
    {
        $this->parseURI();
        //echo "controller=".$this->controller."<br>module=".$this->module."<br>action=".$this->action;
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
        if (isConfiguredDocRoot()) {
            $routes = explode('/', $_SERVER['REQUEST_URI']);
        } else {
            $routes = explode('/', str_replace("/" . Registry::getValue('rootDirName'), '', $_SERVER['REQUEST_URI']));
        }
        //print_r($routes);
        if (!empty($routes[1]) && !empty($routes[2])) {
            $this->module = $routes[1];
            $this->controller = $routes[2];
        }
        if (!empty($routes[3])) {
            $temp = preg_split("/\?/", $routes[3]);
            if (!empty($temp)) {
                $this->action = array_shift($temp);
                for ($j = 0; $j < count($temp); $j++) {
                    $key_val = explode('&', $temp[$j]);
                    $eq = strpos($key_val[$j], '=');
                    $key = substr($key_val[$j], 0, $eq);
                    $value = substr($key_val[$j], $eq + 1);
                    $this->params[$key][$value];
                }
            } else {
                $this->action = $routes[3];
            }
        }
    }
}
