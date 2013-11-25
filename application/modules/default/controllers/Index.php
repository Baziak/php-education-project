<?php

class IndexController
{
    public function indexAction()
    {
        $module=Registry::getValue('module');
        $v = new View($module,'home.php');
        $v->assign('title','Home page');

        try{
            $v->addIntoTemplate();
            $v->display();
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
}
