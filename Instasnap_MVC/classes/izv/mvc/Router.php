<?php

namespace izv\mvc;

class Router {

    private $rutas, $ruta;
    
    function __construct($ruta) {
        $this->rutas = array(
            'login' => new Route('UserModel', 'LoginView' , 'LoginController'),
            'register' => new Route('UserModel', 'RegisterView' , 'RegisterController'),
            'dashboard' => new Route('UserModel', 'DashboardView' , 'DashboardController'),
            'admin' => new Route('AdminModel', 'AdminView' , 'AdminController'),
            'post' => new Route('PostModel', 'PostView' , 'PostController'),
            
            'user' => new Route('UserModel', 'ProfileView' , 'UserController'),

        );
        $this->ruta = $ruta;
    }

    function getRoute() {
        $ruta = $this->rutas['dashboard'];
        if(isset($this->rutas[$this->ruta])) {
            $ruta = $this->rutas[$this->ruta];
        }
        return $ruta;
    }
}