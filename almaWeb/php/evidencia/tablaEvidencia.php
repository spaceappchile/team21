<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tablaAlarma
 *
 * @author kamaleon
 */
class tablaEvidencia{
     //put your code here
    private $data;
    
    public function __construct($arr_data=null) {
        if(is_array($arr_data) && count($arr_data)!=0){
            $this->data=$arr_data;
            echo self::generaTabla();
        }else{
            echo "<h2>No existen registros de sucesos ingresados</h3>";
        }
    }
    
    private function generaTabla(){
        $strHtml="<table class='grilla grilla-evidencia'>";
            $strHtml.="<tr class='cabecera'>";
                $strHtml.="<td>Tipo suceso</td>";
                $strHtml.="<td>Archivo</td>";
                $strHtml.="<td>Host</td>";
                $strHtml.="<td>Proceso</td>";
                $strHtml.="<td>Texto Descriptivo</td>";
                $strHtml.="<td>Fecha</td>";
                $strHtml.="<td>Id alarma</td>";
                for($i=0; $i<count($this->data); $i++){
                    $strHtml.="<tr>";
                        $strHtml.="<td>".$this->data[$i][0]."</td>";
                        $strHtml.="<td>".$this->data[$i][1]."</td>";
                        $strHtml.="<td>".$this->data[$i][2]."</td>";
                        $strHtml.="<td>".$this->data[$i][3]."</td>";
                        $strHtml.="<td>".$this->data[$i][4]."</td>";
                        $strHtml.="<td>".$this->data[$i][5]."</td>";
                        $strHtml.="<td>".$this->data[$i][6]."</td>";
                    $strHtml.="</tr>";
                }
            $strHtml.="</tr>";
        $strHtml.="</html>";
        return $strHtml;
    }
}

?>
