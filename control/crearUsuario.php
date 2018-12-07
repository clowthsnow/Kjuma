<?php 

include '../conexion.php';

//reciviendo datos del formulario
$user = $_POST['usuario'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];

if (!isset($user) || !isset($nombre) || !isset($apellidos)) {
        header("location:../page-crear-usuario.php");
}
//Consulta para insertar
$insertar = "INSERT INTO usuario(usuarioId, usuarioNombre, usuarioApellidos, usuarioContra) VALUES ('$user', '$nombre', '$apellidos','12345')";

//Ejecutando consulta
//$resultado = $conexion->query($insertar) ;
if($conexion->query($insertar)==TRUE){
    echo '1';
    //echo "Registro exitoso";
        //header("location:../page-asignar-permisos-user.php?usuario=$user"."&nombre=$nombre"."&apellidos=$apellidos");
}else{
    echo '0';
    //echo "Error, nombre de usuario existente";
}
//$filas=mysqli_num_rows($resultado);
$conexion->close();


