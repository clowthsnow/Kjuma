<?php

include '../conexion.php';

//reciviendo datos del formulario
$origen = $_POST['origen'];
$destino = $_POST['barra'];
$tipo = $_POST['tipo'];
$licor = $_POST['licor'];
$stock = $_POST['stock'];
$stockBD = $_POST['stockBD'];
if (!isset($origen) || !isset($destino) || !isset($tipo) || !isset($licor)) {
    header("location:../page-moverSellada.php");
}
$onzas = $stock * 8.0;
//echo $onzas;
//echo $tipo;
$destinoFin = $tipo . $destino;

$multiplicador = 3;
$licorBD = "";
$idBD = "";
$destinoBD = "";
$cantidadBD = "";
//echo $destino;
//echo $tipo;
if ($tipo == "SK") {
    $destinoBD = "gbarrasellada";
    $cantidadBD = "GBarraSelladaCantidad";
    $idBD = "GBarraSelladaId";
    $licorBD = "GBarraSelladaLicor";
} elseif ($tipo == "JK") {
    $multiplicador = 1;
    $destinoBD = "gbarrajarra";
    $cantidadBD = "GBarraJarraCantidad";
    $idBD = "GBarraJarraId";
    $licorBD = "GBarraJarraLicor";
} elseif ($tipo == "VK") {
    $multiplicador = 4;
    $destinoBD = "gbarravaso";
    $cantidadBD = "GBarraVasoCantidad";
    $idBD = "GBarraVasoId";
    $licorBD = "GBarraVasoLicor";
}


if ($onzas % $multiplicador == 0) {
    $nuevoStock = ($stockBD * 1.0) - ($stock * 1.0);

    $resta = "UPDATE gbarrajarra SET GBarraJarraCantidad='$nuevoStock' WHERE GBarraJarraId='$origen' AND GBarraJarraLicor='$licor'";
//echo $resta;
    $conexion->query($resta) or die($conexion->error);


//echo "<br>".$destinoBD;
    $buscar = "SELECT * FROM $destinoBD WHERE $idBD='$destinoFin' AND $licorBD='$licor' ";
//echo "<br>$buscar";
    $resultadoDest = $conexion->query($buscar) or die($conexion->error);
    $dest = $resultadoDest->fetch_assoc();
//print_r($dest);
    $nuevoStock = $dest["$cantidadBD"] + ($stock * $multiplicador);
    if($tipo=="SK"){
//        echo 'OLI';
        $nuevoStock = $dest["$cantidadBD"] + ($stock / $multiplicador);
    }
    
//echo $nuevoStock;
    $suma = "UPDATE $destinoBD SET $cantidadBD='$nuevoStock'  WHERE $idBD='$destinoFin' AND $licorBD='$licor'";

//echo $suma;
//$actualiza="UPDATE licor SET licorNombre='$nombre', licorCategoria='$categoria' WHERE licorId='$id'";
    if ($conexion->query($suma) === TRUE) {
        echo '1';
    } else {
        echo '0';
    }
}else{
    echo '2';
}

$conexion->close();
