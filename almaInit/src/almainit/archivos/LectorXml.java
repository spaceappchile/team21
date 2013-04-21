/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package almainit.archivos;

import java.io.File;
import java.sql.*;
import java.text.SimpleDateFormat;
import java.util.Date;
import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;
import org.w3c.dom.Document;
import org.w3c.dom.NamedNodeMap;
import org.w3c.dom.Node;
import org.w3c.dom.NodeList;

/**
 *
 * @author Juan Zamorano
 * 
 */
public class LectorXml {
    String rutaXml;
    Document recursoXml;
    Connection conn;
    
    public LectorXml(String ruta){
        this.rutaXml=ruta;
        this.recursoXml=null;
        
        try{
            Class.forName("com.mysql.jdbc.Driver");
            this.conn=DriverManager.getConnection("jdbc:mysql://localhost/almaIni", "root", "");
        }catch(Exception ex){
            System.out.println("Problemas al conectar a la base de datos");
        }
        
        DocumentBuilderFactory factory = DocumentBuilderFactory.newInstance();
        try{
            DocumentBuilder builder = factory.newDocumentBuilder();
            this.recursoXml = builder.parse(new File(this.rutaXml));
            System.out.println("Lectura correcta");
        }catch(Exception e){
            System.out.println("Problemas en la apertura del archivo "+e.getMessage());
        }
    }
    
    public void lecturaArchivo(){
        Node nodoRaiz = this.recursoXml.getFirstChild();
        NodeList registros=nodoRaiz.getChildNodes();
        //inicio de registro de carga
        this.generaRegistroCarga();
        //rescatamos el valor de la carga
        int carga=this.idUltimaCarga();
        for(int i=3; i<registros.getLength(); i++){
            Node registro=registros.item(i);
            if(registro.getNodeName().equals("Warning") || registro.getNodeName().equals("Info") || registro.getNodeName().equals("Error") || registro.getNodeName().equals("Debug")){
                try{
                    NamedNodeMap atributos=registro.getAttributes();
                    //rescato el tipo de suceso
                    String tipo=registro.getNodeName();
                    //atributo archivo
                    Node archivo=atributos.getNamedItem("File");
                    String file=archivo.getNodeValue().replace("'", "\'");
                    //rescato host
                    Node Nhost=atributos.getNamedItem("Host");
                    String host=Nhost.getNodeValue().replace("'", "\'");
                    //rescato el proceso
                    Node proceso=atributos.getNamedItem("Process");
                    String process=proceso.getNodeValue().replace("'", "\'");
                    //recato la fecha de suceso
                    Node fecha=atributos.getNamedItem("TimeStamp");
                    //SimpleDateFormat formato=new SimpleDateFormat("yyyy-dM-Dd H:m:s:S");
                    //Date timestamp=formato.parse(fecha.getNodeValue().replace("T", " "));
                    String timestamp=fecha.getNodeValue();
                    //rescato la descripcion
                    String cadena=registro.getTextContent().replace("'", "\'");
                    //String tipo, String archivo, String host, String proceso, String texto, Date fecha, int idCarga
                    RegistroAlma ra=new RegistroAlma(tipo, file, host, process, cadena, timestamp, carga);
                    this.guardaRegistro(ra);
                }catch(Exception ex){
                    //ex.printStackTrace();
                    System.out.println("Problemas al reconocer atributo "+ex.getMessage()+" "+registro.getNodeName()+" "+i);      
                } 
            }
        }
        try{
            this.actualizaCarga(carga);
            this.revisaSucesos(carga);
            this.conn.close();
        }catch(Exception ex){
            System.out.println("No pudimos cerrar la conexion");
        }
        
    }
    
    private void guardaRegistro(RegistroAlma rg){
        try{
            Statement st=this.conn.createStatement();
            st.executeUpdate("insert into registro_historico (tipo, archivo, host,proceso, texto, fecha, id_carga) values ('"+rg.getTipo()+"', '"+rg.getArchivo()+"', '"+rg.getHost()+"', '"+rg.getProceso()+"', '"+rg.getTexto().replace("'", "!") +"', '"+rg.getFecha()+"', '"+rg.getIdCarga()+"')");
        }catch(Exception ex){
            System.out.println("Problemas al generar el insert en registro historico "+ex.getMessage());
        }
    }
    
