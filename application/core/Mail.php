<?php

class Mail
{
    private $headers = '';
    private $smtp_server = '';
    private $smtp_port = '';
    private $smtp_user = '';
    private $smtp_pass = '';

    private $mail_from = '';
    private $mail_to = '';
    private $mail_subject = '';
    private $mail_body = '';

    private $errors = array();

    const NEW_LINE = "\r\n";

    public function __construct($server, $port, $user = '', $pass = '', $from = '', $to = '', $subject = '', $body = '')
    {
        $this->smtp_server = $server;
        $this->smtp_port = $port;
        $this->smtp_user = $user;
        $this->smtp_pass = $pass;

        $this->mail_from = $from;
        $this->mail_to = $to;
        $this->mail_subject = $subject;
        $this->mail_body = $body;
        $this->mk_headers();
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
                $this->smtp_user = $value;
                break;
            case 'smtp_pass':
                $this->smtp_pass = $value;
                break;
        }
    }

    public function send()
    {
        $connect = fsockopen($this->smtp_server, $this->smtp_port, $errno, $errstr, 10);
        $this->get_data($connect);
        fputs($connect, "EHLO " . $this->smtp_server . self::NEW_LINE);
        $this->get_data($connect);
        fputs($connect, "AUTH LOGIN" . self::NEW_LINE);
        $this->get_data($connect);
        fputs($connect, base64_encode($this->smtp_user) . self::NEW_LINE);
        $this->get_data($connect);
        fputs($connect, base64_encode($this->smtp_pass) . self::NEW_LINE);
        $this->get_data($connect);
        fputs($connect, "MAIL FROM:" . $this->mail_from . self::NEW_LINE);
        $this->get_data($connect);
        fputs($connect, "RCPT TO:" . $this->mail_to . self::NEW_LINE);
        $this->get_data($connect);
        fputs($connect, "DATA" . self::NEW_LINE);
        $this->get_data($connect);
        fputs($connect, $this->headers . self::NEW_LINE . $this->mail_body . self::NEW_LINE . "." . self::NEW_LINE);
        $data = $this->get_data($connect);
        $code = substr($data, 0, 3);
        if ((int)$code == 500) {
            $this->errors[] = "Sending email was failed!";
        }
        fputs($connect, "QUIT" . self::NEW_LINE);
        $this->get_data($connect);
        fclose($connect);
    }

    private function mk_headers()
    {
        $this->headers = "MIME-Version: 1.0" . self::NEW_LINE;
        $this->headers .= "Content-type: text/html; charset=utf-8" . self::NEW_LINE;
        $this->headers .= "To: <{$this->mail_to}>" . self::NEW_LINE;
        $this->headers .= "From: <{$this->mail_from}>" . self::NEW_LINE;
        $this->headers .= "Subject: {$this->mail_subject}" . self::NEW_LINE;
    }

    private function get_data($connect)
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
