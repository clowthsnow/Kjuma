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
$buscar="SELECT * FROM kardexvaso WHERE KardexVasoId='$dataBase' AND KardexVasoLicor=$licor";
$resultadoBuscar=$conexion->query($buscar);
$fila=$resultadoBuscar->fetch_assoc();

;
print_r($fila);
//calculamos venras

$venta=($fila['KardexVasoInicio']*1.0)+($fila['KardexVasoAumento']*1.0)-($fin*1.0);

//escrbimos ventas y fin
$update="UPDATE kardexvaso SET KardexVasoFinal='$fin' , KardexVasoVenta=$venta WHERE KardexVasoId='$dataBase' AND KardexVasoLicor='$licor'";
$conexion->query($update) or die($conexion->error);


$conexion->close();

