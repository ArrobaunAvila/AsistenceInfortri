<?php 
require_once "../config/conexion.php";
require_once "../models/file.php";
/**
 *Controller Excel
 * @version  0.1 
 * @author  Daniel Avila
 * @category  Back-end
 * @license MIT 
 * 
 */
switch ($_SERVER['HTTP_X_REQUESTED_WITH'] and $_GET["url"]) {
	case 'enviarfile':
		   if (!empty($_FILES["inputfile"])){
		        	$file=$_FILES["inputfile"]["name"];
              $ext_file = explode('.',$file);
              $v_error = 1;
              if (strtolower(end($ext_file)) == "csv"){
                $filename = $_FILES["inputfile"]["tmp_name"];
                $file_object = new File();
                $result=$file_object->cargar_File($filename);
              if($result == 1){
                $v_error=$file_object->procedure_001($v_error); //llenando tabla BITACORA
                  if($v_error == 1){ //No hubo error al ejecutar el archivo
                    $file_object->procedure_002(); //Metodo Llenando tabla Historicos
                    $file_object->truncate_tipo01();
                    echo $v_error;
                  }else{  //Error al ejecutar el archivo
                    $file_object->truncate_tipo01();
                    echo $v_error;
                   }
                 } else{
                    echo "0";
                  }
               } else {
              	echo "0";
              }
		   }
		break;
 }
 ?>