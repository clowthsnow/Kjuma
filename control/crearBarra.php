<?php

include '../conexion.php';

//reciviendo datos del formulario
$nombre = $_POST['nombrebarra'];
$discoteca=$_POST['discotecas'];

if (!isset($nombre)) {
    header("location:../page-crear-barra.php");
}
//Generar el codigo  de proovedor
$codigo = "B";
$codcont = "";

$rs = $conexion->query("SELECT MAX(barraId) AS id FROM barra");
if ($row = $rs->fetch_assoc()) {
    $id = $row;
    $cod = $id['id'];
    if ($cod == NULL) {
        $codigo = $codigo . str_pad("1", 3, "0", STR_PAD_LEFT);
    } else {
        $codcont = substr($cod, 2);
        $codcont = $codcont + 1;
        $codigo = $codigo . str_pad($codcont, 3, "0", STR_PAD_LEFT);
    }
} else {
    $codigo = $codigo . str_pad("1", 3, "0", STR_PAD_LEFT);
}


$insertar="INSERT INTO barra(barraId, barraNombre, barraDiscoteca) VALUES ('$codigo', '$nombre','$discoteca')";

if($conexion->query($insertar)==TRUE){
    echo '1';
    //echo "Registro exitoso";
        //header("location:../page-asignar-permisos-user.php?usuario=$user"."&nombre=$nombre"."&apellidos=$apellidos");
}else{
    echo '0';
    //echo "Error, nombre de usuario existente";
}
$conexion->close();

