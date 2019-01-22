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

/*$userLogin = null;
$loggedUser = $sesion -> isLogged();*/
$adminUser = $sesion -> isAdmin();
/*
if($loggedUser) {
    $userLogin = $sesion->getLogin();
}*/

//Not logged
if (!$adminUser) {
  header('Location: index.php');
  exit();
}









$db = new Database();
$manager = new ManageUsuario($db);
$usuario = Reader::readObject('izv\data\Usuario');


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