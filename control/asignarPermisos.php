<?php

include '../conexion.php';

//reciviendo datos del formulario
if (!(empty($_POST['sistema']))) {
    foreach ($_POST['sistema'] as $tema) {
        $consulta = "SELECT * FROM privilegio WHERE privilegioUsuario='" . $_POST['usuario'] . "' AND privilegioSistema='$tema'";
        $resultado = $conexion->query($consulta) or die($conexion->error);
        if ($resultado->num_rows > 0) {
            
        } else {
            $insertar = "INSERT INTO privilegio(privilegioUsuario, privilegioSistema) VALUES ('" . $_POST['usuario'] . "','$tema') ";
            $result = $conexion->query($insertar);
            
        }
    }
    echo '1';    
} else {
    echo '0';
}