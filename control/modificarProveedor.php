<?php

include '../conexion.php';

//reciviendo datos del formulario
$proveedor = $_POST['proveedor'];
$nombre = $_POST['nombre'];
$ruc = $_POST['ruc'];
$categoria=$_POST['categorias'];
if (!isset($proveedor) || !isset($categoria) || !isset($nombre)) {
    header("location:../page-ver-proveedores.php");
}
$actualiza="UPDATE proveedor SET proveedorNombre='$nombre', proveedorRuc='$ruc', proveedorCategoria='$categoria' WHERE proveedorId='$proveedor'";
if($conexion->query($actualiza) === TRUE){
    echo '1';
}else{
    echo '0';
}
$conexion->close();