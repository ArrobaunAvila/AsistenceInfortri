<?php 
require_once "../config/conexion.php";
/**
 * Clase Lectura y uso de archivo CSV EXCEL
 */
class File {

private $file;
private  $size_file;

public static function cargar_File($filename){
  $conexion = Conexion::ConexionDB();
  $i=0;
  $consc=201800;
   $lineas = file($filename);
   /*Alterar el conjunto de sesiones y formato*/
   /*
   $query ="alter session set nls_date_format = 'YYYYMMDD HH24:MI:SS'";
    $stdi =oci_parse($conexion,$query);
    oci_execute($stdi);
   */
    set_time_limit(0);
   foreach ($lineas as $linea_num => $linea){
    $datos = explode(';', $linea);
     $num_colum=count($datos);
    if ($num_colum == 12) {  
    if ($i != 0){
      if($datos[6] != "--" and !is_null($datos[6])){
        $fecha = $datos[0];
        $area = $datos[1];
        $dispositivo = $datos[2];
        $lugar_del_evento = $datos[3];
        $descripcion_evento=$datos[4];
        $numero_tarjeta=$datos[5];
        $id_empleado  = $datos[6];
        $nombre_empleado= $datos[7];
        $departamento = $datos[8];
        $estado = substr($datos[9],-7);
        $modo_verificacion = $datos[10];
        $comentarios = $datos[11];
         
         $sql="INSERT INTO TIPO01(CNSCTVO,TIEMPO,DESC_EVENTO,ID,NOMBRE,ESTADO)
        VALUES($consc,'$fecha','$descripcion_evento','$id_empleado','$nombre_empleado','$estado')";

          $stdi = oci_parse($conexion,$sql);
          $result=Conexion::execute_SQL($stdi);
          $consc=$consc+1;
          /*si el result es igual a 1, la query se ejecuto correctamente
            si es 0, error al ejecutar o no se insertaron los campos correctamente
          */
        }
      }
     }else {
      $result = 2;
      return $result;
      /*Si el $result enviado es 2, error archivo columnas
          */
     } 
    $i++;
    }
    return $result;
  }

/**
 * Function procedure_001 
 * ejecucion de procedimiento almacenado llenado tabla Bitacora
 * @return type
 */
public static function procedure_001($v_error){
  $conexion = Conexion::ConexionDB();
  $stdi = oci_parse($conexion,'begin PR002_10001(:v_error); end;');
  oci_bind_by_name($stdi, ':v_error', $v_error);
  Conexion::execute_SQL($stdi);
  return $v_error;
}

public static function procedure_002(){
 $conexion = Conexion::ConexionDB();
 $stdi = oci_parse($conexion, 'begin SITPR001_HSTRICO; end;');
 Conexion::execute_SQL($stdi);
}

public static function truncate_tipo01(){
  $conexion = Conexion::ConexionDB();
  $query = "TRUNCATE TABLE TIPO01";
  $stdi = oci_parse($conexion,$query);
  Conexion::execute_SQL($stdi);
}

}

 ?>

 