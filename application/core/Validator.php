<?php
namespace core;

use core\classTables\Roles;
use core\classTables\Users;

class Validator
{
    private $errorStack;
    private $input;

    public function  __get($name)
    {
        return $this->$name;
    }

    public function __construct($input)
    {
        $this->input = $input;
    }

    public function isEmail($error = 'Incorrect email format')
    {
        if (!is_string($this->input) || filter_var($this->input, FILTER_VALIDATE_EMAIL) == false) {
            $this->errorStack[] = $error;
        }

        return $this;
    }

    public function isAlnum($error = 'Not an alnum')
    {
        if (!ctype_alnum($this->input)) {
            $this->errorStack[] = $error;
        }

        return $this;
    }

    public function hasFormat($pattern, $error = 'Wrong format')
    {
        if (!preg_match($pattern, $this->input)) {
            $this->errorStack[] = $error;
        }

        return $this;
    }

    public function isEqual($comparedTo, $error = 'Not equal')
    {
        if ($this->input != $comparedTo) {
            $this->errorStack[] = $error;
        }

        return $this;
    }

    public function isValid()
    {
        return !count($this->errorStack);
    }

    public function isEmpty($error)
    {
        if (empty($this->input))
            $this->errorStack[] = $error;
        return $this;
    }

    public function lengthBetween($max, $min, $error = "Value doesn't belong to segment")
    {
        if (strlen($this->input) > $max || strlen($this->input) < $min)
            $this->errorStack[] = $error;
        return $this;
    }

    public function getErrors()
    {
        return $this->errorStack;
    }

    public function isUsernameTaken($error = 'Sorry username is already taken !')
    {
        $selectUser = new Users();
        $selObj = $selectUser->selectPrepare();
        $resultRowSet = $selObj->selectColumns(['username'])->where(['username=' => "?"])->fetch([$this->input]);
        if ($resultRowSet['username'])
            $this->errorStack[] = $error;
        return $this;
    }

    public function isEmailTaken($error = 'Sorry email is already taken !')
    {
        $selectUser = new Users();
        $selObj = $selectUser->selectPrepare();
        $resultRowSet = $selObj->selectColumns(['email'])->where(['email =' => "?"])->fetch([$this->input]);
        if ($resultRowSet['email'])
            $this->errorStack[] = $error;
        return $this;
    }


}
