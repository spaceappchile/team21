<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sqlSucesos
 *
 * @author kamaleon
 */
class sqlSucesos {
    //put your code here
    private $sql;
    
    public function __construct(){
        //__construct($host="", $user="", $password="", $baseDatos=""){
        $this->sql=new CoreBd("localhost", "root", "", "almaIni");
    }
    
    public function consultaTablaSucesos(){
        $sql="SELECT a.tipo, a.archivo, a.host, a.proceso, a.texto
            from suceso a";
        return $this->sql->consultaSeleccionNum($sql);
    }
    
    public function insertaSucesos(Suceso $suc){
        $sql="insert into suceso (tipo, archivo, host, proceso, texto)
values ('".$this->sql->limpiaVariable($suc->getTipo())."', '".$this->sql->limpiaVariable($suc->getArchivo())."', 
    '".$this->sql->limpiaVariable($suc->getHost())."', '".$this->sql->limpiaVariable($suc->getProceso())."', 
        '".$this->sql->limpiaVariable($suc->getTexto())."')";
        return $this->sql->consultaSeleccionNum($sql);
    }
}

?>
