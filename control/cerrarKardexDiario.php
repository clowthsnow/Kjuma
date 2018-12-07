<?php
SESSION_START();
include '../conexion.php';

$user=$_SESSION['usuario'];

    
//reciviendo datos del formulario
$kardex = $_GET['kardex'];
if (!isset($kardex)) {
    header("location:../page-ver-KardexDiario.php");
}

//buscamos el kardex
$buscarKardex = "SELECT * FROM kardex WHERE kardexId='$kardex'";
$resultadoKardex = $conexion->query($buscarKardex);
$kardex = $resultadoKardex->fetch_assoc();
//print_r($kardex);



if ($kardex['kardexSellada'] != "") {

    $selladasGeneral = "SK" . $kardex['kardexBarra'];
    $selladas = $kardex['kardexSellada'];
    //Copiamos las selladas
    $buscarSelladas = "SELECT * FROM kardexsellada WHERE KardexSelladaId='$selladas'";
    $resultadoSelladas = $conexion->query($buscarSelladas);
    if ($resultadoSelladas->num_rows > 0) {
        while ($fila = $resultadoSelladas->fetch_assoc()) {
            $licor = $fila['KardexSelladaLicor'];
            $stock = $fila['KardexSelladaFinal'];
            $copiarSelladas = "UPDATE gbarrasellada SET GBarraSelladaCantidad='$stock' WHERE GBarraSelladaId='$selladasGeneral' AND GBarraSelladaLicor='$licor'";
            $conexion->query($copiarSelladas) or die($conexion->error);
        }
    } else {
        
    }
}

//copiamos las jarras
if ($kardex['kardexJarra'] != "") {
    $selladasJarra = "JK" . $kardex['kardexBarra'];
    $jarras = $kardex['kardexJarra'];
    //Copiamos las selladas
    $buscarSelladas = "SELECT * FROM kardexjarra WHERE KardexJarraId='$jarras'";
    $resultadoSelladas = $conexion->query($buscarSelladas);
    if ($resultadoSelladas->num_rows > 0) {
        while ($fila = $resultadoSelladas->fetch_assoc()) {
            $licor = $fila['KardexJarraLicor'];
            $stock = $fila['KardexJarraFinal'];
            $copiarSelladas = "UPDATE gbarrajarra SET GBarraJarraCantidad='$stock' WHERE GBarraJarraId='$selladasJarra' AND GBarraJarraLicor='$licor'";
            $conexion->query($copiarSelladas) or die($conexion->error);
        }
    } else {
        
    }
}

//copiamos los vasos
if ($kardex['kardexVaso'] != "") {
    $selladasVasos = "VK" . $kardex['kardexBarra'];
    $vasos = $kardex['kardexVaso'];
    //Copiamos las selladas
    $buscarSelladas = "SELECT * FROM kardexvaso WHERE KardexVasoId='$vasos'";
    $resultadoSelladas = $conexion->query($buscarSelladas);
    if ($resultadoSelladas->num_rows > 0) {
        while ($fila = $resultadoSelladas->fetch_assoc()) {
            $licor = $fila['KardexVasoLicor'];
            $stock = $fila['KardexVasoFinal'];
            $copiarSelladas = "UPDATE gbarravaso SET GBarraVasoCantidad='$stock' WHERE GBarraVasoId='$selladasVasos' AND GBarraVasoLicor='$licor'";
            $conexion->query($copiarSelladas) or die($conexion->error);
        }
    } else {
        
    }
    
    
}

//cerrar el kardex con estados
$cerrar="UPDATE kardex SET kardexEstado='1' WHERE kardexId='".$kardex['kardexId']."'";
$conexion->query($cerrar);

//registramos el ingreso
$buscarDisco="SELECT * FROM barra WHERE barraId='".$kardex['kardexBarra']."'";
$resultadoDisco=$conexion->query($buscarDisco);
$disco=$resultadoDisco->fetch_assoc();
//print_r($disco);
$monto=($kardex['kardexTotalEfectivo']*1.0)+($kardex['kardexVisa']*1.0)+($kardex['kardexMaster']*1.0);
$descripcion="Ingreso por venta de noche de la barra : ".$disco['barraNombre']." a cargo de ".$kardex['kardexEncargado']." Efectivo: S/.".$kardex['kardexTotalEfectivo']." Visa: S/.".$kardex['kardexVisa']." MasterCard: S/.".$kardex['kardexMaster'];
$ingresos="INSERT INTO ingresoeconomico (ingresoEconomicoDiscoteca, ingresoEconomicoDinero, ingresoEconomicoDia, ingresoEconomicoMes, ingresoEconomicoAnio, ingresoEconomicoIdUsuario, ingresoEconomicoDescripcion)"
        . " VALUES ('".$disco['barraDiscoteca']."', '".$monto."', '".$kardex['kardexDia']."', '".$kardex['kardexMes']."', '".$kardex['kardexAnio']."','$user', '$descripcion')";

$conexion->query($ingresos) or die($conexion->error);

$conexion->close();
