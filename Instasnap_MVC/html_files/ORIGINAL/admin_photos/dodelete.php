<?php

require '../classes/autoload.php';

use izv\app\App;
use izv\data\Photo;
use izv\database\Database;
use izv\managedata\ManagePhoto;
use izv\tools\Reader;
use izv\tools\Util;
use izv\tools\Session;

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
$manager = new ManagePhoto($db);







$id = Reader::read('id');
$ids = Reader::readArray('ids');
$resultado = 0;
if($id !== null) {
    if(!is_numeric($id) ||  $id <= 0) {
        header('Location: index.php');
        exit();
    }
    
    $photo = $manager -> get($id);
    $uid = $photo -> getUserId();
    $filename = $photo ->getSto_Filename();
    
    $resultado = $manager->remove($id);
    Util::removeFile('../uploads/'.$uid.'/'.$filename);
} else {
    /*
    $theConnection = $db->getConnection();
    $theConnection->beginTransaction();
    */
    $error = false;
    foreach($ids as $id) {
        
        $photo = $manager -> get($id);
        $uid = $photo -> getUserId();
        $filename = $photo ->getSto_Filename();
        
        
        $resultadoParcial = $manager->remove($id);
        
        
        if($resultadoParcial === 0) {
            $error = true;
        } else {
            $resultado += $resultadoParcial;
            Util::removeFile('../uploads/'.$uid.'/'.$filename);
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