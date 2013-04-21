<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of suceso
 *
 * @author kamaleon
 */
class Suceso {
    private $tipo;
    private $archivo;
    private $host;
    private $proceso;
    private $texto;

    function __construct($tipo, $archivo, $host, $proceso, $texto) {
        $this->tipo = $tipo;
        $this->archivo = $archivo;
        $this->host = $host;
        $this->proceso = $proceso;
        $this->texto = $texto;
    }
    
    public function getTipo() {
        return $this->tipo;
    }

    public function getArchivo() {
        return $this->archivo;
    }

    public function getHost() {
        return $this->host;
    }

    public function getProceso() {
        return $this->proceso;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setArchivo($archivo) {
        $this->archivo = $archivo;
    }

    public function setHost($host) {
        $this->host = $host;
    }

    public function setProceso($proceso) {
        $this->proceso = $proceso;
    }

    public function setTexto($texto) {
        $this->texto = $texto;
    }

}

?>
