<?php

include '../conexion.php';

//reciviendo datos del formulario
$barra = $_POST['barra'];
$fecha = $_POST['fecha'];
$encargado = $_POST['nombreencargado'];
if (!isset($barra) || !isset($fecha) || !isset($encargado)) {
    header("location:../page-crear-KardexDiario.php");
}
//partir la fecha en dia, mes, año
#01-01-2011
#0123456789
//$dia = substr($fecha, 0, 2);
//$mes = substr($fecha, 3, 2);
//$anio = substr($fecha, 6, 4);

$anio = substr($fecha, 0, 4);
$mes = substr($fecha, 5, 2);
$dia = substr($fecha, 8, 2);

$kardex = "K" . $barra;

$selladas = "S" . $kardex;
$jarras = "J" . $kardex;
$vasos = "V" . $kardex;

$codigo = 0;
$codBD = "";


//nuevo kardex
$nuevo="INSERT INTO kardex (kardexDia, kardexMes, kardexAnio,kardexFecha, kardexEncargado, kardexBarra) VALUE ('$dia','$mes', '$anio','$fecha','$encargado','$barra')";

if($conexion->query($nuevo)==TRUE){
    echo '1';
    //echo "Registro exitoso";
        //header("location:../page-asignar-permisos-user.php?barra=$user"."&nombre=$nombre"."&apellidos=$apellidos");
}else{
    echo '0';
    //echo "Error, nombre de barra existente";
}
$rs = $conexion->query("SELECT MAX(kardexId) AS id FROM kardex");
if ($row = $rs->fetch_assoc()) {
    $id = $row;
    $cod = $id['id'];
    if ($cod == NULL) {
        $codigo = 1;
    } else {
        $codigo = $cod ;
    }
} else {
    $codigo = 0;
}



$buscarSelladas = "SELECT * FROM gbarrasellada WHERE GBarraSelladaId='$selladas'";
$resultadoSelladas = $conexion->query($buscarSelladas);
if ($resultadoSelladas->num_rows > 0) {
    $codigoSelladas = "D" . $selladas;
    $codigoSelladas = $codigoSelladas . str_pad($codigo, 38, "0", STR_PAD_LEFT);
    while ($fila = $resultadoSelladas->fetch_assoc()) {
        $licor = $fila['GBarraSelladaLicor'];
        $stock = $fila['GBarraSelladaCantidad'];
        $copiarSelladas = "INSERT INTO kardexsellada(KardexSelladaId, KardexSelladaLicor,KardexSelladaInicio) VALUES ('$codigoSelladas','$licor','$stock')";
        $conexion->query($copiarSelladas);
    }
    $ponerS="UPDATE kardex SET kardexSellada='$codigoSelladas' WHERE kardexId='$codigo'";
    $conexion->query($ponerS);
} else {
    
}

$buscarJarras = "SELECT * FROM gbarrajarra WHERE GBarraJarraId='$jarras'";
$resultadoJarras = $conexion->query($buscarJarras);
if ($resultadoJarras->num_rows > 0) {
    $codigoJarras = "D" . $jarras;
    $codigoJarras = $codigoJarras . str_pad($codigo, 38, "0", STR_PAD_LEFT);
    while ($fila = $resultadoJarras->fetch_assoc()) {
        $licor = $fila['GBarraJarraLicor'];
        $stock = $fila['GBarraJarraCantidad'];
        $copiarJarras = "INSERT INTO kardexjarra(KardexJarraId, KardexJarraLicor,KardexJarraInicio) VALUES ('$codigoJarras','$licor','$stock')";
        $conexion->query($copiarJarras);
    }
    $ponerJ="UPDATE kardex SET kardexJarra='$codigoJarras' WHERE kardexId='$codigo'";
    $conexion->query($ponerJ);
} else {
    
}

$buscarVasos = "SELECT * FROM gbarravaso WHERE GBarraVasoId='$vasos'";
$resultadoVasos = $conexion->query($buscarVasos);
if ($resultadoVasos->num_rows > 0) {
    $codigoVasos = "D" . $vasos;
    $codigoVasos = $codigoVasos . str_pad($codigo, 38, "0", STR_PAD_LEFT);
    while ($fila = $resultadoVasos->fetch_assoc()) {
        $licor = $fila['GBarraVasoLicor'];
        $stock = $fila['GBarraVasoCantidad'];
        $copiarVasos = "INSERT INTO kardexvaso(KardexVasoId, KardexVasoLicor,KardexVasoInicio) VALUES ('$codigoVasos','$licor','$stock')";
        $conexion->query($copiarVasos);
    }
    $ponerV="UPDATE kardex SET kardexVaso='$codigoVasos' WHERE kardexId='$codigo'";
    $conexion->query($ponerV);
} else {
    
}



$conexion->close();
