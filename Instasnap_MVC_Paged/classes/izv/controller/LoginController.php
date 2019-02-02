<?php

namespace izv\controller;

use izv\app\App;
use izv\data\Usuario;
use izv\model\Model;
use izv\tools\Reader;
use izv\tools\Session;
use izv\tools\Util;

class LoginController extends UserController {

    function __construct(Model $model) {
        parent::__construct($model);
        //...
    }
    
    /*
    function defaultAction() {
        if($this->getSession()->isLogged()) {
            $this->getModel()->set('twigFile', 'dashboard_page.html');
            $this->getModel()->set('user', $this->getSession()->getLogin()->getCorreo());
            if($this->isAdministrator()) {
                $this->getModel()->set('administrador', true);
            }
        } else {
            //5º producir resultado
            $this->getModel()->set('twigFile', 'login_page.html');
        }
    }*/
    
    function defaultAction() {
        if($this->getSession()->isLogged()) {
            header('Location: ' . App::BASE );
            exit();
        } else {
            $this->getModel()->set('twigFile', 'login_page.html');
        }
    }

    /*
    proceso general:
    1º control de sesión
    2º lectura de datos
    3º validación de datos
    4º usar el modelo
    5º producir resultado (para la vista)
    */
    

    //Login / Logout
    
    function dologin() {
        //1º control de sesión
        if($this->getSession()->isLogged()) {
            //5º producir resultado -> redirección
            header('Location: ' . App::BASE);
            exit();
        }
        
        //2º lectura de datos
        $usuario = Reader::readObject('izv\data\Usuario');
        
        //4º usar el modelo
        $r = $this->getModel()->login($usuario);

        if($r !== false) {
            $this->getSession()->login($r);
            $r = 1;
        } else {
            $r = 0;
        }
        
        //5º producir resultado -> redirección
        header('Location: ' . App::BASE . 'index?op=login&r=' . $r);
        exit();
    }

    function dologout() {
        $this->getSession()->logout();
        header('Location: ' . App::BASE);
        exit();
    }
    
}