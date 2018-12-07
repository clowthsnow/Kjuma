<?php
SESSION_START();
include '../conexion.php';

$user=$_SESSION['usuario'];

    
//reciviendo datos del formulario
$kardex = $_GET['kardex'];
if (!isset($kardex)) {
    header("location:../page-ver-KardexDiario.php");
}

//buscamos el kardex
$buscarKardex = "SELECT * FROM kardex WHERE kardexId='$kardex'";
$resultadoKardex = $conexion->query($buscarKardex);
$kardex = $resultadoKardex->fetch_assoc();
//print_r($kardex);



//cerrar el kardex con estados
$cerrar="UPDATE kardex SET kardexEstado='1', kardexEstadoRegistro='*'  WHERE kardexId='".$kardex['kardexId']."'";
$conexion->query($cerrar) or die($conexion->error);



$conexion->close();
