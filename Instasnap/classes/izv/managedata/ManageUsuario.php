<?php

namespace izv\managedata;

use \izv\data\Usuario;
use \izv\database\Database;

class ManageUsuario {

    private $db;

    function __construct(Database $db) {
        $this->db = $db;
    }

    //id, correo, alias, nombre , clave, activo, fechaalta
    //:id, :correo, :alias, :nombre , :clave, :activo, :fechaalta
    function add(Usuario $usuario) {
        $resultado = 0;
        if($this->db->connect()) {
            $sql = 'insert into app_usuario values(:id, :correo, :alias, :nombre , :clave, :activo, :administrador, :fechaalta)';
            if($this->db->execute($sql, $usuario->get())) {
                $resultado = $this->db->getConnection()->lastInsertId();
            }
        }
        return $resultado;
    }

    function edit(Usuario $usuario) {
        $resultado = 0;
        if($this->db->connect()) {
            $sql = 'update app_usuario set correo = :correo, alias = :alias, nombre = :nombre , activo = :activo, administrador = :administrador where id = :id';
            $array = $usuario->get();
            unset($array['clave']);
            unset($array['fechaalta']);
            if($this->db->execute($sql, $array)) {
                $resultado = $this->db->getSentence()->rowCount();
            }
        }
        return $resultado;
    }

    function editWithPassword(Usuario $usuario) {
        $resultado = 0;
        if($this->db->connect()) {
            $sql = 'update app_usuario set correo = :correo, alias = :alias, nombre = :nombre , clave = :clave, activo = :activo, administrador = :administrador where id = :id';
            $array = $usuario->get();
            unset($array['fechaalta']);
            if($this->db->execute($sql, $array)) {
                $resultado = $this->db->getSentence()->rowCount();
            }
        }
        return $resultado;
    }
    
    function get($id) {
        $usuario = null;
        if($this->db->connect()) {
            $sql = 'select * from app_usuario where id = :id';
            $array = array('id' => $id);
            if($this->db->execute($sql, $array)) {
                if($fila = $this->db->getSentence()->fetch()) {
                    $usuario = new Usuario();
                    $usuario->set($fila);
                }
            }
        }
        return $usuario;
    }

    function getAll() {
        $array = array();
        if($this->db->connect()) {
            $sql = 'select * from app_usuario order by nombre';
            if($this->db->execute($sql)) {
                while($fila = $this->db->getSentence()->fetch()) {
                    $usuario = new Usuario();
                    $usuario->set($fila);
                    $array[] = $usuario;
                }
            }
        }
        return $array;
    }

    /**
     * 
     */
    function login($correo, $clave) {
        if($this->db->connect()) {
            $sql = 'select * from app_usuario where correo = :correo and activo = 1';
            $array = array('correo' => $correo);
            if($this->db->execute($sql, $array)) {
                if($fila = $this->db->getSentence()->fetch()) {
                    $usuario = new Usuario();
                    $usuario->set($fila);
                    $resultado = \izv\tools\Util::verificarClave($clave, $usuario->getClave());
                    if($resultado) {
                        $usuario->setClave('');
                        return $usuario;
                    }
                }
            }
        }
        return false;
    }
    
    function deactivate($id) {
        $resultado = 0;
        if($this->db->connect()) {
            $sql = 'update app_usuario set activo=0 where id = :id';
            $array = array('id' => $id);
            if($this->db->execute($sql, $array)) {
                $resultado = $this->db->getSentence()->rowCount();
            }
        }
        return $resultado;
    }
    
    function remove($id) {
        $resultado = 0;
        if($this->db->connect()) {
            $sql = 'delete from app_usuario where id = :id';
            $array = array('id' => $id);
            if($this->db->execute($sql, $array)) {
                $resultado = $this->db->getSentence()->rowCount();
            }
        }
        return $resultado;
    }
}