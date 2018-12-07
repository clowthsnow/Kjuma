<?php

include '../conexion.php';
$licor = $_GET['licor'];
$cantidad=$_GET['cantidad'];
if (!isset($barra) || !isset($cantidad)) {
        header("location:../page-inicio-inventario.php");
}
$eliminar="UPDATE inventariogeneraldetalle SET inventarioGeneralDetalleCantidad='$cantidad' WHERE inventarioGeneralDetalleLicor='$licor'";
if($conexion->query($eliminar) === TRUE){
    echo '1';
    $estatus="UPDATE inventariogeneral SET inventarioGeneralEstado='1' WHERE inventarioGeneralId='1'";
    $conexion->query($estatus);
}else{
    echo '0';
}
$conexion->close();
