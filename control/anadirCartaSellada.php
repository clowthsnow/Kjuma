<?php

include '../conexion.php';
$licor = $_GET['licor'];
$precio=$_GET['precio'];
$discoteca=$_GET['discoteca'];

if (!isset($barra) || !isset($cantidad) || !isset($discoteca)) {
        header("location:../page-anadir-cartaSellada.php");
}
$cartaID="S".$discoteca;
$insertar="INSERT INTO cartasellada(cartaSelladaId, cartaSelladaLicor, cartaSelladaPrecio) VALUES ('$cartaID','$licor','$precio')";

$eliminar="UPDATE carta SET cartaSellada='$cartaID' WHERE cartaId='$discoteca'";
if($conexion->query($insertar) === TRUE){
    echo '1';
    $conexion->query($eliminar);
}else{
    echo '0';
}
$conexion->close();
