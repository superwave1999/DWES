<?php

use izv\data\Usuario;
use izv\database\Database;
use izv\managedata\ManageUsuario;
use izv\tools\Reader;
use izv\tools\Util;

require './classes/autoload.php';

$db = new Database();
$manager = new ManageUsuario($db);
$usuario = Reader::readObject('izv\data\Usuario');

if (null !== ($usuario->getActivo())) {
    $usuario -> setActivo(1);
} else {
    $usuario -> setActivo(0);
}


$resultado = $manager->edit($usuario);
$db->close();
$url = Util::url() . 'index.php?op=editusuario&resultado=' . $resultado;
header('Location: ' . $url);