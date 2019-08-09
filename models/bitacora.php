<?php 
abstract class BitacoraAbstract{

abstract protected static function listarporempleado1($nombre,$fecha);
abstract protected static function listarporempleado2($nombre,$fecha_inicial,$fecha_final);
abstract protected static function listarporDia($fecha); 
abstract protected static function listarporMes($mes);
abstract protected static function listar();
abstract protected static function listarpordepartamento1($area,$fecha);
abstract protected static function listarpordepartamento2($area,$fecha_inicial,$fecha_final);
abstract protected static function infoEmpleado($id);
abstract protected static function saveEmpleado($id,$cedula,$nombre,$direccion,$telefono,$email
	,$area,$sucursal);
abstract protected static function listar_Empleados();
abstract protected static function cambiar_Estado($id);
abstract protected static function verificarEstado($id);

}
 ?>