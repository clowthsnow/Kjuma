<?php

include '../conexion.php';
$codigo = $_GET['codigo'];
if (!isset($codigo)) {
    header("location:../page-ver-movimientosEntrada.php");
}

$eliminar = "DELETE FROM entrada WHERE entradaId='$codigo'";
if ($conexion->query($eliminar) === TRUE) {
    echo '1';
} else {
    echo '0';
}
$conexion->close();