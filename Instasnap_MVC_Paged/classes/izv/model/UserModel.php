<?php

namespace izv\model;

use izv\data\Usuario;
use izv\tools\Mail;
use izv\tools\Util;
use izv\database\Database;
use izv\managedata\ManagePhoto;
use izv\managedata\ManageUsuario;

class UserModel extends Model {

    
    function getAllPhotos() {
        $photomanager = new ManagePhoto($this->getDatabase());
        $photos = $photomanager->getAll();
        return $photos;
    }

    function login(Usuario $usuario) {
        $manager = new ManageUsuario($this->getDatabase());
        return $manager->login($usuario->getCorreo(), $usuario->getClave());
    }

    function register(Usuario $usuario) {
        $manager = new ManageUsuario($this->getDatabase());
        $r = $manager->add($usuario);
        if($r > 0) {
            $usuario->setId($r);
            Mail::sendActivation($usuario);
        }
        return $r;
    }
    
    function registerAsAdmin(Usuario $usuario) {
        $manager = new ManageUsuario($this->getDatabase());
        $r = $manager->add($usuario);
        if($r > 0) {
            $usuario->setId($r);
            Mail::sendActivationAdminAdd($usuario);
        }
        return $r;
    }
    
    function editUser(Usuario $usuario) {
        $manager = new ManageUsuario($this->getDatabase());
        
        if($usuario->getClave()==='') {
            $resultado = $manager->edit($usuario);
        } else {

            $usuario->setClave(Util::encriptar($usuario->getClave()));
            $resultado = $manager->editWithPassword($usuario);
        }
        
        return $resultado;
        
    }
    
    function getUser($id) {
        $usermanager = new ManageUsuario($this->getDatabase());
        return $usermanager -> get($id);
    }
    
    function getPhotos($id) {
        $photomanager = new ManagePhoto($this->getDatabase());
        return $photomanager -> getAllSingleUser($id);
    }
    
    function getAllOrOne($id = null) {
        $manager = new ManageUsuario($this->getDatabase());
        if($id === null) {
            return $manager->getAll();
        } else {
            return $manager->get($id);
        }
    }
    
}