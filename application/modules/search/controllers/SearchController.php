<?php
namespace modules\search\controllers;

use core\Registry;
use core\View;
use \Exception;
use modules\search\model\SearchModel;

class SearchController
{
    public function resultAction()
    {
        try {
            $errors = array();
            $module = Registry::getValue('module');
            $v = new View($module, 'search.php');
            $model = new \stdClass();
            $view = isset($_GET['view']) ? $_GET['view'] : 'memes';
            if (!isset($_GET['query']) || empty($_GET['query'])) {
                $errors[] = "Введите поисковый запрос!";
            } else {
                if (isset($_GET['view']) && !empty($_GET['view'])) {
                    $model = new SearchModel($_GET['query'], $_GET['view']);
                } else {
                    $model = new SearchModel($_GET['query'], 'users');
                }
            }
            if (!$errors) {
                $model->search();
            }
            $v->assign('view', $view);
            $v->assign('memes_tab', $this->getSearchUrl('memes'));
            $v->assign('users_tab', $this->getSearchUrl('users'));
            $v->assign('errors', $errors);
            $v->assign('data', $model->result);
            $v->assign('title', 'Search');
            $v->addIntoTemplate();
            $v->display();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getSearchUrl($table)
    {
        $url = '';
        switch ($table) {
            case 'users':
                $url = "result?view={$table}&query=" . htmlspecialchars($_GET['query']);
                break;
            case 'memes':
                $url = "result?view={$table}&query=" . htmlspecialchars($_GET['query']);
                break;
            default:
                $url = "result?view=memes";
        }
        return $url;
    }
} 