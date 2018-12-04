<?php

/*Photo . OK*/

namespace izv\data;

class Photo {
    
    use \izv\common\Common;

    private $id,
            $userid,
            $or_filename,
            $sto_filename,
            $description,
            $mime_type,
            $visible,
            $pinned,
            $uploadtime;
    
    function __construct($id = null, $uid = null, $ofn = null, $sfn = null, $desc = null, $mime = null, $vis = 0, $pin = 0, $ut = null) {
        $this->id = $id;
        $this->userid = $uid;
        $this->or_filename = $ofn;
        $this->sto_filename = $sfn;
        $this->description = $desc;
        $this->mime_type = $mime;
        $this->visible = $vis;
        $this->pinned = $pin;
        $this->uploadtime = $ut;
    }

    function getId () {
        return $this->id;
    }
    
    function getUserId () {
        return $this->userid;
    }
    
    function getOr_Filename () {
        return $this->or_filename;
    }
    
    function getSto_Filename () {
        return $this->sto_filename;
    }
    
    function getDescription () {
        return $this->description;
    }
    
    function getMime_Type () {
        return $this->mime_type;
    }
    
    function getVisible () {
        return $this->visible;
    }
    
    function getPinned () {
        return $this->pinned;
    }
    
    function getUploadTime() {
        return $this->uploadtime;
    }
    
    function setId ($var) {
        $this->id = $var;
    }
    
    function setUserId ($var) {
        $this->userid = $var;
    }
    
    function setOr_Filename ($var) {
        $this->or_filename = $var;
    }
    
    function setSto_Filename ($var) {
        $this->sto_filename = $var;
    }
    
    function setDescription ($var) {
        $this->description = $var;
    }
    
    function setMime_Type ($var) {
        $this->mime_type = $var;
    }
    
    function setVisible ($var) {
        $this->visible = $var;
    }
    
    function setPinned ($var) {
        $this->pinned = $var;
    }
    
    function setUploadTime($var) {
        $this->uploadtime = $var;
    }

}