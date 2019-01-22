<?php

/* Deprecated: newpost exitst*/

use izv\app\App;
use izv\data\Producto;
use izv\database\Database;
use izv\managedata\ManageProducto;
use izv\tools\Reader;
use izv\tools\Util;
use izv\tools\Session;

require '../classes/autoload.php';

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
$manager = new ManageProducto($db);
$producto = Reader::readObject('izv\data\Producto');
$resultado = $manager->add($producto);
$db->close();
$url = Util::url() . 'index.php?op=insertproducto&resultado=' . $resultado;
header('Location: ' . $url);