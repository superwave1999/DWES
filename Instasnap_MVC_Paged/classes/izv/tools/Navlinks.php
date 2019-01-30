<?php

namespace izv\tools;

use izv\app\App;

class Navlinks {
    
    static function getTitleRoot() {
        return $home = array('href' => App::BASE, 'caption' => 'Instasnap');
    }
    
    static function getTitleSub() {
        return $home = array('href' => App::BASE, 'caption' => 'Instasnap');
    }
    
    static function getLinksRoot() {
        $lista = array();
        $item = array('href' => 'post/new', 'caption' => 'New post');
        $lista[] = $item;
        $item = array('href' => 'user', 'caption' => 'Profile');
        $lista[] = $item;
        $item = array('href' => 'login/dologout', 'caption' => 'Logout');
        $lista[] = $item;
        
        return $lista;
    }
    
    static function getLinksSub() {
        $lista = array();
        $item = array('href' => 'post/new', 'caption' => 'New post');
        $lista[] = $item;
        $item = array('href' => 'user', 'caption' => 'Profile');
        $lista[] = $item;
        $item = array('href' => 'login/dologout', 'caption' => 'Logout');
        $lista[] = $item;
        
        return $lista;
    }
    
    static function getAdminLinksRoot() {
        $lista = array();
        $item = array('href' => 'admin/userpanel', 'caption' => 'User admin');
        $lista[] = $item;
        $item = array('href' => 'admin/photopanel', 'caption' => 'Post admin');
        $lista[] = $item;
        $item = array('href' => './phpmyadmin', 'caption' => 'phpmyadmin');
        $lista[] = $item;
        
        return $lista;
        
        
    }
    
    static function getAdminLinksSub() {
        $lista = array();
        $item = array('href' => 'admin/userpanel', 'caption' => 'User admin');
        $lista[] = $item;
        $item = array('href' => 'admin/photopanel', 'caption' => 'Post admin');
        $lista[] = $item;
        $item = array('href' => './phpmyadmin', 'caption' => 'phpmyadmin');
        $lista[] = $item;
        
        return $lista;
        
        
    }
    
}