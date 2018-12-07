<?php

require 'config.php';
$conexion = new mysqli($hostname, $username, $password, $database);
if (!$conexion) {
    echo "fallo la conexion";
} else {
    //echo "conexion exitosa";
}
