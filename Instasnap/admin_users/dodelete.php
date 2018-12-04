<?php

/* Transaction not working */

use izv\data\Usuario;
use izv\database\Database;
use izv\managedata\ManageUsuario;
use izv\tools\Reader;
use izv\tools\Util;
use izv\tools\Session;
use izv\app\App;

require '../classes/autoload.php';

error_reporting(E_ALL);


//Protection
$sesion = new Session(App::SESSION_NAME);
$adminuser = $sesion->getLogin()->getAdministrador();

if(!$sesion->isLogged() || $adminuser!=1) {
    header('Location: ..');
    exit();
}

$db = new Database();
$manager = new ManageUsuario($db);



$id = Reader::read('id');
$ids = Reader::readArray('ids');
$resultado = 0;
if($id !== null) {
    if(!is_numeric($id) ||  $id <= 0) {
        header('Location: index.php');
        exit();
    }
    $resultado = $manager->remove($id);
    Util::removeDirectory('../uploads/'.$id);
} else {
    /*
    $theConnection = $db->getConnection();
    $theConnection->beginTransaction();
    */
    $error = false;
    foreach($ids as $id) {
        $resultadoParcial = $manager->remove($id);
        if($resultadoParcial === 0) {
            $error = true;
        } else {
            $resultado += $resultadoParcial;
            Util::removeDirectory('../uploads/'.$id);
        }
    }
    
    /*
    if($error) {
        $theConnection->rollback();
    } else {
        $theConnection->commit();
        
    }*/
}

$db->close();
$url = Util::url() . 'index.php?op=deleteproducto&resultado=' . $resultado;
header('Location: ' . $url);