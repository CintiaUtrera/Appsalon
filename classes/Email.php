<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\Test\SendTestCase;

class Email {

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion(){
        // Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP(); // protocolo de envio de email
        
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'a1eb754321d2ab';
        $mail->Password = 'e2496d345e2424';

        $mail->setFrom('cuentas@appsalon.com', 'AppSalon.com');
        $mail->addAddress('cuentas@appsalon.com');
        $mail->Subject = 'Reestablece tu password';

        // Set HTML 
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has solicitado reestablecer tu password, sigue el siguiente enlace para hacerlo. </p>";
        $contenido .= "<p>Presiona Aquí: <a href='http://localhost:3000/recuperar?token=" . $this->token . "'>Reestablecer Password</a></p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignortar el mensaje </p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;

        // Enviar el email
        $mail->send();
    }

    public function  enviarInstrucciones(){
        
    }
}


