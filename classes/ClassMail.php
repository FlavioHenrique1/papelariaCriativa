<?php
namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ClassMail{
    private $mail;

    public function __construct()
    {
        $this->mail=new PHPMailer();
    }

    #Envio de email
    public function sendMail($email, $nome, $token=null , $assunto, $corpoEmail)
    {
        try {
            $this->mail->isSMTP();                                      // Set mailer to use SMTP
            $this->mail->Host = HOSTMAIL;  // Specify main and backup SMTP servers
            $this->mail->SMTPAuth = true;                               // Enable SMTP authentication
            $this->mail->Username = USERMAIL;                 // SMTP username
            $this->mail->Password = PASSMAIL;                           // SMTP password
            $this->mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $this->mail->Port = 587;                                    // TCP port to connect to
            $this->mail->CharSet='utf-8';
            $this->mail->SMTPOptions=array(
              "ssl"=>array(
                  "verify_peer"=>false,
                  "verify_peer_name"=>false,
                  "allow_self_signed"=>true
                  )
            );

            $this->mail->setFrom('fla-henrique@hotmail.com', 'Flávio');
            $this->mail->addAddress($email, $nome);     // Add a recipient

            $this->mail->isHTML(true);                                  // Set email format to HTML
            $this->mail->Subject = $assunto;
            $this->mail->Body    = $corpoEmail;

            $this->mail->send();
            //echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $this->mail->ErrorInfo;
        }
    }
}
