<?php

namespace izv\controller;

use izv\app\App;
use izv\model\Model;
use izv\tools\Session;

class Controller {

    /*
    proceso general:
    1º control de sesión
    2º lectura de datos
    3º validación de datos
    4º usar el modelo
    5º producir resultado (para la vista)
    */

    private $model;
    private $sesion;
    private $carrito;

    function __construct(Model $model) {
        $this->model = $model;
        $this->sesion = new Session(App::SESSION_NAME);
        $this->getModel()->set('urlbase', App::BASE);
    }
    
    function getModel() {
        return $this->model;
    }
    
    function getSession() {
        return $this->sesion;
    }

    /* acciones */
    
    function isAdministrator() {
        return $this->getSession()->isLogged() && $this->getSession()->isAdmin();
    }
    
    
    //Filter helper
    
    function go($base_redirect = null) {
        $path = array();
        //if (isset($_SERVER['REQUEST_URI'])) {
            $request_path = explode('?', $_SERVER['REQUEST_URI']);
            $vars = explode('&', $request_path[1]);
            
            $redirect = $this->accionPorDefecto;
            foreach ($vars as $var) {
                $t = explode('=', $var);
                if (isset($t[1]) && !$t[1] == '') {
                    $path[$t[0]] = $t[1];
                }
            }
            if($base_redirect == null) {
                if (!isset($path['redirect'])) {
                header('Location: ' . App::BASE . $this->accionPorDefecto);
                exit();
                }
                $redirect = $path['redirect'];
                unset($path['redirect']);
            } else {
                $redirect = $base_redirect;
            }
            //??????
            $redirect = $path['redirect'];
            unset($path['redirect']);
            $s = '';
            if (count($path) >= 1) {
                $s = '?';
                $i = 0;
                foreach($path as $key=> $value){   
                    if($i < (count($path)-1)) {
                        $s .= $key . '=' . $path[$key] . '&';
                    } else {
                        $s .= $key . '=' . $value;
                    }
                    $i++;
                }
            }
            
        //}
        //echo App::BASE . $this->accionPorDefecto . $s;
        //exit;
        header('Location: ' . App::BASE . $redirect . $s);
        exit();
    }
    

}