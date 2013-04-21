<?php
include_once("./tablaSucesos.php");
include_once("./suceso.php");
include_once("./sqlSucesos.php");
include_once("../core/CoreBd.php");
$acc=$_GET["acc"];

if($acc=="muestra_tabla"){
    $cons=new sqlSucesos();
    $arr_data=$cons->consultaTablaSucesos();
    new tablaSucesos($arr_data);
}

if($acc=="guarda_suceso"){
    $suc=new Suceso($_POST["tipo"], $_POST["archivo"], $_POST["host"], $_POST["proceso"], $_POST["texto"]);
    $cons=new sqlSucesos();
    if($cons->insertaSucesos($suc)){
        $arr_data=$cons->consultaTablaSucesos();
        new tablaSucesos($arr_data);
    }else{
        $arr_data=$cons->consultaTablaSucesos();
        new tablaSucesos($arr_data);
    }
}
?>
