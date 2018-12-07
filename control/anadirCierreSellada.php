<?php

include '../conexion.php';
$licor = $_GET['licor'];
$fin=$_GET['fin'];
$dataBase=$_GET['bd'];
$discoteca=$_GET['disco'];
echo $licor;
echo $fin ;
echo $discoteca;
echo $dataBase;

if (!isset($licor) || !isset($fin) || !isset($dataBase)) {
        header("location:../page-cerrar-kardex.php");
}
//$cartaID="J".$codigo;
//$insertar="INSERT INTO gbarrajarra(GBarraJarraId, GBarraJarraLicor, GBarraJarraCantidad) VALUES ('$cartaID','$licor','$stock')";
//
//$eliminar="UPDATE kardexgbarra SET KardexGBarraJarras='$cartaID' WHERE KardexGBarraId='$codigo'";
//buscamos en el kardex el inicio aumento
$buscar="SELECT * FROM kardexsellada WHERE KardexSelladaId='$dataBase' AND KardexSelladaLicor='$licor'";
$resultadoBuscar=$conexion->query($buscar);
$fila=$resultadoBuscar->fetch_assoc();
//print_r($fila);
//calculamos venras


$venta=($fila['KardexSelladaInicio']*1.0)+($fila['KardexSelladaAumento']*1.0)-($fin*1.0);

//escrbimos ventas y fin
$update="UPDATE kardexsellada SET KardexSelladaFinal='$fin' , KardexSelladaVenta='$venta' WHERE KardexSelladaId='$dataBase' AND KardexSelladaLicor='$licor'";
$conexion->query($update) or die($conexion->error);
//
//echo $update;
////buscamos precion en carta
//$carta="SC".$discoteca;
//$buscarPrecio="SELECT * FROM cartasellada WHERE cartaSelladaId='$carta' AND cartaSelladaLicor='$licor'";
//$resultadoPrecio=$conexion->query($buscarPrecio);
//$precio=$resultadoPrecio->fetch_assoc();
//
//$efectivo=$venta*$precio;
//
////buscamos el kardex
//$buscarKardex="SELECT * FROM kardex WHERE kardexSellada='$dataBase'";
//$resultadoKardex=$conexion->query($buscarKardex);
//$kardex=$resultadoKardex->fetch_assoc();

//verificamos la categoria del kardex


//if($conexion->query($insertar) === TRUE){
//    echo '1';
//    $conexion->query($eliminar);
//}else{
//    echo '0';
//}
$conexion->close();
