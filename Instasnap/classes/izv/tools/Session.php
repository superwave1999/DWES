<?php

namespace izv\tools;

class Session {

    const USER = '__user';

    //constructor
    function __construct($name = null) {
        if (session_status() === PHP_SESSION_NONE) {
            if ($name !== null) {
                session_name($name);
            }
            session_start();
        }
    }
    
    //get
    function get($name) {
        $v = null;
        if(isset($_SESSION[$name])) {
            $v = $_SESSION[$name];
        }
        return $v;
    }
    
    //set
    function set($name, $value) {
        $_SESSION[$name] = $value;
        return $this;
    }
    
    //destroy
    function destroy() {
        session_destroy();
    }
    
    function getLogin() {
        return $this->get(self::USER);
    }
    
    //login
    function login(\izv\data\Usuario $user) {
        session_regenerate_id(true);
        return $this->set(self::USER, $user);
    }
    
    //logout
    function logout() {
        unset($_SESSION[self::USER]);
        return $this;
    }
    
    
    
    //Permission functions
    
    function isLogged() {
        return $this->getLogin() !== null;
    }
    
    function isAdmin() {
        $user = $this->getLogin();
        if ($user==null) {
            return false;
        }
        return $user -> getAdministrador() != 0;
    }
    
}