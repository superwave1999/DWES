<?php
require '../classes/autoload.php';
require '../classes/vendor/autoload.php';

use izv\tools\Session;

$sesion = new Session();

$origen = "damcurso1819@gmail.com";
$alias = "Curso DWES IZV";
$destino = "damcurso1819@gmail.com";
$asunto = "Prueba de correo";
$mensaje = "¿Llegará?";
$cliente = new Google_Client();


$cliente->setApplicationName('CorreoWeb');
$cliente->setClientId('718777178058-g981n09mmc5tn06fhka6ukbo3uso4tgi.apps.googleusercontent.com');
$cliente->setClientSecret('w7NwS6ukpKA8glU0JvbrsSVv');

$cliente->setAccessToken(file_get_contents('atoken.conf'));
if ($cliente->getAccessToken()) {
    $service = new Google_Service_Gmail($cliente);
    try {
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->CharSet = "UTF-8";
        $mail->From = $origen;
        $mail->FromName = $alias;
        $mail->AddAddress($destino);
        $mail->AddReplyTo($origen, $alias);
        $mail->Subject = $asunto;
        $mail->Body = $mensaje;
        $mail->preSend();
        $mime = $mail->getSentMIMEMessage();
        $mime = rtrim(strtr(base64_encode($mime), '+/', '-_'), '=');
        $mensaje = new Google_Service_Gmail_Message();
        $mensaje->setRaw($mime);
        $service->users_messages->send('me', $mensaje);
        echo "Correo enviado correctamente";
    } catch (Exception $e) {
        echo ("Error en el envío del correo: " . $e->getMessage());
    }
} else {
    echo "No conectado con gmail";
}