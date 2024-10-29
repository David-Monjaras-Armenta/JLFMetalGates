<?php

include_once dirname(__DIR__, 2) . '/vendor/autoload.php';
include_once dirname(__DIR__, 1) . '/utils/logs.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

class MailHandler
{
    public static function send_mail($to, $subject, $message)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = $_ENV['MAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['MAIL_USERNAME'];
            $mail->Password = $_ENV['MAIL_PASSWORD'];
            $mail->SMTPSecure = $_ENV['MAIL_SECURE'];
            $mail->Port = $_ENV['MAIL_PORT'];

            $mail->setFrom($_ENV['MAIL_FROM'], 'Info JLF Metal Gates');
            $mail->addAddress($to, 'Admin JLF Metal Gates');

            $mail->isHTML(true);
            $mail->ContentType = 'text/html; charset=UTF-8';
            $mail->Subject = $subject;
            $mail->Body = $message;

            $mail->send();
            return true;
        } catch (Exception $e) {
            Logger::log(Logger::$ERROR, $e);
            return false;
        }
    }
}
