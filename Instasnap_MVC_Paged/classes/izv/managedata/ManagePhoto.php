<?php

namespace izv\managedata;

use \izv\data\Photo;
use \izv\database\Database;

class ManagePhoto {

    private $db;

    function __construct(Database $db) {
        $this->db = $db;
    }

    function add(Photo $photo) {
        $resultado = 0;
        if($this->db->connect()) {
            $sql = 'insert into app_photo values(DEFAULT, :userid, :or_filename, :sto_filename, :description, :mime_type, :visible, :pinned, :uploadtime)';
            /*$array = array(  //Replace with get class like user
                'userid' => $photo->getUserId(), 
                'or_filename' => $photo->getOr_Filename(),
                'sto_filename' => $photo->getObservaciones()
            );*/
            
            $array = $photo->get();
            
            unset($array['id']);
            
            if($this->db->execute($sql, $array)) {
                $resultado = $this->db->getConnection()->lastInsertId();
            }
            /*
            if($this->db->execute($sql, $array)) {
                $resultado = $this->db->getConnection()->lastInsertId();
                $producto->setId($resultado);
            }
            */
            //Replace from array with... make the get in photo
            
            
        }
        return $resultado;
    }

    function edit(Photo $photo) {
        $resultado = 0;
        if($this->db->connect()) {
            $sql = 'update app_photo set userid=:userid, or_filename=:or_filename, sto_filename=:sto_filename, description=:description, mime_type=:mime_type, visible=:visible, pinned=:pinned, uploadtime=:uploadtime where id = :id';

            //$sql = 'update app_photo set nombre = :nombre, precio = :precio, observaciones = :observaciones where id = :id';
            if($this->db->execute($sql, $photo->get())) {
                $resultado = $this->db->getSentence()->rowCount();
            }
        }
        return $resultado;
    }

    function get($id) {
        $producto = null;
        if($this->db->connect()) {
            $sql = 'select * from app_photo where id = :id';
            $array = array('id' => $id);
            if($this->db->execute($sql, $array)) {
                if($fila = $this->db->getSentence()->fetch()) {
                    $producto = new Photo();
                    $producto->set($fila);
                }
            }
        }
        return $producto;
    }

    function getAll() {
        $array = array();
        if($this->db->connect()) {
            $sql = 'select * from app_photo order by uploadtime desc';
            if($this->db->execute($sql)) {
                while($fila = $this->db->getSentence()->fetch()) {
                    $producto = new Photo();
                    $producto->set($fila);
                    $array[] = $producto;
                }
            }
        }
        return $array;
    }

    function remove($id) {
        $resultado = 0;
        if($this->db->connect()) {
            $sql = 'delete from app_photo where id = :id';
            $array = array('id' => $id);
            if($this->db->execute($sql, $array)) {
                $resultado = $this->db->getSentence()->rowCount();
            }
        }
        return $resultado;
    }
    
    
    //Dashboard (only user) - sort by time NOT WORKING
    
    function getAllSingleUser($userid) {
        $array = array();
        if($this->db->connect()) {
            
            $sql = 'select * from app_photo where userid=:userid order by uploadtime asc';
            $array2 = array('userid' => $userid);
            
            if($this->db->execute($sql,$array2)) {
                while($fila = $this->db->getSentence()->fetch()) {
                    $producto = new Photo();
                    $producto->set($fila);
                    $array[] = $producto;
                }
            }
        }
        return $array;
    }
    
    
    
    
}