<?php 
require_once "../config/conexion.php";
require_once "../models/acceso.php";
session_start();
if($_SERVER['HTTP_X_REQUESTED_WITH']){
  if (!empty($_POST['username']) and !empty($_POST['password'])){
      $login = new Acceso();
      $response= $login->login();
      echo $response;
  }
}
 ?>