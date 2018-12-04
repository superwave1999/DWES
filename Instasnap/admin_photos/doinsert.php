<?php

/* Deprecated: newpost exitst*/

use izv\app\App;
use izv\data\Producto;
use izv\database\Database;
use izv\managedata\ManageProducto;
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
$manager = new ManageProducto($db);
$producto = Reader::readObject('izv\data\Producto');
$resultado = $manager->add($producto);
$db->close();
$url = Util::url() . 'index.php?op=insertproducto&resultado=' . $resultado;
header('Location: ' . $url);