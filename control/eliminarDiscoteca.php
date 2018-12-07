<?php

include '../conexion.php';
$discoteca = $_GET['discoteca'];
if (!isset($discoteca) ) {
        header("location:../page-ver-discotecas.php");
}
$eliminar="UPDATE discoteca SET discotecaEstReg='*' WHERE discotecaId='$discoteca'";
if($conexion->query($eliminar) === TRUE){
    echo '1';
}else{
    echo '0';
}
$conexion->close();