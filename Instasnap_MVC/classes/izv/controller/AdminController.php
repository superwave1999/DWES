<?php

namespace izv\controller;

use izv\app\App;
use izv\data\Usuario;
use izv\model\Model;
use izv\tools\Reader;
use izv\tools\Session;
use izv\tools\Util;
use izv\tools\Navlinks;

class AdminController extends Controller {

    function __construct(Model $model) {
        parent::__construct($model);
        //...
    }

    function defaultAction() {
        header('Location: ' . App::BASE . 'user/admin');
        exit();
    }
    
    function userpanel() {
        if(!$this->isAdministrator()) {
            header('Location: ' . App::BASE);
            exit();
        } else {
            
            // get users
            $allUsers = $this->getModel()->getAllOrOne();

            //Navbar
                $this->getModel()->set('lista', Navlinks::getLinksRoot());
                $this->getModel()->set('listaadm', Navlinks::getAdminLinksRoot());
                $this->getModel()->set('home', Navlinks::getTitleRoot());
            
            
            //Check if user can edit the post
            //$curruser = $this->getSession()->getLogin()->getId();
            //$this->getModel()->set('currentuserid', $curruser);
        
            
        
            //Render photos        
            $this->getModel()->set('arrusers', $allUsers);
            
            //Render page
            $this->getModel()->set('twigFile', 'admin_user_page.html');
        }
    }
    
    function userpanel_doadd() {
        //1º control de sesión
        if(!$this->isAdministrator()) {
            header('Location: ' . App::BASE);
            exit();
        }

        //2º lectura de datos
        $usuario = Reader::readObject('izv\data\Usuario');

        //3º validación de datos
        if(mb_strlen($usuario->getClave()) < 4) {
            //5º producir resultado -> redirección
            header('Location: ' . App::BASE.'admin/userpanel');
            exit();
        }
        if (!filter_var($usuario->getCorreo(), FILTER_VALIDATE_EMAIL)) {
            //5º producir resultado -> redirección
            header('Location: ' . App::BASE.'admin/userpanel');
            exit();
        }

        //4º usar el modelo
        $usuario->setClave(Util::encriptar($usuario->getClave()));
        $r = $this->getModel()->registerAsAdmin($usuario);

        //5º producir resultado -> redirección
        header('Location: ' . App::BASE.'admin/userpanel');
        exit();
    }
    
    function userpanel_add() {
        if(!$this->isAdministrator()) {
            header('Location: ' . App::BASE );
            exit();
        } else {
            $this->getModel()->set('twigFile', 'admin_useradd_page.html');
        }
    }
    
    function userpanel_edit() {
        if(!$this->isAdministrator()) {
            header('Location: ' . App::BASE );
            exit();
        } else {
            
            $id = Reader::read('id');
            if (!isset($id)) {
                header('Location: ' . App::BASE.'admin/userpanel');
                exit();
            }

            //User to edit
            $theUser = $this->getModel()->getAllOrOne($id);
            
            /*
                If the GET id isnt a database id, getAllOrOne
                will return an array of objects. Using function_exists
                I know if its immediately an object or an array of objects
            
            if(!function_exists($theUser->setActivo())) {
                header('Location: ' . App::BASE.'index');
                exit();
            };*/
            
            
            $theUser->setActivo(Util::mySQLToCheckbox($theUser->getActivo()));
            $theUser->setAdministrador(Util::mySQLToCheckbox($theUser->getAdministrador()));
            $theUser->setFechaalta(Util::getDateHourFromMySqlToEs($theUser->getFechaalta()));
            
            $this->getModel()->set('theuser', $theUser);
            $this->getModel()->set('twigFile', 'admin_useredit_page.html');
        }
    }
    
    function userpanel_doedit() {
        //1º control de sesión
        if(!$this->isAdministrator()) {
            header('Location: ' . App::BASE);
            exit();
        }

        //2º lectura de datos
        $usuario = Reader::readObject('izv\data\Usuario');
        $idtest = $usuario -> getId();
        $oldUser = $this->getModel()->getAllOrOne($idtest);
        
        $oldClave = Reader::read('claveAnterior');
        $oldRealClave = $oldUser -> getClave();
        
        
        $clave2 = Reader::read('clave2');

        if ($oldClave != null || $oldClave != '') {
                //3º validación de datos
            if($usuario->getClave() !== $clave2) {
                //5º producir resultado -> redirección
                header('Location: ' . App::BASE.'admin/userpanel');
                exit();
            }
            
            if (!Util::verificarClave($oldClave, $oldRealClave)) {
                header('Location: ' . App::BASE.'admin/userpanel');
                exit();
            }
    
            if (!filter_var($usuario->getCorreo(), FILTER_VALIDATE_EMAIL)) {
                //5º producir resultado -> redirección
                header('Location: ' . App::BASE.'admin/userpanel');
                exit();
            }
            
        }

        //4º usar el modelo
        $usuario->setActivo(Util::checkboxToMySQL($usuario->getActivo()));
        $usuario->setAdministrador(Util::checkboxToMySQL($usuario->getAdministrador()));
        $usuario->setFechaalta(Util::setDateHourToMySql($usuario->getFechaalta()));
        
        $r = $this->getModel()->editUser($usuario);

        //5º producir resultado -> redirección
        header('Location: ' . App::BASE.'admin/userpanel');
        exit();
    }
    
    function userpanel_dodelete() {
        if(!$this->isAdministrator()) {
            header('Location: ' . App::BASE.'admin/userpanel');
            exit();
        }
        
        $id = Reader::read('id');
        $ids = Reader::readArray('ids');
        $resultado = 0;
        if($id !== null) {
            if(!is_numeric($id) ||  $id <= 0) {
                header('Location: ' . App::BASE.'admin/userpanel');
                exit();
            }
            $resultado = $this->getModel()->deleteUser($id);
            
        } else {
            $resultado = $this->getModel()->deleteUser($ids);
            
        }
        
        header('Location: ' . App::BASE.'admin/userpanel');
        exit();
        
    }
    
    
    
    
    function photopanel() {
        if(!$this->isAdministrator()) {
            header('Location: ' . App::BASE);
            exit();
        } else {
            
            $photoid = Reader::read('userphotos');
            
            // get users
            $allPhotos = $this->getModel()->getAllOrOnePhotos($photoid);

            //Navbar
                $this->getModel()->set('lista', Navlinks::getLinksRoot());
                $this->getModel()->set('listaadm', Navlinks::getAdminLinksRoot());
                $this->getModel()->set('home', Navlinks::getTitleRoot());
            
            
            //Check if user can edit the post
            //$curruser = $this->getSession()->getLogin()->getId();
            //$this->getModel()->set('currentuserid', $curruser);
        
            //Render photos
            $this->getModel()->set('arrphotos', $allPhotos);
 
            //Render page
            $this->getModel()->set('twigFile', 'admin_photos_page.html');
        }
        
    }
    
    function photopanel_dodelete() {
        
        if(!$this->isAdministrator()) {
            header('Location: ' . App::BASE.'admin/photopanel');
            exit();
        }
        
        $id = Reader::read('id');
        $ids = Reader::readArray('ids');
        $resultado = 0;
        if($id !== null) {
            if(!is_numeric($id) ||  $id <= 0) {
                header('Location: ' . App::BASE.'admin/photopanel');
                exit();
            }
            $resultado = $this->getModel()->deletePhoto($id);
            
        } else {
            $resultado = $this->getModel()->deletePhoto($ids);
            
        }
        
        header('Location: ' . App::BASE.' admin/userpanel');
        exit();
        
    }

}