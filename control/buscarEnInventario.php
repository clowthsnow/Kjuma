<?php

include '../conexion.php';

//reciviendo datos del formulario
$codigo = $_GET['codigo'];

if (!isset($codigo)) {
    header("location:../page-salida-mercaderia.php");
}

$buscar = "SELECT * FROM inventariogeneraldetalle WHERE inventarioGeneralDetalleLicor='$codigo'";
$result = $conexion->query($buscar);
$buscar2 = "SELECT * FROM licor WHERE licorId='$codigo'";
$result2 = $conexion->query($buscar2);
$row=$result->fetch_assoc();
$fila=$result2->fetch_assoc();
    $licor=array("licor"=>$fila['licorNombre'],"stock"=>$row['inventarioGeneralDetalleCantidad']);

    //print_r($licor);
    echo json_encode($licor);

$conexion->close();


