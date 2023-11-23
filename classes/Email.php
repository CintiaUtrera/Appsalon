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
        
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('cuentas@appsalon.com', 'AppSalon.com');
        $mail->addAddress('cuentas@appsalon.com');
        $mail->Subject = 'confirma tu cuenta';

        // Set HTML 
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->email . "</strong> Has creado tu cuenta en App Salón, solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona Aquí: <a href='" . $_ENV['APP_URL']. "/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignortar el mensaje </p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;

        // Enviar el email
        $mail->send();
    }

    public function  enviarInstrucciones(){
            // create a new object
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = $_ENV['EMAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Port = $_ENV['EMAIL_PORT'];
            $mail->Username = $_ENV['EMAIL_USER'];
            $mail->Password = $_ENV['EMAIL_PASS'];
        
            $mail->setFrom('cuentas@appsalon.com', 'AppSalon.com');
            $mail->addAddress('cuentas@appsalon.com');
            $mail->Subject = 'Reestablece tu password';
    
            // Set HTML
            $mail->isHTML(TRUE);
            $mail->CharSet = 'UTF-8';
    
            $contenido = '<html>';
            $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> Has solicitado reestablecer tu password, sigue el siguiente enlace para hacerlo.</p>";
            $contenido .= "<p>Presiona Aquí: <a href='" . $_ENV['APP_URL']. "/recuperar?token=" . $this->token . "'>Reestablecer Password</a>";        
            $contenido .= "<p>Si tu no solicitaste este cambio, puedes ignorar el mensaje</p>";
            $contenido .= '</html>';
            $mail->Body = $contenido;
    
            //Enviar el mail
            $mail->send();
    }
}


