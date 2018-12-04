<?php

use izv\app\App;
use izv\data\Photo;
use izv\database\Database;
use izv\managedata\ManagePhoto;
use izv\tools\Reader;
use izv\tools\Util;

require '../classes/autoload.php';

use izv\tools\Session;
$sesion = new Session(App::SESSION_NAME);
if(!$sesion->isLogged()) {
    header('Location: ..');
    exit();
}

$db = new Database();
$manager = new ManagePhoto($db);
$photo = Reader::readObject('izv\data\Photo');
$resultado = $manager->edit($photo);
$db->close();
$url = Util::url() . 'index.php?op=editproducto&resultado=' . $resultado;
header('Location: ' . $url);