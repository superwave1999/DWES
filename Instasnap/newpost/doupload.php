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

$userLogin = null;
$loggedUser = $sesion -> isLogged();
$adminUser = $sesion -> isAdmin();
if($loggedUser) {
    $userLogin = $sesion->getLogin();
}

//No login -> gtfo
if (!$loggedUser) {
  header('Location: ..');
  exit();
}

$user = $userLogin;
$userid = $user->getId();

/* MIX OF UPLOAD AND DATABASE.

UPLOAD savedname == sto_filename
DB or_filename == name
*/

$upload = new Upload('uploadedphoto');
$db = new Database();
$photomanager = new ManagePhoto($db);
$photo = Reader::readObject('izv\data\Photo');

//Convert checked to 1 and 0
if (null !== ($photo->getVisible())) {
    $photo -> setVisible(1);
} else {
    $photo -> setVisible(0);
}
if (null !== ($photo->getPinned())) {
    $photo -> setPinned(1);
} else {
    $photo -> setPinned(0);
}


$photo->setUserId($userid);


$nowsql = Util::setDateHourToMySql(date("Y-m-d H:i:s"));
$photo->setUploadTime($nowsql);
$nowfile = Util::setMySqlDateHourToFileFormat($nowsql);

//Names and dirs to use commonly
$storedfilename ='upload-'.$photo->getUserId().'-'.$nowfile;
$targetdir = '/home/ubuntu/workspace/uploads/'.$photo->getUserId().'/';

//Upload section done

$upload->setPolicy(2);

$photo->setOr_Filename($upload->getName());



$upload->setName($storedfilename);
$photo->setSto_Filename($storedfilename);

$upload->setTarget($targetdir);


$mime=null;

mkdir($targetdir, 0755, true);

if ($upload->upload()) {
    
    $mime = $upload->getUploadedtype();
    
    if ($mime != null) {
        
        $photo->setMime_Type($mime);
        $resultado = $photomanager->add($photo);
        
    } else {
        Util::removeFile($targetdir.$storedfilename);
    }
    
}

var_export($upload);
var_export($mime);
var_export($resultado);


//echo $resultado;
$db->close();
$url = Util::url() . '../index.php?op=insertproducto&resultado=' . $resultado;
header('Location: '.$url);