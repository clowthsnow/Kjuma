<?php

include '../conexion.php';

//reciviendo datos del formulario
$nombre = $_POST['nombreproducto'];
$categoria=$_POST['categoria'];
if (!isset($nombre) || !isset($categoria)) {
    header("location:../page-crear-producto.php");
}
//Generar el codigo  de proovedor
$codigo = "P";
$codcont = "";

$rs = $conexion->query("SELECT MAX(productoId) AS id FROM producto");
if ($row = $rs->fetch_assoc()) {
    $id = $row;
    $cod = $id['id'];
    if ($cod == NULL) {
        $codigo = $codigo . str_pad("1", 5, "0", STR_PAD_LEFT);
    } else {
        $codcont = substr($cod, 1);
        $codcont = $codcont + 1;
        $codigo = $codigo . str_pad($codcont, 5, "0", STR_PAD_LEFT);
    }
} else {
    $codigo = $codigo . str_pad("1", 5, "0", STR_PAD_LEFT);
}


//$insertar="INSERT INTO producto (productoId, productoNombre, productoCategoria) VALUES ('$codigo', '$nombre',$categoria')";
$insertar="INSERT INTO producto(productoId, productoNombre, productoCategoria) VALUES ('$codigo', '$nombre', '$categoria')";

if($conexion->query($insertar)==TRUE){
    echo '1';
    //echo "Registro exitoso";
        //header("location:../page-asignar-permisos-user.php?usuario=$user"."&nombre=$nombre"."&apellidos=$apellidos");
}else{
    echo '0';
    //echo "Error, nombre de usuario existente";
}
$conexion->close();
