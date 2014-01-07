<?php
namespace modules\search\model;

use core\classTables\Users;
use core\classTables\Memes;

class SearchModel
{
    private $query = '';
    private $view = '';
    public $result = array();

    public function __construct($query, $view)
    {
        $this->query = preg_replace("/[^\w\x7F-\xFF\s]/", " ", $query);
        $this->query = trim(preg_replace("/ +/", " ", $this->query));
        $this->view = $view;
    }

    public function search()
    {
        $words = explode(" ",$this->query);
        switch ($this->view) {
            case 'users':
                $table = new Users();
                $where = [];
                $select = $table->selectPrepare();
                foreach($words as $key => $value) {
                    $words[$key] = "%{$value}%";
                }
                $likestr = '';
                for($i = 0; $i < count($words); $i++) {
                    if($i == count($words)-1) {
                        $likestr .= "username LIKE ?";
                    } else {
                        $likestr .= "username LIKE ? OR ";
                    }
                }
                $this->result = $select->query(
                    "SELECT `id`, `username`, `avatar` FROM `users` WHERE {$likestr} ORDER BY username DESC",
                    $words
                );
                break;
            case 'memes':
                $table = new Memes();
                $where = [];
                $select = $table->selectPrepare();
                foreach($words as $key => $value) {
                    $words[$key] = "%{$value}%";
                }
                $likestr = '';
                for($i = 0; $i < count($words); $i++) {
                    if($i == count($words)-1) {
                        $likestr .= "memes.name LIKE ?";
                    } else {
                        $likestr .= "memes.name LIKE ? OR ";
                    }
                }
                $this->result = $select->query(
                    "SELECT memes.id, memes.name, memes.path, memes.date_create, memes.user_id, users.username " .
                    "FROM `memes` JOIN `users` ON memes.user_id = users.id WHERE {$likestr} ORDER BY date_create DESC",
                    $words
                );
//                $this->result = $select->selectColumns(
//                    ['memes.id', 'memes.name', 'memes.path', 'memes.date_create', 'memes.user_id', 'users.username']
//                )->
//                    join('', 'users', 'user_id', 'id')->where($where)->order(
//                        'date_create',
//                        'DESC'
//                    )->fetchAll(null);
                break;
            default:
                $table = new Users();
                $where = [];
                $select = $table->selectPrepare();
                foreach($words as $key => $value) {
                    $words[$key] = "%{$value}%";
                }
                $likestr = '';
                for($i = 0; $i < count($words); $i++) {
                    if($i == count($words)-1) {
                        $likestr .= "username LIKE ?";
                    } else {
                        $likestr .= "username LIKE ? OR ";
                    }
                }
                $this->result = $select->query("SELECT `id`, `username`, `avatar` FROM `users` WHERE {$likestr} ORDER BY username DESC",$words);
                break;
        }
    }

} 