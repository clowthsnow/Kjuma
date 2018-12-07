<?php

include '../conexion.php';

//reciviendo datos del formulario
$usuario=$_POST['usuario'];
$fecha = $_POST['fecha'];
$monto = $_POST['dinero'];
$discoteca=$_POST['discotecas'];
$descripcion=$_POST['descripcion'];
$proveedor=$_POST['cobrador'];
$tipoPago=$_POST['tipo'];
$estado=$_POST['estado'];
$cuotas=$_POST['cuotas'];
if (!isset($usuario) || !isset($fecha) || !isset($monto) || !isset($discoteca) || !isset($proveedor) || !isset($tipoPago) || !isset($estado) || !isset($cuotas)) {
    header("location:../page-crear-gasto.php");
}
//partir la fecha en dia, mes, año
#01-01-2011
#0123456789
$dia= substr($fecha,0,2);
$mes= substr($fecha, 3,2);
$anio= substr($fecha,6,4);

$insertar="INSERT INTO gastoeconomico(gastoEconomicoDiscoteca, gastoEconomicoDinero, gastoEconomicoDia, gastoEconomicoMes, gastoEconomicoAnio, gastoEconomicoIdUsuario, gastoEconomicoDescripcion, gastoEconomicoCobrador, gastoEconomicoTipo, gastoEconomicoEstado, gastoEconomicoCuotas) VALUES ('$discoteca', '$monto', '$dia','$mes', '$anio', '$usuario', '$descripcion', '$proveedor', '$tipoPago', '$estado', '$cuotas')";

if($conexion->query($insertar)==TRUE){
    echo '1';
    //echo "Registro exitoso";
        //header("location:../page-asignar-permisos-user.php?usuario=$user"."&nombre=$nombre"."&apellidos=$apellidos");
}else{
    echo '0';
    //echo "Error, nombre de usuario existente";
}
$conexion->close();

