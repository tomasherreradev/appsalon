<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token) {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;

    }

    public function enviarConfirmacion() {
        //PHP MAILER:
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'Confirmá tu cuenta';


        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p> <strong> Hola, " . $this->nombre . ". </strong> Creaste tu cuenta en nuestra aplicación! Podés confirmarla presionando en el siguiente enlace: </p>";
        $contenido .= "<p> Presioná acá: <a href='" .$_ENV['APP_URL']. "/confirmar-cuenta?token=" . $this->token  . "'>Confirmar mi cuenta</a> </p>";
        $contenido .= "<p> Si no solicitaste este correo, ignorá el mensaje. </p>";
        $contenido .= '</html>';

        $mail->Body = $contenido;
        $mail->AltBody = 'Texto alternativo';

        //enviar
        $mail->send();
    }


    public function recuperarPass() {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'Reestablecer mi contraseña';


        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p> <strong> Hola, " . $this->nombre . ". </strong> Solicitaste reestablecer tu contraseña, para hacerlo, presioná en el siguiente enlace: <br> </p>";
        $contenido .= "<p> Presioná acá: <a href='" .$_ENV['APP_URL']. "/recuperar?token=" . $this->token  . "'>Reestablecer</a> </p>";
        $contenido .= "<p> Si no solicitaste este correo, ignorá el mensaje. </p>";
        $contenido .= '</html>';

        $mail->Body = $contenido;
        $mail->AltBody = 'Texto alternativo';

        //enviar
        $mail->send();
    }

}

