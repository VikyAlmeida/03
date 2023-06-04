<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/Exception.php';
require './PHPMailer/PHPMailer.php';
require './PHPMailer/SMTP.php';

class SendEmail{

    const debug = true;
    const host = 'sandbox.smtp.mailtrap.io';
    const auth = 'valor constante';
    const username = 'cf0fb29405e66a';
    const password = '524ae09f9cb6b5';
    const secure = 'tls';
    const port = 2525;

    function sendEmail($user, $subject, $message) {                 
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = self::debug;                      
            $mail->isSMTP();                                           
            $mail->Host       = self::host;                     
            $mail->SMTPAuth   = self::auth;                                    
            $mail->Username   = self::username;                     
            $mail->Password   = self::password;                               
            $mail->SMTPSecure = self::secure;            
            $mail->Port       = self::port;   
        //Recipients
        $mail->setFrom('viky2000.22@gmail.com', 'Mailer');
        $mail->addAddress($user["email"], $user["name"]);     //Add a recipient
        //Content
        $mail->isHTML(true);        
        $mail->CharSet = 'UTF-8';                          //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    } 

    }
}