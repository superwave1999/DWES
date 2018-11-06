<?php

namespace izv\tools;

class Alert {
    
    private $operacion, $resultado;
    
    static private $mensajes = array(
        'insertproducto' => array(
            'No se ha podido insertar el usuario.',
            'El usuario se ha insertado correctamente.'
        ),
        'deleteproducto' => array(
            'No se ha podido borrar el usuario.',
            'El usuario se ha borrado correctamente.'
        ),
        'editproducto'   => array(
            'No se ha podido modificar el usuario.',
            'El usuario se ha modificado correctamente.'
        )
    );
    
    static private $clases = array('alert-danger', 'alert-success');
    
    function __construct($operacion, $resultado) {
        $this->operacion = $operacion;
        $this->resultado = $resultado;
    }
    
    function getAlert() {
        $string = '';
        if(isset(self::$mensajes[$this->operacion])) {
            $pos = 1;
            if($this->resultado <= 0) {
                $pos = 0;
            }
            $clase = self::$clases[$pos];
            $mensaje = self::$mensajes[$this->operacion][$pos];
            $string = '<div class="alert ' . $clase . '" role="alert">' . $mensaje . '</div>';
        }
        return $string;
    }
    
    static function getMessage($operacion, $resultado) {
        $alert = new Alert($operacion, $resultado);
        return $alert->getAlert();
    }
}