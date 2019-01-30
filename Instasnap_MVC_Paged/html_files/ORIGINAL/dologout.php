<?php

/* SHOULD WORK */

use izv\app\App;
use izv\tools\Session;
use izv\tools\Util;

error_reporting(E_ALL);

require './classes/autoload.php';

/*
$correo = Reader::read('correo');
$clave = Reader::read('clave');


$db = new Database();
$manager = new ManageUsuario($db);
$result = $manager->login($correo, $clave);
$resultado = 0;
*/
$sesion = new Session(App::SESSION_NAME);

$sesion->logout();
$url = Util::url() . 'login.php' . $resultado;
header('Location: ' . $url);

