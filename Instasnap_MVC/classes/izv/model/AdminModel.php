<?php

namespace izv\model;

use izv\data\Usuario;
use izv\tools\Util;
use izv\database\Database;
use izv\managedata\ManageUsuario;
use izv\managedata\ManagePhoto;

class AdminModel extends UserModel {
    
    function getAllOrOnePhotos($id = null) {
        $manager = new ManagePhoto($this->getDatabase());

        if($id === null) {
            return $manager->getAll();
        } else {
            return $manager->getAllSingleUser($id);
        }
    }
    
    function deleteUser($ids) {
        $manager = new ManageUsuario($this->getDatabase());
        
        //$resultado = $manager->remove($id);
        
        if(is_array($ids)) {
            
            $error = false;
            foreach($ids as $id) {
                $resultadoParcial = $manager->remove($id);
                if($resultadoParcial === 0) {
                    $error = true;
                } else {
                    $resultado += $resultadoParcial;
                    Util::removeDirectory('../uploads/'.$id);
                }
            }
            
        } else {
            $resultado = $manager->remove($ids);
            if ($resultado !== 0) {
                Util::removeDirectory('../uploads/'.$ids);
            }
        }
        
        return $resultado;
        
    }
    
    function deletePhoto($ids) {
        
        $manager = new ManagePhoto($this->getDatabase());
        //Add checks if id is null
        
        if(is_array($ids)) {
            $error = false;
            foreach($ids as $id) {
                if (is_numeric($id) && $id > 0) {
                    
                    $photo = $manager -> get($id);
                    $uid = $photo -> getUserId();
                    $filename = $photo ->getSto_Filename();
                    
                    $resultadoParcial = $manager->remove($id);
                    if($resultadoParcial === 0) {
                        $error = true;
                    } else {
                        $resultado += $resultadoParcial;
                        Util::removeFile('./uploads/'.$uid.'/'.$filename);
                    }
                }
                    
            }
            
        } else if (is_numeric($ids) && $ids > 0) {
            
            $photo = $manager -> get($ids);
            $uid = $photo -> getUserId();
            $filename = $photo ->getSto_Filename();
            
            $resultado = $manager->remove($ids);
            if ($resultado !== 0) {
               Util::removeFile('./uploads/'.$uid.'/'.$filename);
            }
        } else {
            return 0;
        }
        
        return $resultado;
        
    }
    
}