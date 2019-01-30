<?php

namespace izv\model;

use izv\data\Usuario;
use izv\data\Photo;
use izv\tools\Util;
use izv\tools\Pagination;
use izv\database\Database;
use izv\managedata\ManageUsuario;
use izv\managedata\ManagePhoto;

class AdminModel extends UserModel {

    
    function getUsersFiltered($pagina = 1, $orden = 'alias', $filtro = null) {
        $total = $this->getTotalUsers();
        $paginacion = new Pagination($total, $pagina);
        $offset = $paginacion->offset();
        $rpp = $paginacion->rpp();
        
        $parametros = array(
            'offset' => array($offset, \PDO::PARAM_INT),
            'rpp' => array($rpp, \PDO::PARAM_INT)
        );
        
        //DO QUERIES AND ALL FROM HERE
        
        if($filtro === null || $filtro == '') {
            $sql = 'select * from app_usuario order by '. $orden .' limit :offset, :rpp';
        } else {
            $sql = 'select * from app_usuario where
                    id like :filtro or
                    correo like :filtro or
                    alias like :filtro or
                    nombre like :filtro or
                    clave like :filtro or
                    activo like :filtro or
                    administrador like :filtro or
                    fechaalta like :filtro
                    order by '. $orden .'
                    limit :offset, :rpp';
            $parametros['filtro'] = '%' . $filtro . '%';
        }
        
        $array = [];
        if($this->getDatabase()->connect()) {
            if($this->getDatabase()->execute($sql, $parametros)) {
                while($fila = $this->getDatabase()->getSentence()->fetch()) {
                    $objeto = new Usuario();
                    $objeto->set($fila);
                    $array[] = $objeto;
                }
            }
        }
        
        $enlaces = $paginacion->values();
        return array(
            'paginas' => $enlaces,
            'arrusers' => $array,
            'rango' => $paginacion->range(5),
            'orden' => $orden,
            'filtro' => $filtro
        );
    }
    
    function getPhotosFiltered($pagina = 1, $orden = 'uploadtime', $filtro = null) {
        $total = $this->getTotalPhotos();
        $paginacion = new Pagination($total, $pagina);
        $offset = $paginacion->offset();
        $rpp = $paginacion->rpp();
        
        $parametros = array(
            'offset' => array($offset, \PDO::PARAM_INT),
            'rpp' => array($rpp, \PDO::PARAM_INT)
        );
        
        //DO QUERIES AND ALL FROM HERE
        
        if($filtro === null || $filtro == '') {
            $sql = 'select * from app_photo order by '. $orden .' limit :offset, :rpp';
        } else {
            $sql = 'select * from app_photo where
                    id like :filtro or
                    userid like :filtro or
                    or_filename like :filtro or
                    sto_filename like :filtro or
                    description like :filtro or
                    mime_type like :filtro or
                    visible like :filtro or
                    pinned like :filtro or
                    uploadtime like :filtro
                    order by '. $orden .'
                    limit :offset, :rpp';
            $parametros['filtro'] = '%' . $filtro . '%';
        }
        
        $array = [];
        if($this->getDatabase()->connect()) {
            if($this->getDatabase()->execute($sql, $parametros)) {
                while($fila = $this->getDatabase()->getSentence()->fetch()) {
                    $objeto = new Photo();
                    $objeto->set($fila);
                    $array[] = $objeto;
                }
            }
        }
        
        $enlaces = $paginacion->values();
        return array(
            'paginas' => $enlaces,
            'arrphotos' => $array,
            'rango' => $paginacion->range(5),
            'orden' => $orden,
            'filtro' => $filtro
        );
    }
    
    function getTotalUsers() {
        $users = 0;
        if($this->getDatabase()->connect()) {
            $sql = 'select count(*) from app_usuario;';
            if($this->getDatabase()->execute($sql)) {
                if($fila = $this->getDatabase()->getSentence()->fetch()) {
                    $users = $fila[0];
                }
            }
        }
        
        return $users;
    }
    
    function getTotalPhotos() {
        $users = 0;
        if($this->getDatabase()->connect()) {
            $sql = 'select count(*) from app_photo;';
            if($this->getDatabase()->execute($sql)) {
                if($fila = $this->getDatabase()->getSentence()->fetch()) {
                    $users = $fila[0];
                }
            }
        }
        return $users;
    }
    
    
    
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