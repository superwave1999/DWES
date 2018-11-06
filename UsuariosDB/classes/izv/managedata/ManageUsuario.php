<?php

namespace izv\managedata;

use \izv\data\Usuario;
use \izv\database\Database;

class ManageUsuario {

    private $db;

    function __construct(Database $db) {
        $this->db = $db;
    }

    //Add I THINK OK
    function add(Usuario $usuario) {
        $resultado = 0;
        if($this->db->connect()) {
            $sql = 'insert into usuario values
                    (null, :correo, :alias, :nombre, :clave, :activo, :fechaalta)';
            $array = array(
                'correo' => $usuario->getCorreo(),
                'alias' => $usuario->getAlias(),
                'nombre' => $usuario->getNombre(),
                'clave' => $usuario->getClave(),
                'activo' => $usuario->getActivo(),
                'fechaalta' => $usuario->getFechaalta(),
            );
            if($this->db->execute($sql, $array)) {
                $resultado = $this->db->getConnection()->lastInsertId();
            }
        }
        return $resultado;
    }
    
    //Edit by ID OK
    function edit(Usuario $usuario) {
        $resultado = 0;
        if($this->db->connect()) {
            $sql = 
                'update usuario set
                correo = :correo,
                alias = :alias,
                nombre = :nombre,
                clave = :clave,
                activo = :activo,
                fechaalta = :fechaalta
                where id = :id';
                
            if($this->db->execute($sql, $usuario->get())) {
                $resultado = $this->db->getSentence()->rowCount();
            }
        }
        return $resultado;
    }
    
    
    //Get indiv by id OK
    function get($id) {
        $usuario = null;
        if($this->db->connect()) {
            $sql = 'select * from usuario where id = :id';
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
    
    
    //Get all by ID OK
    function getAll() {
        $array = array();
        if($this->db->connect()) {
            $sql = 'select * from usuario order by id';
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

    //Remove OK
    function remove($id) {
        $resultado = 0;
        if($this->db->connect()) {
            $sql = 'delete from usuario where id = :id';
            $prepValues = array('id' => $id);
            if($this->db->execute($sql, $prepValues)) {
                $resultado = $this->db->getSentence()->rowCount();
            }
        }
        return $resultado;
    }
}