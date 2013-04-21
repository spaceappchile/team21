/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package almainit;

import almainit.archivos.LectorXml;

/**
 *
 * @author kamaleon
 */
public class AlmaInit {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        // TODO code application logic here
        LectorXml lx=new LectorXml("C:/prueba.xml");
        lx.lecturaArchivo();
    }
}
