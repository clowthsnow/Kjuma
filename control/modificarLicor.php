<?php

include '../conexion.php';

//reciviendo datos del formulario
$id = $_POST['id'];
$nombre = $_POST['nombrelicor'];
$categoria=$_POST['categoria'];
if (!isset($id) || !isset($nombre) || !isset($categoria)) {
    header("location:../page-ver-licores.php");
}
$actualiza="UPDATE licor SET licorNombre='$nombre', licorCategoria='$categoria' WHERE licorId='$id'";
if($conexion->query($actualiza) === TRUE){
    echo '1';
}else{
    echo '0';
}
$conexion->close();