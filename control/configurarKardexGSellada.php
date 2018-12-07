<?php

include '../conexion.php';
$licor = $_GET['licor'];
$stock=$_GET['stock'];
$codigo=$_GET['codigo'];
echo $licor;
echo $stock;
echo $codigo;

//if (!isset($barra) || !isset($cantidad) || !isset($codigo)) {
//        header("location:../page-configurar-kardex-selladas.php");
//}
$cartaID="S".$codigo;
//$insertar="INSERT INTO gbarrasellada(GBarraSelladaId, GBarraSelladaLicor, GBarraSelladaCantidad) VALUES ('$cartaID','$licor','$stock')";
$insertar="UPDATE gbarrasellada SET GBarraSelladaCantidad='$stock' WHERE GBarraSelladaId='$cartaID' AND GBarraSelladaLicor='$licor'";
if($conexion->query($insertar) === TRUE){
    echo '1';
//    $conexion->query($eliminar);
}else{
    echo '0';
}
$conexion->close();
