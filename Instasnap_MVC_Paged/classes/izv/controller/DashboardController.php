<?php

namespace izv\controller;

use izv\app\App;
use izv\data\Usuario;
use izv\model\Model;
use izv\tools\Reader;
use izv\tools\Session;
use izv\tools\Util;
use izv\tools\Navlinks;

class DashboardController extends Controller {

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
        if(!$this->getSession()->isLogged()) {
            header('Location: ' . App::BASE . 'login');
            exit();
        } else {
            
            // getAllPhotos()
            $allPhotos = $this->getModel()->getAllPhotos();
            
            //Check if user can edit the post
            $curruser = $this->getSession()->getLogin()->getId();
            $this->getModel()->set('currentuserid', $curruser);
        
            //Render photos        
            $this->getModel()->set('arrphotos', $allPhotos);
            
            //Render page
            $this->getModel()->set('twigFile', 'dashboard_page.html');
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
    
}