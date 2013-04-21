<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="http://localhost/almaWeb/lib/css/almaInit.css" type="text/css" rel="stylesheet">
        <script type="text/javascript" src="./lib/js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="./lib/js/funcionesSuceso.js"></script>
        <title>Ingreso de alertas</title>
    </head>
    <body>
        <div id="contenedor-global">
            <div class="cont-frm-suceso">
                <form id="frm_suceso" name="frm_suceso" method="post" action="./php/suceso/controller.php?acc=guarda_suceso">
                    <h2>Ingreso de suceso.</h2>
                    <div class="bloque-solo bloque-campo-frm">
                        <label for="tipo" class="bloque-hermano">Tipo de suceso</label>
                        <select name="tipo" id="tipo" class="input-chico bloque-hermano">
                            <option value="0">Seleccione..</option>
                            <option value="Debug">Debug</option>
                            <option value="Warning">Warning</option>
                            <option value="Info">Info</option>
                            <option value="Error">Error</option>
                        </select>
                    </div>
                    <div class="bloque-solo bloque-campo-frm">
                        <label for="archivo">Archivo</label>
                        <input type="text" name="archivo" id="archivo" class="input-chico bloque-hermano">
                    </div>
                    <div class="bloque-solo bloque-campo-frm">
                        <label for="host">Host</label>
                        <input type="text" name="host" id="host" class="input-chico bloque-hermano">
                    </div>
                    <div class="bloque-solo bloque-campo-frm">
                        <label for="proceso">Proceso</label>
                        <input type="text" name="proceso" id="proceso" class="input-chico bloque-hermano">
                    </div>
                    <div class="bloque-solo bloque-campo-frm">
                        <label for="texto">Texto descriptivo</label>
                        <textarea name="texto" id="texto" class="input-chico bloque-hermano"></textarea>
                    </div>
                    <div class="bloque-solo bloque-campo-frm">
                        <label for="id_guarda_suceso">&nbsp;</label>
                        <input type="button" value="Guardar" id="id_duarda_suceso">
                    </div>
                </form>
            </div>
            <div id="tabla-sucesos">
                
            </div>
        </div>
    </body>
</html>
