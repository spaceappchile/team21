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
class sqlEvidencia {
    //put your code here
    private $sql;
    
    public function __construct(){
        //__construct($host="", $user="", $password="", $baseDatos=""){
        $this->sql=new CoreBd("localhost", "root", "", "almaIni");
    }
    
    public function consultaTablaEvidencia($id_alarma){
        $sql="select * from evidencia_alarma where id_alarma=".$id_alarma;
        return $this->sql->consultaSeleccionNum($sql);
    }
    
    
}

?>
