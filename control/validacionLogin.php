<?php

SESSION_START();
include '../conexion.php';

if (!isset($_SESSION['usuario'])) {
    //si no hay sesion activa 
    //reciviendo datos del formulario
    $user = $_POST['usuario'];
    $contra = $_POST['contra'];

    if (!isset($user) || !isset($contra)) {
        header("location:../index.php");
    }

    //Consulta para buscar
    $consulta = "SELECT * FROM usuario WHERE usuarioId='$user' AND usuarioContra='$contra'";

    //Ejecutando consulta
    $resultado = $conexion->query($consulta) or die($conexion->error);

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();
        if ($usuario['usuarioEstReg'] === "A") {
            $_SESSION['usuario'] = $usuario['usuarioId'];
            $nombres = $usuario['usuarioNombre'] . ' ' . $usuario['usuarioApellidos'];
            $_SESSION['usuarioNombres'] = $nombres;
            $usuarioID = $usuario['usuarioId'];
            $sqlPrivilegio = "SELECT * FROM privilegio WHERE privilegioUsuario='$usuarioID'";
            $permisos = $conexion->query($sqlPrivilegio) or die($conexion->error);
            //$permiso=array();
            while ($row = $permisos->fetch_assoc()) {
                $_SESSION['permisos'][] = $row['privilegioSistema'];
            }
            header("location:../index.php");
        }else{
            header("location:../page-login-error.php");
        }
    } else {
        header("location:../page-login-error.php");
    }
} else {
    //si hay sesion activa
    header("location:../index.php");
}
	
