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
        $this->carrito = new Carrito();
    }
    
    function getModel() {
        return $this->model;
    }
    
    function getSession() {
        return $this->sesion;
    }
    
    function getCarrito() {
        return $this->carrito;
    }
    

    /* acciones */
    
    function isAdministrator() {
        return $this->getSession()->isLogged() && $this->getSession()->isAdmin();
    }
    
    

}