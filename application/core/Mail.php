<?php

namespace core;

class Mail
{
    private $headers = '';
    private $smtp_host = '';
    private $smtp_port = '';
    private $smtp_login = '';
    private $smtp_pass = '';

    private $mail_from = '';
    private $mail_to = '';
    private $mail_subject = '';
    private $mail_body = '';

    private $view = array(
        "head" => "Header",
        "footer" => "Footer",
        "content" => "Content"
    );

    private $errors = array();

    const NEW_LINE = "\r\n";

    public function __construct($from = '', $to = '', $subject = '', $body = '')
    {
        $this->smtp_host = Config::getProperty("smtp", "host");
        $this->smtp_port = Config::getProperty("smtp", "port");
        $this->smtp_login = Config::getProperty("smtp", "login");
        $this->smtp_pass = Config::getProperty("smtp", "password");;

        $this->mail_from = $from;
        $this->mail_to = $to;
        $this->mail_subject = $subject;
        $this->view['content'] = $body;
        $this->mkHeaders();
        include 'mailtemplate.php';
    }

    public function __set($key, $value)
    {
        switch ($key) {
            case 'from':
                $this->mail_from = $value;
                break;
            case 'to':
                $this->mail_to = $value;
                break;
            case 'subject':
                $this->mail_subject = $value;
                break;
            case 'body':
                $this->mail_body = $value;
                break;
            case 'smtp_user':
                $this->smtp_login = $value;
                break;
            case 'smtp_pass':
                $this->smtp_pass = $value;
                break;
        }
    }

    public function send()
    {
        $connect = fsockopen($this->smtp_host, $this->smtp_port, $errno, $errstr, 10);
        $this->getData($connect);
        fputs($connect, "EHLO " . $this->smtp_host . self::NEW_LINE);
        $this->getData($connect);
        fputs($connect, "AUTH LOGIN" . self::NEW_LINE);
        $this->getData($connect);
        fputs($connect, base64_encode($this->smtp_login) . self::NEW_LINE);
        $this->getData($connect);
        fputs($connect, base64_encode($this->smtp_pass) . self::NEW_LINE);
        $this->getData($connect);
        fputs($connect, "MAIL FROM:" . $this->mail_from . self::NEW_LINE);
        $this->getData($connect);
        fputs($connect, "RCPT TO:" . $this->mail_to . self::NEW_LINE);
        $this->getData($connect);
        fputs($connect, "DATA" . self::NEW_LINE);
        $this->getData($connect);
        fputs($connect, $this->headers . self::NEW_LINE . $this->mail_body . self::NEW_LINE . "." . self::NEW_LINE);
        $data = $this->getData($connect);
        $code = substr($data, 0, 3);
        if ((int)$code == 500) {
            $this->errors[] = "Sending email was failed!";
        }
        fputs($connect, "QUIT" . self::NEW_LINE);
        $this->getData($connect);
        fclose($connect);
    }

    private function mkHeaders()
    {
        $this->headers = "MIME-Version: 1.0" . self::NEW_LINE;
        $this->headers .= "Content-type: text/html; charset=utf-8" . self::NEW_LINE;
        $this->headers .= "To: <{$this->mail_to}>" . self::NEW_LINE;
        $this->headers .= "From: <{$this->mail_from}>" . self::NEW_LINE;
        $this->headers .= "Subject: {$this->mail_subject}" . self::NEW_LINE;
    }

    private function getData($connect)
    {
        $data = "";
        while ($str = fgets($connect, 515)) {
            $data .= $str;
            if (substr($str, 3, 1) == " ") {
                break;
            }
        }
        return $data;
    }
}
