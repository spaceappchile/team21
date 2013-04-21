<?php
include_once("./tablaAlarma.php");
include_once("./sqlAlarma.php");
include_once("../core/CoreBd.php");

$acc=$_GET["acc"];

if($acc=="muestra_tabla"){
    $cons=new sqlAlarma();
    $arr_data=$cons->consultaTablaAlarma();
    new tablaAlarma($arr_data);
}
?>
