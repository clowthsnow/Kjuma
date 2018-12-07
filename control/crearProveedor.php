<?php

include '../conexion.php';

//reciviendo datos del formulario
$proveedor = $_POST['nombre'];
$ruc = $_POST['ruc'];
$categoria=$_POST['categorias'];
if (!isset($proveedor) || !isset($categoria)) {
    header("location:../page-crear-proveedor.php");
}
//Generar el codigo  de proovedor
$codigo = "PR";
$codcont = "";

$rs = $conexion->query("SELECT MAX(proveedorId) AS id FROM proveedor");
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


$insertar="INSERT INTO proveedor(proveedorId, proveedorNombre, proveedorRuc, proveedorCategoria) VALUES ('$codigo', '$proveedor', '$ruc','$categoria')";

if($conexion->query($insertar)==TRUE){
    echo '1';
    //echo "Registro exitoso";
        //header("location:../page-asignar-permisos-user.php?usuario=$user"."&nombre=$nombre"."&apellidos=$apellidos");
}else{
    echo '0';
    //echo "Error, nombre de usuario existente";
}
$conexion->close();


