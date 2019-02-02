<?php

namespace izv\controller;

use izv\app\App;
use izv\data\Usuario;
use izv\model\Model;
use izv\tools\Reader;
use izv\tools\Session;
use izv\tools\Util;

class RegisterController extends UserController {

    function __construct(Model $model) {
        parent::__construct($model);
        //...
    }
    
    function defaultAction() {
        if($this->getSession()->isLogged()) {
            header('Location: ' . App::BASE );
            exit();
        } else {
            $this->getModel()->set('twigFile', 'register_page.html');
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

    
    function doregister() {
        //1º control de sesión
        if($this->getSession()->isLogged()) {
            //5º producir resultado -> redirección
            header('Location: ' . App::BASE . 'register');
            exit();
        }

        //2º lectura de datos
        $usuario = Reader::readObject('izv\data\Usuario');
        $clave2 = Reader::read('clave2');

        //3º validación de datos
        if($usuario->getClave() !== $clave2 ||
            mb_strlen($usuario->getClave()) < 4) {
            //5º producir resultado -> redirección
            header('Location: ' . App::BASE . 'register');
            exit();
        }
        if (!filter_var($usuario->getCorreo(), FILTER_VALIDATE_EMAIL)) {
            //5º producir resultado -> redirección
            header('Location: ' . App::BASE . 'register');
            exit();
        }

        //4º usar el modelo
        $usuario->setClave(Util::encriptar($usuario->getClave()));
        $r = $this->getModel()->register($usuario);

        //5º producir resultado -> redirección
        header('Location: ' . App::BASE . 'index?op=register&r=' . $r);
        exit();
    }
    
    
    
    //Permissions
    /*
    private function isAdministrator() {
        return $this->getSession()->isLogged() && $this->getSession()->isAdmin();
    }*/
}