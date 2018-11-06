<?php

class Session {

    
    private $sessionStarted;
    private $loginKey;
    
    
    function __construct(string $sname, string $key = 'login') {
        
        if (!$this->sessionStarted) {
            session_name($sname);
            $this->sessionStarted = session_start();
            $this->loginKey = $key;
        }
        
    }
    
    function destroy() {
        session_destroy();
    }
    
    function get($key) {
        $result = null;
        if (isset($_SESSION[$key])){
            $result = $_SESSION[$key];
        }
        return $result;
    }
    
    function getStatus() {
        return $this->sessionStarted;
    }
    
    function set(string $key, string $keyvars) {
        session_regenerate_id(true);
        $_SESSION[$key] = $keyvars;
    }
    
    function setLogin(string $name) {
        $this->set($this->loginKey, $name);
    }
    
    function getLogin() {
        return $this->get($this->loginKey);
    }
    
    function logout() {
        unset($_SESSION[$this->loginKey]);
        
    }
    
}
