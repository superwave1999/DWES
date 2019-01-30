<?php

namespace izv\model;

use izv\data\Photo;
use izv\tools\Mail;
use izv\tools\Util;
use izv\database\Database;
use izv\managedata\ManagePhoto;

class PostModel extends Model {

    
    function uploadPhoto(Photo $photo) {
        $photomanager = new ManagePhoto($this->getDatabase());
        $result = $photomanager->add($photo);
        
        return $result;
        
    }
    
    function getPhoto($pid) {
        $manager = new ManagePhoto($this->getDatabase());
        $photo = $manager->get($pid);
        return $photo;
        
    }
    
    function editPhoto(Photo $photo) {
        $manager = new ManagePhoto($this->getDatabase());
        return $manager->edit($photo);
    }
    
}