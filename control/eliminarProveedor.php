<?php

include '../conexion.php';
$proveedor = $_GET['proveedor'];
if (!isset($proveedor) ) {
        header("location:../page-ver-proveedores.php");
}
$eliminar="UPDATE proveedor SET proveedorEstReg='*' WHERE proveedorId='$proveedor'";
if($conexion->query($eliminar) === TRUE){
    echo '1';
}else{
    echo '0';
}
$conexion->close();