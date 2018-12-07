<?php

include '../conexion.php';

//reciviendo datos del formulario
$user = $_POST['usuario'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];

$permisos = "SELECT * FROM privilegio WHERE privilegioUsuario='$user'";
$res = $conexion->query($permisos);
while ($fila = $res->fetch_assoc()) {
    $actual[] = $fila['privilegioSistema'];
}

if (!isset($user) || !isset($nombre) || !isset($apellidos)) {
    header("location:../page-ver-usuarios.php");
}

if (!(empty($_POST['sistema']))) {
    $nuevo = $_POST['sistema'];
    if (count($actual) == count($nuevo)) {
        $insert=array_diff($nuevo, $actual);
        foreach ($insert as $ins) {
            $insertarNuevo1= "INSERT INTO privilegio(privilegioUsuario, privilegioSistema) VALUES ('" . $user . "','$ins') ";
            $result = $conexion->query($insertarNuevo1);
        }
        $delete= array_diff($actual, $nuevo);
        foreach ($delete as $del) {
            $borrarAnitguo1 = "DELETE FROM privilegio WHERE privilegioUsuario='$user' AND privilegioSistema='$del'";
            $result2 = $conexion->query($borrarAnitguo1);
        }
    }
    if (count($actual) < count($nuevo)) {
        $inserta = array_diff($nuevo, $actual);
        foreach ($inserta as $ins) {
            $insertarNuevo = "INSERT INTO privilegio(privilegioUsuario, privilegioSistema) VALUES ('" . $user . "','$ins') ";
            $result = $conexion->query($insertarNuevo);
        }
    } else {
        $borra = array_diff($actual, $nuevo);
        foreach ($borra as $del) {
            $borrarAnitguo = "DELETE FROM privilegio WHERE privilegioUsuario='$user' AND privilegioSistema='$del'";
            $result2 = $conexion->query($borrarAnitguo);
        }
    }
    $modificar="UPDATE usuario SET usuarioNombre='$nombre', usuarioApellidos='$apellidos' WHERE usuarioId='$user'";
    $conexion->query($modificar);
    
    echo '1';
} else {
    echo '0';
}