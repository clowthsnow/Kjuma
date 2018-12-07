<?php

include '../conexion.php';
$codigo = $_GET['codigo'];
if (!isset($codigo)) {
    header("location:../page-ver-movimientosSalida.php");
}

$eliminar = "DELETE FROM salida WHERE salidaId='$codigo'";
if ($conexion->query($eliminar) === TRUE) {
    echo '1';
} else {
    echo '0';
}
$conexion->close();