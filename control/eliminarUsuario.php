<?php

include '../conexion.php';
$user = $_GET['usuario'];
if (!isset($user) ) {
        header("location:../page-ver-usuarios.php");
}
$eliminar="UPDATE usuario SET usuarioEstReg='*' WHERE usuarioId='$user'";
if($conexion->query($eliminar) === TRUE){
    echo '1';
}else{
    echo '0';
}
$conexion->close();