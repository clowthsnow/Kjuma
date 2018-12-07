<?php

include '../conexion.php';

//reciviendo datos del formulario
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$discoteca=$_POST['discotecas'];
if (!isset($id) || !isset($nombre) || !isset($discoteca)) {
    header("location:../page-ver-barras.php");
}
$actualiza="UPDATE barra SET barraNombre='$nombre', barraDiscoteca='$discoteca' WHERE barraId='$id'";
if($conexion->query($actualiza) === TRUE){
    echo '1';
}else{
    echo '0';
}
$conexion->close();