<?php

include '../conexion.php';

$uso = $_GET['uso'];

$codigo = $_GET['codigo'];
$barra = $_GET['barra'];
$estado = "no";
if ($uso == 1) {
    $barra1 = "SK" . $barra;
    $busqueda1 = "SELECT * FROM gbarrasellada WHERE GBarraSelladaId='$barra1' AND GBarraSelladaLicor='$codigo' ";
    $resp1 = $conexion->query($busqueda1) or die($conexion->error);
    if ($fila = $resp1->fetch_assoc()) {
        $estado = "ok";
    }
}
if ($uso == 3) {
    $barra1 = "JK" . $barra;
    $busqueda1 = "SELECT * FROM gbarrajarra WHERE GBarraJarraId='$barra1' AND GBarraJarraLicor='$codigo' ";
    $resp1 = $conexion->query($busqueda1) or die($conexion->error);
    if ($fila = $resp1->fetch_assoc()) {
        $estado = "ok";
    }
}
if ($uso == 12) {
    $barra1 = "VK" . $barra;
    $busqueda1 = "SELECT * FROM gbarravaso WHERE GBarraVasoId='$barra1' AND GBarraVasoLicor='$codigo' ";
    $resp1 = $conexion->query($busqueda1) or die($conexion->error);
        if ($fila = $resp1->fetch_assoc()) {
        $estado = "ok";
    }

}

echo $estado;