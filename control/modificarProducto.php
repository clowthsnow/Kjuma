<?php

include '../conexion.php';

//reciviendo datos del formulario
$id = $_POST['id'];
$nombre = $_POST['nombreproducto'];
$categoria=$_POST['categoria'];
if (!isset($id) || !isset($nombre) || !isset($categoria)) {
    header("location:../page-ver-productos.php");
}
$actualiza="UPDATE producto SET productoNombre='$nombre', productoCategoria='$categoria' WHERE productoId='$id'";
if($conexion->query($actualiza) === TRUE){
    echo '1';
}else{
    echo '0';
}
$conexion->close();