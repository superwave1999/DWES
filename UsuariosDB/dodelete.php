<?php

use izv\data\Usuario;
use izv\database\Database;
use izv\managedata\ManageUsuario;
use izv\tools\Reader;
use izv\tools\Util;

require './classes/autoload.php';

$db = new Database();
$manager = new ManageUsuario($db);

$id = Reader::read('id');
$ids = Reader::readArray('ids');
$resultado = 0;

echo '<pre>' . var_export($id) . '</pre>';
echo '<pre>' . var_export($ids) . '</pre>';



if($id !== null) {
    if(!is_numeric($id) ||  $id <= 0) {
        header('Location: index.php');
        exit();
    }
    $resultado = $manager->remove($id);
} else {
    
    
    //$db->getConnection()->beginTransaction();
    $error = false;
    foreach($ids as $id) {
        $resultadoParcial = $manager->remove($id);
        if($resultadoParcial === 0) {
            $error = true;
        } else {
            $resultado += $resultadoParcial;
        }
    }
    /*
    if($error) {
        $db->getConnection()->rollback();
    } else {
        $db->getConnection()->commit();
    }*/
}
$db->close();
$url = Util::url() . 'index.php?op=deleteusuario&resultado=' . $resultado;
header('Location: ' . $url);