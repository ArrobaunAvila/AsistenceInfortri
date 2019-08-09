<?php 
require_once "../config/conexion.php";
require_once "../models/empleado.php";
require_once "../models/acceso.php";
/**
 *Controller Dashboard
 * Recibe todas las peticiones proveyentes del tablero de filtros
 * @version  0.1 
 * @author  Daniel Avila
 * @category  Back-end
 * @license MIT 
 * 
 */
switch ($_GET["url"]) {
	case 'listar':
		 $personal = new Personal();
		 $listado=$personal->listar();
		 echo $listado;
	break;

	case 'porempleado':
	  if(isset($_POST["fecha"])){
        $personal = new Personal();
        $response=$personal->listarporempleado1($_POST["nombre"],$_POST["fecha"]);
        echo $response;
	  } else if(isset($_POST["fecha_rango"])){
        $personal = new Personal();
        $response=$personal->listarporempleado2($_POST["nombre"],$_POST["fecha_inicial"],$_POST["fecha_final"]);
        echo $response;
	  }
	break;

	case 'pordepartamento': 
       if(isset($_POST["fecha"])){
            $personal = new Personal();
           $response=$personal->listarpordepartamento1($_POST["area"],$_POST["fecha"]);
           echo $response; 
        } else if(isset($_POST["fecha_rango"])){
        $personal = new Personal();
        $response=$personal->listarpordepartamento2($_POST["area"],$_POST["fecha_inicial"],$_POST["fecha_final"]);
        echo $response;
	  }
	break;

	case 'pordia':
		  if(isset($_POST["fecha"])){
            $personal = new Personal();
            $response = $personal->listarporDia($_POST["fecha"]); 
            echo $response;
           } 
  	break;

  	case 'pormes':
		  if(isset($_POST["mes"])){
		  	 $personal = new Personal();
            $response = $personal->listarporMes($_POST["mes"]); 
            echo $response;
           } 
  	break;
	
   case 'empleado':
      if(isset($_GET["id"])){
          $personal = new Personal();
          $response=$personal->infoEmpleado($_GET["id"]);
          echo $response;
        } 
    break;

     case 'listado_empleados':
          $personal = new Personal();
          $listado=$personal->listar_Empleados();
          echo $listado;
    break;

     case 'save':
      if(isset($_POST["accion"])){
           $id = $_POST["id"];
           $cedula = $_POST["cedula"];
           $nombre = $_POST["nombre"];
           $direccion = $_POST["direccion"];
           $telefono = $_POST["telefono"];
           $email = $_POST["email"];
           $area = $_POST["area"];
           $sucursal = $_POST["sucursal"];

           $personal = new Personal();
          $response =  $personal->saveEmpleado($id,$cedula,$nombre,$direccion,$telefono,$email,$area,$sucursal);
          echo $response;
        } else{
          echo "error_reporting()";
        } 
    break;

       case 'estado':
      if(isset($_POST["id"])){
          $personal = new Personal();
          $response =  $personal->cambiar_Estado($_POST["id"]);
          echo $response;
      } 
       break;

      case 'devolver_estado':
       if(isset($_GET["id"])){
          $personal = new Personal();
          $response =  $personal->verificarEstado($_GET["id"]);
          echo $response;
      } 
      break;
      
      case 'cambiarpass':
        session_start();
        if($_SESSION["username"] && $_POST["passactual"] && $_POST["pass_nueva"] ){
          $usuario = new Acceso();
          $response = $usuario->cambiarContraseña($_POST["passactual"],$_POST["pass_nueva"]);
          echo $response;
        }
      break;
}
 ?>
