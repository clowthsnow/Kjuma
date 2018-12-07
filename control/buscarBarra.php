<?php

include '../conexion.php';

//reciviendo datos del formulario
$codigo = $_GET['codigo'];

if (!isset($codigo)) {
    header("location:../page-ingreso-mercaderia.php");
}

$buscar = "SELECT * FROM barra WHERE barraDiscoteca='$codigo'";
$result = $conexion->query($buscar);

while($row=$result->fetch_assoc()){
    echo "<option value=".$row['barraId'].">".$row['barraNombre']."</option>";
}
$conexion->close();

