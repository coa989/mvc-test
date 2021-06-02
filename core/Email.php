<?php

namespace app\core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 * Class Email
 * @package app\core
 */
class Email
{
    protected PHPMailer $mail;
    protected string $mailContent;

    /**
     * Email constructor.
     */
    public function __construct()
    {
        $this->mail = new PHPMailer(true);
    }

    /**
     * @param $email
     * @param $name
     * @param $subject
     * @param $message
     * @throws Exception
     */
    public function contact($email, $name, $subject, $message)
    {
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.mailtrap.io';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = '0c05e4dcdf4d2a';
        $this->mail->Password = '2708babdaaf423';
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Port = 2525;

        $this->mail->setFrom("$email", "$name");
        $this->mail->addReplyTo("$email", "$name");
        $this->mail->addAddress('a.marjanovic989@gmail.com');

        $this->mail->Subject = "$subject";

        $this->mail->isHTML(true);

        $this->mailContent = "<h1>Contact</h1>
            <p>$message</p>";
        $this->mail->Body = $this->mailContent;

        if($this->mail->send()){
            echo 'Message has been sent';
        }else{
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $this->mail->ErrorInfo;
        }
    }
}