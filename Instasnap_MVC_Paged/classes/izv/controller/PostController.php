<?php

namespace izv\controller;

use izv\app\App;
use izv\data\Usuario;
use izv\model\Model;
use izv\tools\Reader;
use izv\tools\Session;
use izv\tools\Util;
use izv\tools\Upload;
use izv\tools\Navlinks;

class PostController extends Controller {

    function __construct(Model $model) {
        parent::__construct($model);
        $this->getModel()->set('lista', Navlinks::getLinksRoot());
        if ($this->isAdministrator()) {
                $this->getModel()->set('isadmin', true);
        }
        $this->getModel()->set('listaadm', Navlinks::getAdminLinksRoot());
        $this->getModel()->set('home', Navlinks::getTitleRoot());
    }
    
    function defaultAction() {
        $this->new();
    }
    
    function new() {
        if(!$this->getSession()->isLogged()) {
            header('Location: ' . App::BASE . 'login');
            exit();
        }
        
        $this->getModel()->set('twigFile', 'upload_page.html');
    }
    
    function doupload() {
        if(!$this->getSession()->isLogged()) {
            header('Location: ' . App::BASE . 'login');
            exit();
        }
        
        //Check SHOULD BE OK
        $userLogin = $this->getSession()->getLogin();
        $user = $userLogin;
        $userid = $user->getId();
        
        
        
        
        //SORT FROM HERE ON
        $upload = new Upload('uploadedphoto');
        
        $photo = Reader::readObject('izv\data\Photo');
        
        //Convert checkbox to 1 and 0
        $photo->setVisible(Util::checkboxToMySQL($photo->getVisible()));
        $photo->setPinned(Util::checkboxToMySQL($photo->getVisible()));
        
        //Photo user id
        $photo->setUserId($userid);
        
        //Upload time
        $nowsql = Util::setDateHourToMySql(date("Y-m-d H:i:s"));
        $photo->setUploadTime($nowsql);
        $nowfile = Util::setMySqlDateHourToFileFormat($nowsql);
        
        
        //Names and dirs to use commonly
        $storedfilename ='upload-'.$photo->getUserId().'-'.$nowfile;
        $targetdir = '/home/ubuntu/workspace/uploads/'.$photo->getUserId().'/';
        
        //Upload section
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
                $resultado = $this->getModel()->uploadPhoto($photo);
                
            } else {
                Util::removeFile($targetdir.$storedfilename);
            }
            
        }
        
        
        header('Location: ' . App::BASE);
        exit();
    }
    
    function edit() {
        if(!$this->getSession()->isLogged()) {
            header('Location: ' . App::BASE . 'login');
            exit();
        }
        
        $userLogin = $this->getSession()->getLogin();
        $thisuser = $userLogin;
        $isUploader = $thisuser->getId();
        $isAdmin = $thisuser->getAdministrador();
        
        $pid = Reader::read('pid');
        if($pid === null || !is_numeric($pid) ||  $pid <= 0) {
            header('Location: javascript://history.go(-1)');
            exit();
        }
        
        $photo = $this->getModel()->getPhoto($pid);
        if (!$isAdmin && $photo->getUserId() != $isUploader) {
            header('Location: javascript://history.go(-1)');
            exit();
        }
        
        $photo->setVisible(Util::mySQLToCheckbox($photo->getVisible()));
        $photo->setPinned(Util::mySQLToCheckbox($photo->getPinned()));
        $photo->setUploadTime(Util::setDateHourToMySql($photo->getUploadTime()));
        
        $this->getModel()->set('photo', $photo);
        $this->getModel()->set('twigFile', 'edit_photo.html');
    }
    
    function doedit() {
        if(!$this->getSession()->isLogged()) {
            header('Location: ' . App::BASE . 'login');
            exit();
        }
        
        $usuario = Reader::readObject('izv\data\Photo');

        $usuario->setVisible(Util::checkboxToMySQL($usuario->getVisible()));
        $usuario->setPinned(Util::checkboxToMySQL($usuario->getPinned()));
        $usuario->setUploadTime(Util::setDateHourToMySql($usuario->getUploadTime()));
        
        
        $this->getModel()->editPhoto($usuario);
        
        
        header('Location: ' . App::BASE);
        exit();
    }

    /*
    proceso general:
    1º control de sesión
    2º lectura de datos
    3º validación de datos
    4º usar el modelo
    5º producir resultado (para la vista)
    */
    
}