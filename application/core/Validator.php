<?php
namespace core;

class Validator
{
    private $errorStack;
    private $input;

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

    public function getErrors()
    {
        return $this->errorStack;
    }
}
