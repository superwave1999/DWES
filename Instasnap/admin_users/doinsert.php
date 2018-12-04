<?php

use izv\data\Usuario;
use izv\database\Database;
use izv\managedata\ManageUsuario;
use izv\tools\Mail;
use izv\tools\Reader;
use izv\tools\Util;
use izv\tools\Session;
use izv\app\App;

require '../classes/autoload.php';
require '../classes/vendor/autoload.php';

//Protection
$sesion = new Session(App::SESSION_NAME);
$adminuser = $sesion->getLogin()->getAdministrador();

if(!$sesion->isLogged() || $adminuser!=1) {
    header('Location: ..');
    exit();
}

$db = new Database();
$manager = new ManageUsuario($db);
$usuario = Reader::readObject('izv\data\Usuario');
if($usuario->getAlias() === '') {
    $usuario->setAlias(null);
}

if ($usuario->getActivo() === 0) {
    Mail::sendActivationAdminAdd($usuario);
}



$usuario->setClave(Util::encriptar($usuario->getClave()));
$resultado = $manager->add($usuario);
/*echo Util::varDump($db->getConnection()->errorInfo());
echo Util::varDump($db->getSentence()->errorInfo());*/
$db->close();
$url = Util::url() . 'index.php?op=insert&resultado=' . $resultado;
header('Location: ' . $url);