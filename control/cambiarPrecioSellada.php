<?php

include '../conexion.php';
$cartaSellada = $_POST['id'];
$licor=$_POST['licor'];
$precio=$_POST['precio'];
//echo $cartaSellada;
//echo $licor;
//echo $precio;
////
//if (!isset($cartaSellada) || !isset($licor)) {
//    header("location:../page-configurar-carta.php");
//}
$update="UPDATE cartasellada SET cartaSelladaPrecio='$precio' WHERE cartaSelladaId='$cartaSellada' AND cartaSelladaLicor='$licor'";
if($conexion->query($update)==TRUE){
    echo "1";
}else{
    echo"0";
}
