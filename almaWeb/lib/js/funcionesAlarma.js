/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    $(".ico_lupa").click(function(){
        alert($(this).id);
    });
    
    $.get("./php/alarma/controller.php", {"acc":"muestra_tabla"}, function(data){
        $("#tabla-alarmas").html(data);
    });
});

function revisaDetalle(id){
    $.get("./php/evidencia/controller.php", {"acc":"muestra_tabla", "id_alarma":id}, function(data){
        $("#detalle_"+id).html(data);
        $("#detalle_"+id).toggle(200);
    });
}
