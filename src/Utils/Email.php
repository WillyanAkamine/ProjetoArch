<?php

namespace App\Utils;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email
{
    private $mailer;

    public function __construct($host, $username, $password, $port = 587, $smtpSecure = 'tls')
    {
        $this->mailer = new PHPMailer(true);
        $this->mailer->isSMTP();
        $this->mailer->Host = $host;
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = $username;
        $this->mailer->Password = $password;
        $this->mailer->SMTPSecure = $smtpSecure;
        $this->mailer->Port = $port;
    }

    public function send($from, $to, $subject, $body, $isHtml = true)
    {
        try {
            $this->mailer->setFrom($from);
            
            $this->mailer->addAddress($to);

            $this->mailer->isHTML($isHtml);
            $this->mailer->Subject = $subject;
            $this->mailer->Body    = $body;

            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            error_log("Erro ao enviar e-mail: {$this->mailer->ErrorInfo}");
            return false;
        }
    }
}
