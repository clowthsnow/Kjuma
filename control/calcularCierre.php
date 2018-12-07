<?php

include '../conexion.php';
$kardex = $_GET['kardex'];
$descuento=$_GET['descuento'];
$visa=$_GET['visa'];
$master=$_GET['master'];
$dinero=$_GET['dinero'];
$coctel=$_GET['coctel'];
if (!isset($kardex)) {
    header("location:../page-cerrar-kardex.php");
}
//buscamos kardex y discotecaId
$buscarK = "SELECT kardex.*, barra.barraDiscoteca FROM kardex "
        . "LEFT JOIN barra ON kardex.kardexBarra=barra.barraId"
        . " WHERE kardexId='$kardex'";
//echo $buscarK;
$resultadoK = $conexion->query($buscarK);
$kardex = $resultadoK->fetch_assoc();
print_r($kardex);
echo "<br>";
echo "<br>";
$carta = "SC" . $kardex['barraDiscoteca'];
$cartaJ="JC". $kardex['barraDiscoteca'];
$cartaV="VC". $kardex['barraDiscoteca'];
echo $carta;
echo "<br>";
$selladasN = 0;
$gaseosas = 0;
$aguas = 0;
$totalSelladas = 0;
$descuentoGaseosa = 0;
$descuentoAgua = 0;
$totalJarras = 0;
$totalVasos = 0;

$total=0;
$totalEfectivo=0;

if ($kardex['kardexSellada'] != "") {
    //buscamos selladas
    $buscarSelladas = "SELECT kardexsellada.*, licor.licorNombre, categoriaLicor.categoriaLicorNombre, cartasellada.cartaSelladaPrecio "
            . " FROM kardexsellada "
            . "LEFT JOIN cartasellada ON  kardexsellada.KardexSelladaLicor=cartasellada.cartaSelladaLicor AND cartasellada.cartaSelladaId='$carta'"
            . "LEFT JOIN licor ON kardexsellada.KardexSelladaLicor=licor.licorId "
            . "LEFT JOIN categoriaLicor ON licor.licorCategoria=categoriaLicor.categoriaLicorId"
            . " WHERE KardexSelladaId='" . $kardex['kardexSellada'] . "'";
//echo $buscarSelladas;
    $resultado = $conexion->query($buscarSelladas) or die($conexion->error);
    while ($fila = $resultado->fetch_assoc()) {
        $totalSelladas = $totalSelladas + (($fila['KardexSelladaVenta'] * 1.0) * ($fila['cartaSelladaPrecio'] * 1.0));
        if ($fila['categoriaLicorNombre'] == "Pisco" || $fila['categoriaLicorNombre'] == "Ron" || $fila['categoriaLicorNombre'] == "Vodka") {

            $selladasN = $selladasN + $fila['KardexSelladaVenta'];
        }
        if ($fila['licorNombre'] == "Pepsi" || $fila['licorNombre'] == "7Up" || $fila['licorNombre'] == "Tampico"  ) {
            $gaseosas = $gaseosas + $fila['KardexSelladaVenta'];
        }
        if ($fila['categoriaLicorNombre'] == "Whisky") {
            $aguas = $aguas + ($fila['KardexSelladaVenta'] * 2);
        }

        print_r($fila);
        echo "<br>";
        echo $totalSelladas;
        echo "<br>";
    }
    echo "<br>";
    echo $totalSelladas;

//$gaseosas=$gaseosas;
    echo "<br>";
    echo "gaseosas:" . $gaseosas;
    echo "<br>";
    echo "selladas" . $selladasN;
    echo "<br>";
    echo "aguas ".$aguas;
    if ($selladasN >= $gaseosas) {
        $descuentoGaseosa = $gaseosas * 10;
    } elseif ($selladasN < $gaseosas) {
        $descuentoGaseosa = $selladasN * 10;
    }
    $descuentoAgua = $aguas * 4;
    echo "<br>";
    echo $descuentoGaseosa;
    echo "<br>";
    echo $descuentoAgua;
}
echo "<br>";
echo "<br>";
echo "<br>";
echo "jarras";
echo "<br>";
if($kardex['kardexJarra']!=""){
    //buscamos jarra
    $buscarJarras = "SELECT kardexjarra.*, licor.licorNombre, categoriaLicor.categoriaLicorNombre, cartajarra.cartaJarraPrecio "
            . " FROM kardexjarra "
            . "LEFT JOIN cartajarra ON  kardexjarra.KardexJarraLicor=cartajarra.cartaJarraLicor AND cartajarra.cartaJarraId='$cartaJ'"
            . "LEFT JOIN licor ON kardexjarra.KardexJarraLicor=licor.licorId "
            . "LEFT JOIN categoriaLicor ON licor.licorCategoria=categoriaLicor.categoriaLicorId"
            . " WHERE KardexJarraId='" . $kardex['kardexJarra'] . "'";
//echo $buscarjarras;
    $resultado = $conexion->query($buscarJarras) or die($conexion->error);
    while ($fila = $resultado->fetch_assoc()) {
        $totalJarras = $totalJarras + (($fila['KardexJarraVenta'] * 1.0) * ($fila['cartaJarraPrecio'] * 1.0));
        print_r($fila);
        echo "<br>";
        echo $totalJarras;
        echo "<br>";
    }
    echo "<br>";
    echo $totalJarras;
    
}
echo "<br>";
echo "<br>";
echo "<br>";
echo "vasos";
echo "<br>";
if($kardex['kardexVaso']!=""){
    //buscamos jarra
    $buscarVasos = "SELECT kardexvaso.*, licor.licorNombre, categoriaLicor.categoriaLicorNombre, cartavaso.cartaVasoPrecio "
            . " FROM kardexvaso "
            . "LEFT JOIN cartavaso ON  kardexvaso.KardexVasoLicor=cartavaso.cartaVasoLicor AND cartavaso.cartaVasoId='$cartaV'"
            . "LEFT JOIN licor ON kardexvaso.KardexVasoLicor=licor.licorId "
            . "LEFT JOIN categoriaLicor ON licor.licorCategoria=categoriaLicor.categoriaLicorId"
            . " WHERE KardexVasoId='" . $kardex['kardexVaso'] . "'";
//echo $buscarjarras;
    $resultado = $conexion->query($buscarVasos) or die($conexion->error);
    while ($fila = $resultado->fetch_assoc()) {
        $totalVasos = $totalVasos + (($fila['KardexVasoVenta'] * 1.0) * ($fila['cartaVasoPrecio'] * 1.0));
        print_r($fila);
        echo "<br>";
        echo $totalVasos;
        echo "<br>";
    }
    echo "<br>";
    echo $totalVasos;
    
}

$total=$totalSelladas+$totalJarras+$totalVasos-$descuentoGaseosa;
$totalEfectivo=$total-$descuentoAgua-$descuento-$visa-$master+$coctel;
echo $total;
echo "<br>";
echo $totalEfectivo;

$estadoCuadre=$dinero-$totalEfectivo;
$guardarDinero = "UPDATE kardex SET kardexEstadoCuadre='$estadoCuadre',kardexDineroEntregado='$dinero',kardexTotal='$total',kardexMaster='$master', kardexDescuento='$descuento', kardexVisa='$visa', kardexGaseosas='$descuentoGaseosa', kardexAguas='$descuentoAgua', kardexTotalEfectivo='$totalEfectivo', kardexCoctel='$coctel' WHERE kardexId='" . $kardex['kardexId'] . "'";
$resultadoDinero = $conexion->query($guardarDinero) or die($conexion->error);
