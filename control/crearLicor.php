<?php

include '../conexion.php';

//reciviendo datos del formulario
$codigo=$_POST['codigo'];
$nombre = $_POST['nombrelicor'];
$categoria=$_POST['categoria'];

if (!isset($nombre) || !isset($codigo) || !isset($categoria)) {
    header("location:../page-crear-licor.php");
}

$insertar="INSERT INTO licor(licorId, licorNombre, licorCategoria) VALUES ('$codigo', '$nombre', '$categoria')";

if($conexion->query($insertar)==TRUE){
    echo '1';
    //echo "Registro exitoso";
        //header("location:../page-asignar-permisos-user.php?usuario=$user"."&nombre=$nombre"."&apellidos=$apellidos");
}else{
    echo '0';
    //echo "Error, nombre de usuario existente";
}
$conexion->close();