    private void generaRegistroCarga(){
        try{
            Statement st=this.conn.createStatement();
            st.executeUpdate("insert into carga (fecha_inicio) values (curdate())");
        }catch(Exception ex){
            System.out.println("Problemas al generar el insert de carga "+ex.getMessage());
        }
    }
    
    private int idUltimaCarga(){
        int res=0;
        try{
            Statement st=this.conn.createStatement();
            ResultSet rs =st.executeQuery("SELECT max(id_carga) max FROM carga;");
            while(rs.next()){
                res=rs.getInt(1);
            }       
        }catch(Exception ex){
            System.out.println("Problemas al recuperar el max id de carga");
        }
        return res;
    }
    
    private void actualizaCarga(int indice){
        try{
            Statement st=this.conn.createStatement();
            st.executeUpdate("update carga set fecha_fin=curdate() where id_carga='"+indice+"'");
        }catch(Exception ex){
            System.out.println("Problemas al generar el update de carga "+ex.getMessage());
        }
    }
    
    public void revisaSucesos(int idCarga){
        try{
            Statement st=this.conn.createStatement();
            ResultSet rs =st.executeQuery("select tipo, archivo, host, proceso, texto, fecha, id_carga from registro_historico where id_carga='"+idCarga+"';");
            while(rs.next()){
                int res=this.evaluaSuceso(rs.getString(1), rs.getString(2), rs.getString(3), rs.getString(4), rs.getString(5));
                if(res>0){
                    RegistroAlma ra=new RegistroAlma(rs.getString(1), rs.getString(2), rs.getString(3), rs.getString(4), rs.getString(5), rs.getString(6), rs.getInt(6));
                    this.guardaAlarma(ra);
                    int ultAlarma=this.idUltimaAlarma();
                    this.guardaEvidenciaAlarma(ultAlarma, rs.getString(6));
                }
            }       
        }catch(Exception ex){
            System.out.println("Problemas al recuperar el max id de carga");
        }
    }
    
    private int idUltimaAlarma(){
        int res=0;
        try{
            Statement st=this.conn.createStatement();
            ResultSet rs =st.executeQuery("SELECT max(id_carga) max FROM alarma;");
            while(rs.next()){
                res=rs.getInt(1);
            }       
        }catch(Exception ex){
            System.out.println("Problemas al recuperar el max id de carga");
        }
        return res;
    }
    
    private int evaluaSuceso(String tipo, String archivo, String host, String proceso, String texto){
        int res=0;
        try{
            Statement st=this.conn.createStatement();
            ResultSet rs =st.executeQuery("select count(id_suceso) from suceso where tipo='"+tipo+"' and archivo='"+archivo+"' and host='"+host+"' and proceso='"+proceso+"' and instr(texto, '"+texto+"')<>0");
            while(rs.next()){
                res=rs.getInt(1);
            }       
        }catch(Exception ex){
            System.out.println("Problemas al evaluar suceso");
        }
        return res;
    }
    
    private void guardaAlarma(RegistroAlma rg){
        try{
            Statement st=this.conn.createStatement();
            st.executeUpdate("insert into alarma (tipo, archivo, host,proceso, texto, fecha, id_carga) values ('"+rg.getTipo()+"', '"+rg.getArchivo()+"', '"+rg.getHost()+"', '"+rg.getProceso()+"', '"+rg.getTexto()+"', '"+rg.getFecha()+"', '"+rg.getIdCarga()+"')");
        }catch(Exception ex){
            System.out.println("Problemas al generar el insert");
        }
    }
    
    public void guardaEvidenciaAlarma(int id_alarma, String fecha_alarma){
        String sql="insert into evidencia_alarma (tipo, archivo, host, proceso, texto, fecha, id_alarma) values (select tipo, archivo, host, proceso, texto, fecha, '"+id_alarma+"'  from registro_hisotico where fecha between date('"+fecha_alarma+"') and date_sub(date('"+fecha_alarma+"'), INTERVAL 2 minute))";
        try{
            Statement st=this.conn.createStatement();
            st.executeUpdate(sql);
        }catch(Exception ex){
            System.out.println("Problemas al generar el insert de alarmas");
        }
    }
}
