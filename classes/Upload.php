<?php
class Upload {

    const FILESYSTEM_KEEP = 1;
    const FILESYSTEM_OVERWRITE = 2;
    const FILESYSTEM_RENAME = 3;
    const MIN_OWN_ERROR = 1000; /* Seems useless */
    
    const NO_ERR = 0;
    const ERROR_UP_FAIL = 1;
    const ERROR_INPUT_LARGE = 2;
    const ERROR_EXISTS = 3;
    const ERROR_FS_FAIL = 4;
    
    private $policy = self::FILESYSTEM_OVERWRITE;
    private $error = self::NO_ERR;
    private $file;
    private $input;
    private $maxSize = 0;
    private $name;
    private $savedName = '';
    private $target = './';
    private $type = '';

    function __construct($input) {
        $this->input = $input;
        if(isset($_FILES[$input]) && $_FILES[$input]['error'] === 0 && $_FILES[$input]['name'] != '') {
            $this->file = $_FILES[$input];
            $this->name = $this->file['name'];
        } else {
            //no file
            $this->error = self::NO_ERR;
        }
    }

    function getError() {
        $error = $this->error + self::MIN_OWN_ERROR;
        if($error === self::MIN_OWN_ERROR) {
            $error = $this->file['error'];
        }
        return $error;
    }
    
    function getMethodError() {
        
        
    }

    function getMaxSize() {
        return $this->maxSize;
    }
    
    function getName() {
        $nombre = $this->savedName;
        if($nombre === '') {
            $nombre = $this->name;
        }
        return $nombre;
    }

    function setMaxSize($size) {
        if(is_int($size) && $size > 0) {
            $this->maxSize = $size;
        }
        return $this;
    }

    function setName($name) {
        if(is_string($name) && trim($name) !== '') {
            $this->name = trim($name);
        }
        return $this;
    }

    function setPolicy($policy) {
        if(is_int($policy) && $policy >= self::FILESYSTEM_KEEP && $policy <= self::FILESYSTEM_RENAME) {
            $this->policy = $policy;
        }
        return $this;
    }

    function setTarget($target) {
        if(is_string($target) && trim($target) !== '') {
            $this->target = trim($target);
        }
        return $this;
    }

    function setType($type) {
        if(is_string($type) && trim($type) !== '') {
            $this->type = trim($type);
        }
        return $this;
    }

    function checkSize() {
        return ($this->maxSize === 0 || $this->maxSize >= $this->file['size']);
    }

    function checkType() {
        $status = true;
        if($this->type !== '') {
            $tipo = shell_exec('file --mime ' . $this->file['tmp_name']);
            $posicion = strpos($tipo, $this->type);
            if($posicion === false) {
                $status = false;
            }
        }
        return $status;
    }

    function upload() {
        $status = false;

        if($this->error !== self::ERROR_UP_FAIL) {
            if(($this->checkSize()) && ($this->checkType())) {
                $this->error = self::NO_ERR;
                $status = $this->__startUpload();
            } else {
                //Large
                $this->error = self::ERROR_INPUT_LARGE;
            }
        }

        return $status;
    }

    private function __startUpload() {
        $status = false;
        
        switch ($this->policy) {
            case self::FILESYSTEM_KEEP:
                $status = $this->__uploadKeepExisting();
            break;
            case self::FILESYSTEM_OVERWRITE:
                $status = $this->__uploadReplaceExisting();
            break;
            case self::FILESYSTEM_RENAME:
                $status = $this->__uploadIncrementNew();
            break;
        }
        
        if(!$status && $this->error === self::NO_ERR){
            $this->error = self::ERROR_FS_FAIL;
        }
        
        return $status;
    }
    
    private function __uploadKeepExisting() {
        $status = false;
        $fs_path = $this->target . $this->name;
        if(file_exists($fs_path) === false) {
            $status = move_uploaded_file($this->file['tmp_name'], $fs_path);
        } else {
            $this->error = self::ERROR_EXISTS;
        }
        return $status;
    }
    
    private function __uploadReplaceExisting() {
        $fs_path = $this->target . $this->name;
        return move_uploaded_file($this->file['tmp_name'], $fs_path);
    }
    
    private function __uploadIncrementNew() {
        $fs_path = $this->target . $this->name;
        if(file_exists($fs_path)) {
            $fs_path = self::__getNewName($fs_path);
        }
        $status = move_uploaded_file($this->file['tmp_name'], $fs_path);
        if($status) {
            $nombre = pathinfo($fs_path);
            $nombre = $nombre['basename'];
            $this->savedName = $nombre;
        }
        return $status;
    }
    
    private static function __getNewName($fs_path) {
        $fileparts = pathinfo($fs_path);
        $extension = '';
        
        if(isset($fileparts['extension'])) {
            $extension = '.' . $fileparts['extension'];
        }
       
        $count = 0;
        
        while(file_exists($fileparts['dirname'] . '/' . $fileparts['filename'] . $count . $extension)) {
            $count++;
        }
        
        return $fileparts['dirname'] . '/' . $fileparts['filename'] . $count . $extension;
    }


}
