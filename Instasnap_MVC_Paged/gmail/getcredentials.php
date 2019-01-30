<?php
session_start();
require_once '../classes/vendor/autoload.php';
$cliente = new Google_Client();
$cliente->setApplicationName('SocialMailer');
$cliente->setClientId('269657292859-88df0agt4sumv2cpiqee0dpn5hpeldu5.apps.googleusercontent.com');
$cliente->setClientSecret('hsvRG0NfMIg1txJa-28P-IAZ');
$cliente->setRedirectUri('https://servidor-proyecto-superwave.c9users.io/gmail/getcredentials.php');
$cliente->setScopes('https://www.googleapis.com/auth/gmail.compose');
$cliente->setAccessType('offline');
if (isset($_GET['code'])) {
    $cliente->authenticate($_GET['code']);
    $_SESSION['token'] = $cliente->getAccessToken();
    $archivo = "mailtoken.conf";
    $fh = fopen($archivo, 'w') or die("error");
    fwrite($fh, json_encode($cliente->getAccessToken()));
    fclose($fh);
    header("Location: finalizartoken.php?code=" . $_GET['code']);
}