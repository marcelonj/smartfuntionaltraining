<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
include "./correo.php";

/* Carga de variables de entorno */
$dotenv = Dotenv\Dotenv::createImmutable('./');
$dotenv->load();

/* Variables */
$mail_remitente= $_POST["mail"];
$nombre = $_POST["nombre"];
$comentario = $_POST['mensaje'];
$seleccion = $_POST['seleccion'];
$mensaje= email_personalizado($nombre);
$mensajeDatos = "Nombre: ".$nombre."<br>\nCorreo: ".$mail_remitente."<br>\nMotivo de consulta: ".set_selection()."<br>\nMensaje: ".$comentario;

function set_selection(){
  GLOBAL $seleccion;
  switch ($seleccion) {
    case '1':
        $seleccion = "Plan online";
        break;
    
    case '2':
        $seleccion = "Plan híbrido";
        break;

    case '3':
        $seleccion = "Plan presencial";
        break;

    case '4':
        $seleccion = "Coaching ontológico";
        break;
    
    case '5':
        $seleccion = "Coaching deportivo";
        break;

    case '0':
        $seleccion = "Otras conultas";
        break;

    default:
        echo "Ocurrio un error";
        die();
        break;
};
  return $seleccion;
}

function enviar_mail($mailProtocol, $mailHost, $mailPort, $mailUsername, $mailPass, $mailRemitente, $nombre, $mensaje, $asunto){
  $mail = new PHPMailer(true);
  $mail->CharSet = 'UTF-8';
  $mail->isSMTP();
  $mail->SMTPDebug=0;
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = $mailProtocol;
  $mail->Host=$mailHost;
  $mail->Port = $mailPort;
  $mail->Username = $mailUsername;
  $mail->Password = $mailPass;
  $mail->SetFrom($mailUsername, 'Smart Funtional Training');
  $mail->Subject = $asunto;
  $mail->MsgHTML($mensaje);
  $mail->AddAddress($mailRemitente, $nombre);

  return $mail;
};

$mail = enviar_mail($_ENV["MAIL_PROTOCOL"], $_ENV["MAIL_HOST"], $_ENV["MAIL_PORT"], $_ENV["MAIL_USERNAME"], $_ENV["MAIL_PASSWORD"], $mail_remitente, $nombre, $mensaje, "Gracias por ponerte en contaco");
$mail2= enviar_mail($_ENV["MAIL_PROTOCOL"], $_ENV["MAIL_HOST"], $_ENV["MAIL_PORT"], $_ENV["MAIL_USERNAME"], $_ENV["MAIL_PASSWORD"], $_ENV["MAIL_USERNAME"], "landing page", $mensajeDatos, "Contacto desde landing page");

if(!$mail->Send() or !$mail2->Send()) {
echo "Error al enviar: " . $mail->ErrorInfo;
die();
} else {
echo '<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mensaje enviado</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <div class="container d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="card d-flex flex-column align-items-center justify-content-between" style="width: 18rem;">
            <!-- <img src="..." class="card-img-top" alt="..."> -->
            <i class="bi bi-envelope-check" style="font-size: 10rem; color: rgb(80, 212, 80);"></i>
            <div class="card-body">
              <h5 class="card-title">Mensaje enviado</h5>
              <p class="card-text">Tu mensaje fue enviado, nos estaremos poniendo en contacto contigo pronto!</p>
              <a href="index.html" class="btn btn-success">Volver atras</a>
            </div>
          </div>
    </div>
  </body>
</html>';
}
?>