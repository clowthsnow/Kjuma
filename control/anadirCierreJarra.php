<?php

include '../conexion.php';
$licor = $_GET['licor'];
$fin=$_GET['fin'];
$dataBase=$_GET['bd'];
$discoteca=$_GET['disco'];
//echo $licor;
//echo "olis";
//echo "<br>";
//echo $fin ;
//echo $discoteca;
//echo $dataBase;

if (!isset($licor) || !isset($fin) || !isset($dataBase)) {
        header("location:../page-cerrar-kardex.php");
}
//$cartaID="J".$codigo;
//$insertar="INSERT INTO gbarrajarra(GBarraJarraId, GBarraJarraLicor, GBarraJarraCantidad) VALUES ('$cartaID','$licor','$stock')";
//
//$eliminar="UPDATE kardexgbarra SET KardexGBarraJarras='$cartaID' WHERE KardexGBarraId='$codigo'";
//buscamos en el kardex el inicio aumento
$buscar="SELECT * FROM kardexjarra WHERE KardexJarraId='$dataBase' AND KardexJarraLicor=$licor";
$resultadoBuscar=$conexion->query($buscar);
$fila=$resultadoBuscar->fetch_assoc();

;
print_r($fila);
//calculamos venras
echo "<br>";
echo $fin;
echo "<br>";
echo $fila['KardexJarraInicio'];
echo "<br>";
echo $fila['KardexJarraAumento'];
$venta=($fila['KardexJarraInicio']*1.0)+($fila['KardexJarraAumento']*1.0)-($fin*1.0);
echo "<br>";
echo $venta;
//escrbimos ventas y fin
$update="UPDATE kardexjarra SET KardexJarraFinal='$fin' , KardexJarraVenta=$venta WHERE KardexJarraId='$dataBase' AND KardexJarraLicor='$licor'";
$conexion->query($update) or die($conexion->error);


$conexion->close();

