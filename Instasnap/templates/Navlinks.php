<?php
class Navlinks {
    
    static function getTitleRoot() {
        return $home = array('href' => 'index.php', 'caption' => 'Instasnap');
    }
    
    static function getTitleSub() {
        return $home = array('href' => '../index.php', 'caption' => 'Instasnap');
    }
    
    static function getLinksRoot() {
        $lista = array();
        $item = array('href' => './newpost/', 'caption' => 'New post');
        $lista[] = $item;
        $item = array('href' => './user/', 'caption' => 'Profile');
        $lista[] = $item;
        $item = array('href' => './dologout.php', 'caption' => 'Logout');
        $lista[] = $item;
        
        return $lista;
    }
    
    static function getLinksSub() {
        $lista = array();
        $item = array('href' => '../newpost/', 'caption' => 'New post');
        $lista[] = $item;
        $item = array('href' => '../user/', 'caption' => 'Profile');
        $lista[] = $item;
        $item = array('href' => '../dologout.php', 'caption' => 'Logout');
        $lista[] = $item;
        
        return $lista;
    }
    
    static function getAdminLinksRoot() {
        $lista = array();
        $item = array('href' => './admin_users/', 'caption' => 'User admin');
        $lista[] = $item;
        $item = array('href' => './admin_photos/', 'caption' => 'Post admin');
        $lista[] = $item;
        $item = array('href' => './phpmyadmin', 'caption' => 'phpmyadmin');
        $lista[] = $item;
        
        return $lista;
        
        
    }
    
    static function getAdminLinksSub() {
        $lista = array();
        $item = array('href' => '../admin_users/', 'caption' => 'User admin');
        $lista[] = $item;
        $item = array('href' => '../admin_photos/', 'caption' => 'Post admin');
        $lista[] = $item;
        $item = array('href' => '../phpmyadmin', 'caption' => 'phpmyadmin');
        $lista[] = $item;
        
        return $lista;
        
        
    }
    
}