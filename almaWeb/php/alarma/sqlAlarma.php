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
class sqlAlarma {
    //put your code here
    private $sql;
    
    public function __construct(){
        //__construct($host="", $user="", $password="", $baseDatos=""){
        $this->sql=new CoreBd("localhost", "root", "", "almaIni");
    }
    
    public function consultaTablaAlarma(){
        $sql="SELECT a.id_alarma, a.tipo, a.archivo, a.host, a.proceso, a.texto, b.descripcion
            from alarma a inner join estado_alarma b on (a.estado_alarma=b.id_estado)";
        return $this->sql->consultaSeleccionNum($sql);
    }
    
    
}

?>
