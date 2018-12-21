<?php

include '../conexion.php';

//reciviendo datos del formulario
$monto = $_POST['monto'];
$barra=$_POST['barra'];
if (!isset($monto)) {
    header("location:../page-ver-facturas.php");
}

$actualiza="UPDATE kardex SET kardexFactura='$monto' WHERE kardexId='$barra'";
if($conexion->query($actualiza) === TRUE){
    echo '1';
}else{
    echo '0';
}
$conexion->close();