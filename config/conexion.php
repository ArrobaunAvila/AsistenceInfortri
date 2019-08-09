<?php 
require_once "global.php";
/**
 * Clase Conexion
 * Metodos para el trato de Query
 * @author  Daniel Avila 
 * @license  MIT
 * @since 27/07/2018
 */
class Conexion{
	
	public static $conexion;

  /**
   * Description
   * @return type
   * Funcion ConexionDB conectamos a la base de datos ORACLE
   */
   public static function ConexionDB(){
        $user = DB_USER;
        $password = DB_PASSWORD;
        $instancia = DB_INSTANCIA;

        try {
        	self::$conexion = oci_connect($user, $password,$instancia);
        } catch (Exception $e) {
        	echo $e->getMessage()."Error Conexion";
        }
        return self::$conexion;                               
   }

  /**
   * Description
   * @param type $conexion 
   * @return type
   * Metodo Para cerrar conexiones persistentes
   */

   public static function close_Conexion($conexion){
   	
   	   if (isset($conexion)){
   	   	oci_close($conexion);
   	   } 
   }
/**
 * Description
 * @param type $stdi 
 * @return type
 * Metodo para ejecutar una consulta simple de Insert 
 */
 public static function execute_SQL($stdi)
 {
    $query = oci_execute($stdi);
    return $query;
  }
  /**
   * Description
   * @param type $query 
   * @param type $conexion 
   * @return type
   * Metodo utilizado para retornar el statement
   * para envio de JSON U ARRAY. 
   */
   public static function execute_SQL2($query , $conexion)
   { 
    $stdi=oci_parse($conexion, $query);
    oci_execute($stdi);
    return $stdi;
   }
 /**
  * Metodo Para obtener un array de un Execute(Query)
  * @param type $stdi 
  * @return type
  */
   public static function array_Query($stdi){
   	 $array = oci_fetch_array($stdi,OCI_BOTH);
   	 return $array;
   }

   /**
    * Metodo filas result consultas execute(Query)
    * @param type $stdi 
    * @return type
    */
   public static function num_Rows($stdi){
     $rows = oci_num_rows($stdi);
     return $rows;
   }
   
}
 ?>