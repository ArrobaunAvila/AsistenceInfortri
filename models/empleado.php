<?php 
require_once "bitacora.php";
require_once "../config/conexion.php";
/**
 * Clase generica (personal)
 * Clase que hereda metodos de una interface(BitacoraAbstract)
 * @author  Daniel Avila 
 * @license  MIT
 * @since 02/08/2018
 */
class Personal extends BitacoraAbstract{

public static function listar(){
  
	$conexion =Conexion::ConexionDB();
   $query =" SELECT b.ID_EMPLEADO,NOMBRE,FECHA_EVENTO,FECHA_INICIAL,FECHA_FINAL,OBSERVACION
     FROM BITACORA b, EMPLEADOS e WHERE b.ID_EMPLEADO = e.ID 
     AND (TO_CHAR(TO_DATE(b.FECHA_EVENTO, 'YYYY-MM-DD HH24:MI:SS'),'MM')) = (SELECT MAX(TO_CHAR(TO_DATE(FECHA_EVENTO, 'YYYY-MM-DD HH24:MI:SS'),'MM'))FROM BITACORA)
     ORDER BY FECHA_EVENTO,FECHA_INICIAL";

     $stdi=Conexion::execute_SQL2($query,$conexion);
     $rows = array();
       while ($results = oci_fetch_array($stdi,OCI_NUM)){
         $rows[] = $results;
       }
      Conexion::close_Conexion($conexion);
     return json_encode($rows);
 }

 
public static function listarporempleado1($nombre,$fecha){
  $conexion = Conexion::ConexionDB();
   $query="SELECT b.ID_EMPLEADO,e.NOMBRE,b.FECHA_EVENTO,b.FECHA_INICIAL,b.FECHA_FINAL,OBSERVACION
     FROM BITACORA b, EMPLEADOS e WHERE b.ID_EMPLEADO = e.ID AND UPPER(e.NOMBRE) LIKE UPPER('%$nombre%') AND b.FECHA_EVENTO = '$fecha' ORDER BY b.FECHA_EVENTO,b.FECHA_INICIAL";

     $stdi = Conexion::execute_SQL2($query,$conexion);
     $rows = array();
     while ($results = oci_fetch_array($stdi,OCI_NUM)){
         $rows[] = $results;
       }
       Conexion::close_Conexion($conexion);
     return json_encode($rows);
}

public static function listarporempleado2($nombre,$fecha_inicial,$fecha_final){

	 $conexion = Conexion::ConexionDB();
   $query="SELECT b.ID_EMPLEADO,e.NOMBRE,b.FECHA_EVENTO,b.FECHA_INICIAL,b.FECHA_FINAL,OBSERVACION
     FROM BITACORA b, EMPLEADOS e WHERE b.ID_EMPLEADO = e.ID AND UPPER(e.NOMBRE) LIKE UPPER('%$nombre%') 
     AND b.FECHA_EVENTO BETWEEN '$fecha_inicial' AND '$fecha_final' ORDER BY b.FECHA_EVENTO,b.FECHA_INICIAL";

     $stdi = Conexion::execute_SQL2($query,$conexion);
     $rows = array();
     while ($results = oci_fetch_array($stdi,OCI_NUM)){
         $rows[] = $results;
       }
     return json_encode($rows);
}

public static function listarpordepartamento1($area,$fecha){
    $conexion = Conexion::ConexionDB();
   $query="SELECT b.ID_EMPLEADO,e.NOMBRE,b.FECHA_EVENTO,b.FECHA_INICIAL,b.FECHA_FINAL,OBSERVACION FROM EMPLEADOS e, BITACORA b, AREA a WHERE b.ID_EMPLEADO = e.ID AND e.ID_AREA = a.ID AND a.ID='$area' AND b.FECHA_EVENTO='$fecha' ORDER BY b.FECHA_EVENTO,b.FECHA_INICIAL";
    
     $stdi = Conexion::execute_SQL2($query,$conexion);
     $rows = array();
     while ($results = oci_fetch_array($stdi,OCI_NUM)){
         $rows[] = $results;
       }
     return json_encode($rows);
}

public static function listarpordepartamento2($area,$fecha_inicial,$fecha_final){

	 $conexion = Conexion::ConexionDB();
   $query="SELECT b.ID_EMPLEADO,e.NOMBRE,b.FECHA_EVENTO,b.FECHA_INICIAL,b.FECHA_FINAL,OBSERVACION
 FROM EMPLEADOS e, BITACORA b, AREA a WHERE b.ID_EMPLEADO = e.ID AND e.ID_AREA = a.ID AND a.ID='$area'AND b.FECHA_EVENTO BETWEEN '$fecha_inicial' AND '$fecha_final' ORDER BY b.FECHA_EVENTO,b.FECHA_INICIAL";

     $stdi = Conexion::execute_SQL2($query,$conexion);
     $rows = array();
     while ($results = oci_fetch_array($stdi,OCI_NUM)){
         $rows[] = $results;
       }
     return json_encode($rows);
}

public static function listarporDia($fecha){
	$conexion = Conexion::ConexionDB();
   $query="SELECT b.ID_EMPLEADO,e.NOMBRE,b.FECHA_EVENTO,b.FECHA_INICIAL,b.FECHA_FINAL,OBSERVACION
     FROM BITACORA b, EMPLEADOS e WHERE b.ID_EMPLEADO = e.ID  AND b.FECHA_EVENTO = '$fecha' ORDER BY b.FECHA_EVENTO,b.FECHA_INICIAL";

     $stdi = Conexion::execute_SQL2($query,$conexion);
     $rows = array();
     while ($results = oci_fetch_array($stdi,OCI_NUM)){
         $rows[] = $results;
       }
       Conexion::close_Conexion($conexion);
     return json_encode($rows);
}

public static function listarporMes($mes){ 
  	$conexion = Conexion::ConexionDB();
   $query="SELECT b.ID_EMPLEADO,e.NOMBRE,b.FECHA_EVENTO,b.FECHA_INICIAL,b.FECHA_FINAL,OBSERVACION
     FROM BITACORA b, EMPLEADOS e WHERE b.ID_EMPLEADO = e.ID AND TO_CHAR(TO_DATE(b.FECHA_EVENTO,'yyyy-mm-dd'),'mm') = '$mes' ORDER BY b.FECHA_EVENTO,b.FECHA_INICIAL";

      
     
     $stdi = Conexion::execute_SQL2($query,$conexion);
     $rows = array();
     while ($results = oci_fetch_array($stdi,OCI_NUM)){
         $rows[] = $results;
       }
       Conexion::close_Conexion($conexion);
     return json_encode($rows);
}

public static function infoEmpleado($id){
    $conexion = Conexion::ConexionDB();
   $query="SELECT * FROM EMPLEADOS E WHERE E.ID='$id'";
     
     $stdi = Conexion::execute_SQL2($query,$conexion);
     $rows = array();
     while ($results = oci_fetch_array($stdi,OCI_NUM)){
         $rows[] = $results;
       }
       Conexion::close_Conexion($conexion);
     return json_encode($rows);
}

public static function listar_Empleados(){
    $conexion = Conexion::ConexionDB();
   $query="SELECT E.ID,E.IDNTFCCION,E.NOMBRE,E.EMAIL,
   '<button class=\"btn btn-success btn_acciones\" id=\"btn_check\"><i class=\"fa fa-check\"></i></button>'
  ||' '||'<button class=\"btn btn-primary btn_acciones\" id=\"btn_remover\"><i class=\"fa fa-close\"></i></button>' AS buttons_dinamic
    FROM EMPLEADOS E";
     
     $stdi = Conexion::execute_SQL2($query,$conexion);
     $rows = array();
     while ($results = oci_fetch_array($stdi,OCI_NUM)){
         $rows[] = $results;
       }
       Conexion::close_Conexion($conexion);
     return json_encode($rows);
}

public static function cambiar_Estado($id){
    $conexion = Conexion::ConexionDB();
  $stdi = oci_parse($conexion,'begin SITPR_UPDA_EST(:v_id,:v_response); end;');
  $response = null;
  oci_bind_by_name($stdi, ':v_id', $id);
  oci_bind_by_name($stdi, ':v_response', $response);
  Conexion::execute_SQL($stdi);
  return $response;
}


public static function saveEmpleado($id,$cedula,$nombre,$direccion,$telefono,$email,$area,$sucursal){
  $conexion = Conexion::ConexionDB();
  $stdi = oci_parse($conexion,'begin SITPR001_SAVE(:v_usuario,:v_id,:v_cedula,:v_nombre,:v_telefono,:v_direccion,:v_email,
:v_area,:v_sucursal,:v_response); end;');
  $response = null;
  session_start();
  $usuario=$_SESSION["username"];

  oci_bind_by_name($stdi, ':v_usuario', $usuario);
  oci_bind_by_name($stdi, ':v_id', $id);
  oci_bind_by_name($stdi, ':v_cedula', $cedula);
  oci_bind_by_name($stdi, ':v_nombre', $nombre);
  oci_bind_by_name($stdi, ':v_telefono', $telefono);
  oci_bind_by_name($stdi, ':v_direccion', $direccion);
  oci_bind_by_name($stdi, ':v_email', $email);
  oci_bind_by_name($stdi, ':v_area', $area);
  oci_bind_by_name($stdi, ':v_sucursal', $sucursal);
  oci_bind_by_name($stdi, ':v_response', $response);

  Conexion::execute_SQL($stdi);
  return $response;
}


public static function verificarEstado($id){

    $conexion = Conexion::ConexionDB();
   $query="SELECT ESTADO FROM EMPLEADOS E WHERE E.ID='$id'";
     
     $stdi = Conexion::execute_SQL2($query,$conexion);
     $rows = array();
     while ($results = oci_fetch_array($stdi,OCI_NUM)){
         $rows[] = $results;
       }
     Conexion::close_Conexion($conexion);
     return json_encode($rows);
}



}
 ?>