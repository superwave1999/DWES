<?php

use izv\app\App;
use izv\data\Photo;
use izv\database\Database;
use izv\managedata\ManagePhoto;
use izv\tools\Reader;
use izv\tools\Util;
use izv\tools\Upload;
use izv\tools\Session;

require '../classes/autoload.php';



$sesion = new Session(App::SESSION_NAME);
if(!$sesion->isLogged()) {
    header('Location: ..');
    exit();
}

$db = new Database();
$manager = new ManagePhoto($db);
$usuario = Reader::readObject('izv\data\Photo');



$usuario->setVisible(Util::checkboxToMySQL($usuario->getVisible()));
$usuario->setPinned(Util::checkboxToMySQL($usuario->getPinned()));

$resultado = $manager->edit($usuario);

//echo $resultado;
$db->close();
//$url = Util::url() . 'index.php?op=insertproducto&resultado=' . $resultado;
header('Location: javascript://history.go(-2)');