<?php

include '../conexion.php';

//reciviendo datos del formulario
$origen = $_POST['origen'];
$destino = $_POST['barra'];
$tipo=$_POST['tipo'];
$licor=$_POST['licor'];
$stock=$_POST['stock'];
$stockBD=$_POST['stockBD'];
if (!isset($origen) || !isset($destino) || !isset($tipo) || !isset($licor)) {
    header("location:../page-moverSellada.php");
}
$nuevoStock=($stockBD*1.0)-($stock*1.0);

$resta="UPDATE gbarrasellada SET GBarraSelladaCantidad='$nuevoStock' WHERE GBarraSelladaId='$origen' AND GBarraSelladaLicor='$licor'";
//echo $resta;
$conexion->query($resta) or die($conexion->error);

$destinoFin=$tipo.$destino;

$multiplicador=1;
$licorBD="";
$idBD="";
$destinoBD="";
$cantidadBD="";
//echo $destino;
//echo $tipo;
if($tipo=="SK"){
    $destinoBD="gbarrasellada";
    $cantidadBD="GBarraSelladaCantidad";
    $idBD="GBarraSelladaId";
    $licorBD="GBarraSelladaLicor";
}elseif ($tipo=="JK") {
    $multiplicador=3;
    $destinoBD="gbarrajarra";
    $cantidadBD="GBarraJarraCantidad";
    $idBD="GBarraJarraId";
    $licorBD="GBarraJarraLicor";
}elseif ($tipo=="VK") {
    $multiplicador=12;
    $destinoBD="gbarravaso";
    $cantidadBD="GBarraVasoCantidad";
    $idBD="GBarraVasoId";
    $licorBD="GBarraVasoLicor";
}
//echo "<br>".$destinoBD;
$buscar="SELECT * FROM $destinoBD WHERE $idBD='$destinoFin' AND $licorBD='$licor' ";
//echo "<br>$buscar";
$resultadoDest=$conexion->query($buscar) or die($conexion->error);
$dest=$resultadoDest->fetch_assoc();
//print_r($dest);
$nuevoStock=$dest["$cantidadBD"]+($stock*$multiplicador);
//echo $nuevoStock;
$suma="UPDATE $destinoBD SET $cantidadBD='$nuevoStock'  WHERE $idBD='$destinoFin' AND $licorBD='$licor'";
//echo $suma;
//$actualiza="UPDATE licor SET licorNombre='$nombre', licorCategoria='$categoria' WHERE licorId='$id'";
if($conexion->query($suma) === TRUE){
    echo '1';
}else{
    echo '0';
}
$conexion->close();