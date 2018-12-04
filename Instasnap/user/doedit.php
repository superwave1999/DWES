<?php

use izv\data\Usuario;
use izv\database\Database;
use izv\managedata\ManageUsuario;
use izv\tools\Reader;
use izv\tools\Util;
use izv\tools\Session;
use izv\app\App;

require '../classes/autoload.php';

//Protection
$sesion = new Session(App::SESSION_NAME);
$adminuser = $sesion->getLogin()->getAdministrador();

if(!$sesion->isLogged()) {
    header('Location: ..');
    exit();
}









$db = new Database();
$manager = new ManageUsuario($db);
$usuario = Reader::readObject('izv\data\Usuario');

var_export($usuario);



$usuario->setAdministrador(Util::checkboxToMySQL($usuario->getAdministrador()));
$usuario->setActivo(Util::checkboxToMySQL($usuario->getActivo()));


if($usuario->getClave()==='') {
    $resultado = $manager->edit($usuario);
} else {
    
    $usuario->setClave(Util::encriptar($usuario->getClave()));
    $resultado = $manager->editWithPassword($usuario);
}

$db->close();

$url = Util::url() . 'index.php?op=edit&resultado=' . $resultado;
header('Location: ' . $url);