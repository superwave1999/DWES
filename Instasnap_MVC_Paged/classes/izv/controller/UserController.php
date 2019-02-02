<?php

namespace izv\controller;

use izv\app\App;
use izv\data\Usuario;
use izv\model\Model;
use izv\tools\Reader;
use izv\tools\Session;
use izv\tools\Util;
use izv\tools\Navlinks;

class UserController extends Controller {

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
        /*if(!$this->getSession()->isLogged()) {
            header('Location: ' . App::BASE . 'login');
            exit();
        } else {
            */

            //User permissions
            $sesion = $this->getSession();
            
            $userLogin = null;
            $loggedUser = $sesion -> isLogged();
            $adminUser = $sesion -> isAdmin();
            if($loggedUser) {
                $userLogin = $sesion->getLogin();
            }
            
            
            //Who is viewing
            $curruser = null;
            if (isset($userLogin)) {
                $curruser = $userLogin -> getId();
            }
            
            //If link has GET -read token
            if (Reader::get('uid') == null || Reader::get('uid') <= 0 || Reader::get('uid') == '' ) {
              $linkToken = null;
            } else {
              $linkToken = Reader::get('uid');
            }
            

            //No id and no login - index
            if ($linkToken==null && !$loggedUser) {
              header('Location: ' . App::BASE . 'login');
                exit();
            }
            
            //No uid but logged in - read loggeduser id
            if ($loggedUser && $linkToken==null) {
                $linkToken = $userLogin-> getId();
            }
            
            
            //Linktoken SHOULDNT be null by here
            if(!isset($linkToken)) {
                header('Location: ' . App::BASE . 'login');
                exit();
            }
            
            $useraccount = $this->getModel()->getUser($linkToken);
            $photos = $this->getModel()->getPhotos($linkToken);
            
            
            $enablebutton = null;
            $pageuser = $useraccount -> getId();
            if ($loggedUser && ($curruser==$pageuser || $adminUser)) {
              $enablebutton = true;
            }
            
            
            $useraccount->setFechaalta(Util::getDateHourFromMySqlToEs($useraccount->getFechaalta()));
            
            //Render photos
            $this->getModel()->set('enablebutton', $enablebutton);
            $this->getModel()->set('userphotos', $photos);
            $this->getModel()->set('useraccount', $useraccount);
            
        //}
    }

    
    function edit() {
        if(!$this->getSession()->isLogged()) {
            header('Location: ' . App::BASE . 'login');
            exit();
        } else {
            
            $sesion = $this->getSession();
            
            $userLogin = null;
            $loggedUser = $sesion -> isLogged();
            $adminUser = $sesion -> isAdmin();
            $linkToken = Reader::get('uid');
            $idOfUserToEdit = null;
            
            if($loggedUser) {
                $userLogin = $sesion->getLogin();
            }
            
            
            //Session of who accessed page.
            $curruser = null;
            if (isset($userLogin)) {
                $curruser = $userLogin -> getId();
            }
            
            
            
            //NEW: If is admin or the uid is the user, edit.
            
            
            if($adminUser || $curruser == $linkToken) {
                $idOfUserToEdit = $linkToken;
            } else {
                $idOfUserToEdit = null;
            }
            
            
            //If user is admin and has a tag, edit the tag. OK
            if ($adminUser && $linkToken != null && $linkToken > 0) {
                $idOfUserToEdit = $linkToken;
            }
            
            // If user is admin and no tag, edit the admin.
            if ($linkToken == null || $linkToken <= 0) {
                $idOfUserToEdit = $curruser;
            }
            
            
            //user to edit SHOULDNT be null by here
            if(!isset($idOfUserToEdit)) {
                header('Location: ' . App::BASE . 'user');
                exit();
            }
            
            $usuario = $this->getModel()->getUser($idOfUserToEdit);
            
            $usuario->setActivo(Util::mySQLToCheckbox($usuario->getActivo()));
            $usuario->setAdministrador(Util::mySQLToCheckbox($usuario->getAdministrador()));
            $usuario->setFechaalta(Util::getDateHourFromMySqlToEs($usuario->getFechaalta()));
            
        
            //Render OK
            $this->getModel()->set('useraccount', $usuario);
        
            $this->getModel()->set('twigFile', 'edit_page.html');
        
        }
    }
    
    function doedit() {
        if(!$this->getSession()->isLogged()) {
            header('Location: ' . App::BASE . 'login');
            exit();
        } else {
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
                header('Location: ' . App::BASE.'user');
                exit();
            }
            
            if (!Util::verificarClave($oldClave, $oldRealClave)) {
                header('Location: ' . App::BASE.'user');
                exit();
            }
    
            if (!filter_var($usuario->getCorreo(), FILTER_VALIDATE_EMAIL)) {
                //5º producir resultado -> redirección
                header('Location: ' . App::BASE.'user');
                exit();
            }
            
        }

        //4º usar el modelo
        $usuario->setActivo(Util::checkboxToMySQL($usuario->getActivo()));
        $usuario->setAdministrador(Util::checkboxToMySQL($usuario->getAdministrador()));
        $useraccount->setFechaalta(Util::setDateHourToMySql($useraccount->getFechaalta()));
        
        $r = $this->getModel()->editUser($usuario);

    
            //5º producir resultado -> redirección
            header('Location: ' . App::BASE.'user?uid='.$r);
            exit();
        
        }
    }
    
    
    
    
    function doactivate() {
        
        $id = Reader::read('id');
        $code = Reader::read('code');

        $sendedMail = \Firebase\JWT\JWT::decode($code, App::JWT_KEY, array('HS256'));
        
        $user = $this->getModel()->getAllOrOne($id);
        
        if($user !== null && $user->getCorreo() === $sendedMail) {
            $user->setActivo(1);
            $resultado = $this->getModel()->editUser($user);
        }
        
        
        header('Location: ' . App::BASE );
        exit();
        
    }
    
}