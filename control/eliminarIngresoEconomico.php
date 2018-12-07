<?php

include '../conexion.php';
$numero = $_GET['numero'];
if (!isset($numero)) {
    header("location:../page-ver-ingresosEconomicos.php");
}

$eliminar = "DELETE FROM ingresoeconomico WHERE ingresoEconomicoId='$numero'";
if ($conexion->query($eliminar) === TRUE) {
    echo '1';
} else {
    echo '0';
}
$conexion->close();
