<?php
//namespace core\bd;
/**
 * CoreBd
 * Clase que permite la ejecucion de consultas bajo una base de datos mysql
 * @package CoreBd
 * @author Juan Zamorano
 * @copyright 2011
 * @version 1.1
 * @access public
 */
class CoreBd{
     
    private $host;
    private $user;
    private $password;
    private $baseDatos;
    private $conexion;
    private $rs;
    private $conf;
    
    /**
     * CoreBd::__construct()
     * Constructor de la clase
     * @param mixed $host host a conectar
     * @param mixed $user usuario de la base de datos
     * @param mixed $password password de la conexion
     * @param mixed $baseDatos base de datos sobre la cual trabajar
     * 
     */
    public function __construct($host="", $user="", $password="", $baseDatos=""){
        if($host!=""){
            $this->host=$host;
        }
        if($user!=""){
            $this->user=$user;
        }
        if($password!=""){
            $this->password=$password;
        }
        if($baseDatos!=""){
            $this->baseDatos=$baseDatos;
        }
        try{
            $this->conexion=mysqli_init();
            $this->conexion->real_connect($this->host, $this->user, $this->password, $this->baseDatos);
        }catch(Exception $e){
            throw new Exception($this->conexion->error, $this->conexion->errno);
        }
    }
    
    
    /**
     * CoreBd::consulta()
     * Ejecuta una consulta
     * @param mixed $sql codigo sql a ejecutar
     * @return resultado de la operacion
     */
    private function consulta($sql){
    	$res=$this->conexion->query($sql);
    	if($res){
    		return $this->rs=$res; 
    	}else{
    		throw new Exception($this->conexion->error, $this->conexion->errno);
    	}
    }
    
    /**
     * CoreBd::consultaSeleccionNum()
     * Realiza una consulta de seleccion tipo select
     * @param mixed $sql codigo sql a ejecutar
     * @return array con resultados de la operacion ordenados numericamente por 
     * el numero de orden del campo
     */
    public function consultaSeleccionNum($sql){
        self::consulta($sql);
        $numReg=0;
        $arr_res=array();
        while($result=$this->rs->fetch_row()){
            for($i=0; $i<$this->rs->field_count; $i++){
                $arr_res[$numReg][$i]=$result[$i];
            }
            $numReg++;    
        }
        return $arr_res;
    }
    
    /**
     * CoreBd::consultaSeleccionNom()
     * Realiza una consulta de seleccion tipo select
     * @param mixed $sql codigo sql a ejecutar
     * @return array con resultados de la operacion ordenados por el nombre
     * del campo
     */
    public function consultaSeleccionNom($strSql){
        $this->res=self::consulta($strSql);
        $reg=0;
        $arr_data=array();
        while($arr=$this->res->fetch_array(MYSQLI_ASSOC)){
            foreach($arr as $key=>$valor){
                $arr_data[$reg][$key]=$valor;
            }
            $reg++;
        }
        return $arr_data;
    }
    
    /**
     * CoreBd::consultaModificacion()
     * Ejecuta una consulta de modificacion de datos tipo insert, update, delete etc.
     * @param mixed $sql codigo sql a ejecutar
     * @return valor booleano resultante de la ejecucion
     */
    public function consultaModificacion($sql){
        self::consulta($sql);
        if($this->rs){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * CoreBd::getHost()
     * retorna el host de la instancia
     * @return host de la instancia
     */
    public function getHost(){
        return $this->host;
    }
    
    /**
     * CoreBd::setHost()
     * setea el host de la instancia
     * @param mixed $host
     * 
     */
    public function setHost($host){
        $this->host=$host;
    }
    
    /**
     * CoreBd::getUser()
     * retorna el usuario de la instancia
     * @return usuario de la instancia
     */
    public function getUser(){
        return $this->user;
    }
    
    /**
     * CoreBd::setUser()
     * setea el usuario de la instancia
     * @param mixed $user
     * 
     */
    public function setUser($user){
        $this->user=$user;
    }
    
    /**
     * CoreBd::getPassword()
     * retirna el password de la instancia
     * @return password de la instancia
     */
    public function getPassword(){
        return $this->password;
    }
    
    /**
     * CoreBd::setPassword()
     * setea el password de la instancia
     * @param mixed $password
     * 
     */
    public function setPassword($password){
        $this->password=$password;
    }
    
    /**
     * CoreBd::getBaseDatos()
     * retorna la base de datos de la instancia
     * @return base de datos de la instancia
     */
    public function getBaseDatos(){
        return $this->baseDatos;
    }
    
    /**
     * CoreBd::setBaseDatos()
     * setea la base de datos de la instancia
     * @param mixed $baseDatos
     * 
     */
    public function setBaseDatos($baseDatos){
        $this->baseDatos=$baseDatos;
    }
    
    /**
     * CoreBd::getUltimoIdGenerado()
     * retorna el id del ultoimo insert generado
     * @return ultimo id generado
     * 
     */
    public function getUltimoIdGenerado(){
        return $this->rs->insertId;
    }
	
    /**
     * CoreBd::limpiaVariable()
     * Limpia una variable para evitar el sql injection
     * @param $variable variable a limpiar 
     * @return unknown_type variable sanitizada de sql injection
     */
    public function limpiaVariable($variable){
    	return $this->conexion->real_escape_string($variable);	
    }
    
    /**
     * CoreBd::__destruct()
     * destructor de la clase limpia la memoria y cierra la conexion
     * @return
     */
    public function __destruct(){
    	/*if(isset($this->rs)){
    		$this->rs->free_result();
    	}*/
        $this->conexion->close();
    }
}
?>