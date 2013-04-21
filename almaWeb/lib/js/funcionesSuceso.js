/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    $.get("./php/suceso/controller.php", {"acc":"muestra_tabla"}, function(data){
        $("#tabla-sucesos").html(data);
    });
    
    $("#id_duarda_suceso").click(function(){
        valTipo=$("#tipo").val();
        valArchivo=$("#archivo").val();
        valHost=$("#host").val();
        valProceso=$("#proceso").val();
        valTexto=$("#texto").val();
        error="";
        /*if(valTipo=="0" || valTipo==""){
            error+="Ingrese tipo de suceso\n";
        }

        if(valArchivo==""){
            error+="Ingrese Archivo del suceso\n";
        }
        if(valHost==""){
            error+="Ingrese host del suceso\n";
        }

        if(valProceso==""){
            error+="Ingrese proceso del suceso\n";
        }

        if(valTexto==""){
            error+="Ingrese texto del suceso\n";
        }*/
        if(error!=""){
            alert(error);
        }else{
            $.ajax({
                url:$("#frm_suceso").attr("action"),
                type:"POST",
                data:$("#frm_suceso").serialize()
            }).done(function(){
                $.get("./php/suceso/controller.php", {"acc":"muestra_tabla"}, function(data){
                    $("#tabla-sucesos").html(data);
                });
            });
        }
    });
});
