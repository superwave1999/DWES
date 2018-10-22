<?php

/*
Resumen de errores:
1 - no existe el archivo que se va a subir
2 - el tamaño del archivo excede el máximo, o el tipo no es válido
3 - ya existe un archivo con ese nombre
4 - ha fallado move_uploaded_file()
*/


class MultipleUpload {

    const FILESYSTEM_KEEP = 1;
    const FILESYSTEM_OVERWRITE = 2;
    const FILESYSTEM_RENAME = 3;
    const MIN_OWN_ERROR = 1000;
    
    const NO_ERR = 0;
    const ERROR_UP_FAIL = 1;
    const ERROR_INPUT_LARGE = 2;
    const ERROR_EXISTS = 3;
    const ERROR_FS_FAIL = 4;

    private $files;
    private $maxSize; 
    private $items;
    private $names;
    private $policy;
    private $savedNames;
    private $target;
    private $type;
            
    private $globalError;
    private $indivErrors;
    
    function logs() {
        echo '<br> Files ' . var_export($this->files,true) . '</br>';
        echo '<br> MAX SIZE ' . var_export($this->maxSize,true) . '</br>';
        echo '<br> Items ' . var_export($this->items,true) . '</br>';
        echo '<br> Names ' . var_export($this->names,true) . '</br>';
        echo '<br> Policy ' . var_export($this->policy,true) . '</br>';
        echo '<br> SavedNAmes ' . var_export($this->savedNames,true) . '</br>';
        echo '<br> Target Folder ' . var_export($this->target,true) . '</br>';
        echo '<br> Type ' . var_export($this->type,true) . '</br>';
        echo '<br> Global err ' . var_export($this->globalError,true) . '</br>';
        echo '<br> Individual err ' . var_export($this->indivErrors, true) . '</br>';
        
    }
            
            
    private function __initialise() {
        $this->globalError = self::NO_ERR;
        $this->indivErrors = array();
        
        $this->policy = self::FILESYSTEM_OVERWRITE;
        $this->type = '';
        $this->savedNames = array();
        $this->maxSize = 0; /*Unlimited max size*/
        $this->target  = './';
        
        
    }

    function __construct($input) {
        /*OK*/
        $this->__initialise();
            
        if (isset($_FILES[$input]) && $_FILES[$input]['name'] != '') {
            
            $this->files = $_FILES[$input];
            $this->names = $this->files['name'];
            $this->__checkArray();
            $this->indivErrors = $this->files['error'];
            
        } else {
            
            $this->globalError = self::ERROR_UP_FAIL;
            
        }
        
    }
    
    
    private function __checkArray() {
        
        if (is_array($this->files['name']) && count($this->files['name']) > 0){
            
            $this->names = $this->files['name'];
            $this->items = count($this->names);
            
        } else {
            
            $this->globalError = self::ERROR_INPUT_LARGE;
            
        }
        
    }
    
    
    // Gets and Sets LATER
    
    function getGlobalError() {
        return $this->globalError;
    }
    
    function getIndividualErrors() {
        return $this->indivErrors;

    }

    function getMaxSize() {
        return $this->maxSize;
    }
    
    function getName() {
        /*SHIT*/
        $nombre = $this->savedNames;
        if(count($nombre)===0) {
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
        /*SHIT*/
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
    
    
    
    //Checks
    
    private function __checkSize($index) {
        /*OK*/
        if ($this->maxSize === 0 || $this->maxSize >= $this->files['size'][$index]) {
            //0 se interpreta como que no hay maximo
            return true;
        }
        
        return false;
        
    }

    private function __checkType($index) {
        /*OK*/
        $status = true;
        
        if($this->type !== '') {
            
            $mimeType = shell_exec('file --mime ' . $this->files['tmp_name'][$index]);
            $position = strpos($mimeType, $this->type);
            
            if($position === false) {
                $status = false;
            }
            
        }
        
        return $status;
        
    }
    
    //Upload main stuff

    function upload() {
    /*OK*/
        $status = false;
        
        if($this->globalError === self::NO_ERR) {
            
            foreach ($this->files['name'] as $index=>$currentName) {
                
                if($this->indivErrors[$index] === self::NO_ERR && $this->__checkType($index) && $this->__checkSize($index)) {
                    
                    $status = $this->__doUpload($index);
                    
                } else {
                    
                    $this->indivErrors[$index] = self::ERROR_INPUT_LARGE;
                    
                }   
                
            }
           
        }
        $this->logs();
        return $status;
        
    }
    
    private function __doUpload($index) {
        /*OK*/
        
        $status = false;
        
        switch($this->policy) {
            case self::FILESYSTEM_KEEP:
                
                $status = $this->__doUploadKeep($index);
                
            break;
                
            case self::FILESYSTEM_OVERWRITE:
                
                $status = $this->__doUploadOverwrite($index);
            break;
                
            case self::FILESYSTEM_RENAME:
                
                $status = $this->__doUploadRename($index);
                
            break;
            
        }
        
        if(!$status && $this->error === self::NO_ERR){
            $this->indivErrors[$index] = self::ERROR_FS_FAIL;
        }
        
        return $status;
        
    }
    
    private function __doUploadKeep($index) {
        /*OK*/
        
        $status = false;
        
        $name=$this->__getFileName($index);
        
        if(file_exists($this->target .$name) === false ) {
            
            $status = move_uploaded_file($this->files['tmp_name'][$index], $this->target .$name);
            
        } else {
            
            $this->globalError = self::ERROR_EXISTS;
            
        }
        
        return $status;
        
    }
    
    private function __doUploadOverwrite($index) {
        /*OK*/
        $name = $this->__getFileName($index);
        
        return move_uploaded_file($this->files['tmp_name'][$index], $this->target . $name);
        
    }
    
    private function __doUploadRename($index) {
        /*OK*/
        
        $fileName = $this-> __getFileName($index);
        
        $fullPath = $this->target . $fileName;
        
        if(file_exists($fullPath)) {
            
            $fullPath = self::__nameIncrement($fullPath);
            
        }
        
        $status = move_uploaded_file($this->files['tmp_name'][$index], $fullPath);
        
        if($status) {
            $this->savedName[$index] = pathinfo($fullPath)['basename'];
        }
        
        return $status;
        
    }
    
    private function __getFileName($index){
        /*OK*/
        $name='';
        
        if(is_array($this->names)){
            $name=$this->names[$index];
        }else{
            $name=$this->names;
        }
        return $name;
    }
    
    private static function __nameIncrement($file) {
        /*OK*/

        $split = pathinfo($file);
        $extension = '';
        
        if(isset($split['extension'])) {
            $extension = '.' . $split['extension'];
        }
        
        $count = 0;
        while(file_exists($split['dirname'] . '/' . $split['filename'] . $count . $extension)) {
            $count++;
        }
        
        $newFile = $split['dirname'] . '/' . $split['filename'] . $count . $extension;

        return $newFile;
        
        
    }

}
