<?php

include '../conexion.php';

//reciviendo datos del formulario
$id = $_POST['id'];
$nombre = $_POST['nombre'];
if (!isset($id) || !isset($nombre)) {
    header("location:../page-ver-discotecas.php");
}
$actualiza="UPDATE discoteca SET discotecaNombre='$nombre' WHERE discotecaId='$id'";
if($conexion->query($actualiza) === TRUE){
    echo '1';
}else{
    echo '0';
}
$conexion->close();