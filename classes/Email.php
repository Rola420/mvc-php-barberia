<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $correo;
    public $nombre;
    public $token;

    public function __construct($correo, $nombre, $token) {

        $this->correo = $correo;
        $this->nombre = $nombre;
        $this->token = $token;

    }

    public function enviarConfirmacion() {

        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host =  $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASSWORD'];
    
        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'Confirma tu Cuenta';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->correo .  "</strong> Has Creado tu cuenta en App Salón, solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona aquí: <a href='" .  $_ENV['APP_URL']  . "/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a>";        
        $contenido .= "<p>Si tu no solicitaste este cambio, has caso omiso</p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();

    }

    public function enviarInstrucciones() {

        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host =  $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASSWORD'];
    
        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'Reestablece tu contraseña';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> Has solicitado reestablecer tu contraseña, sigue el siguiente enlace para hacerlo.</p>";
        $contenido .= "<p>Presiona aquí: <a href='" .  $_ENV['APP_URL']  . "/recuperar?token=" . $this->token . "'>Reestablecer Contraseña</a>";        
        $contenido .= "<p>Si tu no solicitaste este cambio, has caso omiso</p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();

    }

}
