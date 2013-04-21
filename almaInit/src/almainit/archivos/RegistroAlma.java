/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package almainit.archivos;

import java.util.Date;

/**
 *
 * @author kamaleon
 */
public class RegistroAlma {
    private String tipo;
    private String archivo;
    private String host;
    private String proceso;
    private String texto;
    private String fecha;
    private int idCarga;

    public RegistroAlma(String tipo, String archivo, String host, String proceso, String texto, String fecha, int idCarga) {
        this.tipo = tipo;
        this.archivo = archivo;
        this.host = host;
        this.proceso = proceso;
        this.texto = texto;
        this.fecha = fecha;
        this.idCarga = idCarga;
    }

    public String getArchivo() {
        return archivo;
    }

    public String getFecha() {
        return fecha;
    }

    public String getHost() {
        return host;
    }

    public int getIdCarga() {
        return idCarga;
    }

    public String getProceso() {
        return proceso;
    }

    public String getTexto() {
        return texto;
    }

    public String getTipo() {
        return tipo;
    }

    public void setArchivo(String archivo) {
        this.archivo = archivo;
    }

    public void setFecha(String fecha) {
        this.fecha = fecha;
    }

    public void setHost(String host) {
        this.host = host;
    }

    public void setIdCarga(int idCarga) {
        this.idCarga = idCarga;
    }

    public void setProceso(String proceso) {
        this.proceso = proceso;
    }

    public void setTexto(String texto) {
        this.texto = texto;
    }

    public void setTipo(String tipo) {
        this.tipo = tipo;
    }
    
}
