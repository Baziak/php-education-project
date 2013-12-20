<?php
namespace core;

use \Exception;

class View
{
    private $path;
    private $page;
    private $include_file;
    private $variables = array();
    private $template = 'template.php';
    private $module;

    private $params = array(
        'xss_protection' => true
    );

    public function __construct($module, $page)
    {
        $this->path = DIR_MOD . $module . "/views/";
        $this->page = $page;
        $this->module = $module;
    }

    public function addIntoTemplate()
    {
        $this->include_file = $this->path . $this->page;
        if (!file_exists($this->include_file)) {
            throw new Exception('Include file ' . $this->include_file . ' not exist');
        }
        return true;
    }

    public function getCssFile()
    {
        $links = array();
        $path_to_css = "css/" . $this->module . "/";
        $matches = glob($path_to_css . "*.css");
        if (is_array($matches)) {
            for ($i = 0; $i < count($matches); $i++) {
                $temp = '<link rel="stylesheet" type="text/css" media="screen" href="'
                    .BASE_URL. "" . $matches[$i] . '" />';
                $links[$i] = $temp;
            }
        }
        return $links;
    }

    public function getJsFile()
    {
        $links = array();
        $path_to_js = "js/" . $this->module . "/";
        $matches = glob($path_to_js . "*.js");
        if (is_array($matches)) {
            for ($i = 0; $i < count($matches); $i++) {
                $temp = '<script type="text/javascript" src="' .BASE_URL. "" . $matches[$i] . '"></script>';
                $links[$i] = $temp;
            }
        }
        return $links;
    }

    public function assign($name, $value)
    {
        $this->variables[$name] = $value;
    }

    public function __get($name)
    {
        if (isset($this->variables[$name])) {
            $variable = $this->variables[$name];

         /*   if ($this->params['xss_protection']) {
                $variable = $this->xssProtection($variable);
            }
         */
            return $variable;
        }

        return null;
    }

    private function xssProtection($variable)
    {
        if (is_array($variable)) {
            $protected = array();
            foreach ($variable as $key => $value) {
                $protected[$key] = $this->xssProtection($value);
            }

            return $protected;
        }
        return htmlspecialchars($variable);
    }

    public function display()
    {
        require_once(DIR_PUBLIC . $this->template);
    }
}
