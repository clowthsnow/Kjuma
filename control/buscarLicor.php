<?php

include '../conexion.php';

//reciviendo datos del formulario
$codigo = $_GET['codigo'];

if (!isset($codigo)) {
    header("location:../page-ingreso-mercaderia.php");
}

$buscar = "SELECT * FROM licor WHERE licorId='$codigo'";
$result = $conexion->query($buscar);
$licor;
$row=$result->fetch_assoc();
    $licor=$row['licorNombre'];


    echo "$licor";
$conexion->close();


