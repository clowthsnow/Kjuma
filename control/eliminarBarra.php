<?php

include '../conexion.php';
$barra = $_GET['barra'];
if (!isset($barra) ) {
        header("location:../page-ver-barras.php");
}
$eliminar="UPDATE barra SET barraEstReg='*' WHERE barraId='$barra'";
if($conexion->query($eliminar) === TRUE){
    echo '1';
}else{
    echo '0';
}
$conexion->close();
