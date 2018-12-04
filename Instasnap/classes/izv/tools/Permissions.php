<?php

namespace izv\tools;

class Permissions {
    
    function isAdmin() {
        
        
    }
    
    //Reader must be logged in
    function loggedIn(Session $sesion) {
        if(!$sesion->isLogged()) {
            return false;
        } else {
            return true;
        }
        
    }
    

}