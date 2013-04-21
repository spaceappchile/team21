<?php
include_once("./tablaEvidencia.php");
include_once("./sqlEvidencia.php");
include_once("../core/CoreBd.php");

$acc=$_GET["acc"];

if($acc=="muestra_tabla"){
    $cons=new sqlEvidencia();
    $arr_data=$cons->consultaTablaEvidencia($_GET["id_alarma"]);
    new tablaEvidencia($arr_data);
}
?>
