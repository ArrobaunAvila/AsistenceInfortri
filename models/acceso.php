<?php 
require_once "../config/conexion.php";
/**
 * Clase Acceso Login
 */
class Acceso{

	 private $username,$password;

/**
 * function login() verificar inicio de sesion
 * @return type
 */
public function login(){
 try {
 	if(!empty($_POST['username']) and !empty($_POST['password'])){
 		$conexion = Conexion::ConexionDB();
        $this->password = $this->Encrypt($_POST['password']);
        $this->username = $_POST['username'];
         //echo $this->password.'  ';
        $query = "SELECT * FROM USERS WHERE USUARIO = :userdb AND PASSSWORD = :passdb";
        
         $stmt =oci_parse($conexion,$query);
         $array_datos = array(':userdb'=> $this->username,':passdb'=>$this->password);
         foreach ($array_datos as $key => $value){
          oci_bind_by_name($stmt, $key, $array_datos[$key]);	
         }
         Conexion::execute_SQL($stmt);
         $rows = oci_fetch_all($stmt, $res);

         if($rows == 1){
          $_SESSION["username"]= $this->username;
          echo 1;
          } else {     
           throw new Exception(0);
         }
  	}else{
 		throw new Exception("Error: Datos Vacíos!");	
 	}
    
 } catch (Exception $e) {
 	echo $e->getMessage();
 }
}

/**
 * Metodo para cambiar la contraseña de usuario
 * @param type $string 
 * @return type
 */
public function cambiarContraseña($pass_actual,$pass_nueva){
  $pass_actual_encrypt = $this->Encrypt($pass_actual);
  $pass_nueva_encrypt =  $this->Encrypt($pass_nueva);
$conexion = Conexion::ConexionDB();
  $stdi = oci_parse($conexion,'begin SITPR001_CHANGE_PASS(:v_pass_actual,:v_pass_nueva,:v_response); end;');
  $response = null;
  oci_bind_by_name($stdi, ':v_pass_actual', $pass_actual_encrypt);
  oci_bind_by_name($stdi, ':v_pass_nueva', $pass_nueva_encrypt);
  oci_bind_by_name($stdi, ':v_response', $response);
  Conexion::execute_SQL($stdi);
  return $response;
}

 /**
  * Function para Encryptar contraseña Base datos
  * @param type $string 
  * @return type
  */
private  function Encrypt($string){
	$sizeof = strlen($string)-1;
	$result='';
	for($x = $sizeof; $x >=0;$x--){
	 $result.= $string[$x]; 
	}
	$result = md5($result);
	return $result; 
}




}
 ?>