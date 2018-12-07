<?php

include '../conexion.php';

//reciviendo datos del formulario
$numero=$_POST['numero'];
$usuario=$_POST['usuario'];
$fecha = $_POST['fecha'];
$monto = $_POST['dinero'];
$discoteca=$_POST['discotecas'];
$descripcion=$_POST['descripcion'];
if (!isset($usuario) || !isset($fecha) || !isset($monto) || !isset($discoteca)) {
    header("location:../page-ver-ingresosEconomicos.php");
}
//partir la fecha en dia, mes, año
#01-01-2011
#0123456789
$dia= substr($fecha,0,2);
$mes= substr($fecha, 3,2);
$anio= substr($fecha,6,4);

$modificar="UPDATE ingresoeconomico SET ingresoEconomicoDiscoteca='$discoteca', ingresoEconomicoDinero='$monto',ingresoEconomicoDia='$dia', ingresoEconomicoMes='$mes', ingresoEconomicoAnio='$anio', ingresoEconomicoIdUsuario='$usuario', ingresoEconomicoDescripcion='$descripcion' WHERE ingresoEconomicoId='$numero'";
if($conexion->query($modificar)==TRUE){
    echo '1';
    //echo "Registro exitoso";
        //header("location:../page-asignar-permisos-user.php?usuario=$user"."&nombre=$nombre"."&apellidos=$apellidos");
}else{
    echo '0';
    //echo "Error, nombre de usuario existente";
}
$conexion->close();

