<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);//instancia a classe PHPMailer, permite q var/objeto mail herde propriedades
 error_reporting(E_ALL); ini_set('display_errors', 1);
try {
    //Server settings
    /*
host: smtp.gmail.com
port: 587 or 465 (587 for tls, 465 for ssl)
protocol: tls or ssl
    */
    $mail->SMTPDebug  = 1; // enables SMTP debug information (for testing)
                       // 1 = errors and messages
                       // 2 = messages only
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    //$mail->Host = 'smtp.aol.com'; 
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'profweb27@gmail.com';                     //SMTP username
    $mail->Password   = 'passTestes';                               //SMTP password
    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail ->  SMTPSecure ='ssl';
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('profweb27@gmail.com', 'Empresa');
    $mail->addAddress($email, 'Destinatário');     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $assunto ;
    $mail->Body    = $msg;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
