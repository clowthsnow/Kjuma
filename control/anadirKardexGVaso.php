<?php

include '../conexion.php';
$licor = $_GET['licor'];
$stock=$_GET['stock'];
$codigo=$_GET['codigo'];
echo $licor;
echo $stock;
echo $codigo;

if (!isset($barra) || !isset($cantidad) || !isset($codigo)) {
        header("location:../page-anadir-kardexGVaso.php");
}
$cartaID="V".$codigo;
$insertar="INSERT INTO gbarravaso(GBarraVasoId, GBarraVasoLicor, GBarraVasoCantidad) VALUES ('$cartaID','$licor','$stock')";

$eliminar="UPDATE kardexgbarra SET KardexGBarraVaso='$cartaID' WHERE KardexGBarraId='$codigo'";
if($conexion->query($insertar) === TRUE){
    echo '1';
    $conexion->query($eliminar);
}else{
    echo '0';
}
$conexion->close();
