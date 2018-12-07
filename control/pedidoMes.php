<?php

include '../conexion.php';

//reciviendo datos del formulario
$fechaI = $_POST['mes'];
$discotecas=$_POST['discotecas'];
if (!isset($fechaI)) {
    header("location:../page-verMes-kardexDiario.php");
}

$licores = array();

$buscarLicor = "SELECT licor.*, categorialicor.categoriaLicorNombre FROM licor "
        . "LEFT JOIN  categorialicor ON licor.licorCategoria=categorialicor.categoriaLicorId";
$ejec = $conexion->query($buscarLicor) or die($conexion->error);
while ($row = $ejec->fetch_assoc()) {
//    echo '0l';
    $indice = $row['licorId'];
    $licores["$indice"] = 0;
    $nombres = $indice . "N";
    $licores["$nombres"] = $row['licorNombre'];
    $categoria = $indice . "C";
    $licores["$categoria"] = $row['categoriaLicorNombre'];
}
//print_r($licores);
$buscar = "SELECT kardex.*, discoteca.discotecaNombre, barra.barraNombre "
        . "FROM kardex "
        . "LEFT JOIN barra ON kardex.kardexBarra=barra.barraId "
        . "LEFT JOIN discoteca ON barra.barraDiscoteca=discoteca.discotecaId "
        . "WHERE kardexMes='$fechaI' ";
if($discotecas!="ambas"){
    $buscarDisc="SELECT * FROM barra WHERE barraDiscoteca='$discotecas'";
    $ejeDis=$conexion->query($buscarDisc) or die($conexion->error);
//    $buscar=$buscar." AND (kardexBarra="
    $sente="(";
    while($fila=$ejeDis->fetch_assoc()){
        $sente=$sente."kardexBarra='".$fila['barraId']."' OR ";
    }
    $sente= substr($sente,0, -3).")";
    $buscar=$buscar." AND ".$sente;
//    echo $buscar;
}

//echo $buscar;
//$resultado = $conexion->query($buscar) or die($conexion->error);
//while ($fila = $resultado->fetch_assoc()) {
//    print_r($fila);
//}
//echo $buscar;
$resultado = $conexion->query($buscar) or die($conexion->error);
while ($fila = $resultado->fetch_assoc()) {

//    echo "<br>";
//    print_r($fila);
    if ($fila['kardexSellada'] != "") {
        $busqueda = "SELECT * FROM kardexsellada WHERE KardexSelladaId='" . $fila['kardexSellada'] . "'";
        $ejecutar = $conexion->query($busqueda) or die($conexion->error);
        while ($row = $ejecutar->fetch_assoc()) {
            $ind = $row['KardexSelladaLicor'];
            $licores["$ind"] = $licores["$ind"] + $row['KardexSelladaVenta'];
        }
    }
    if ($fila['kardexJarra'] != "") {
        $busqueda = "SELECT * FROM kardexjarra WHERE KardexJarraId='" . $fila['kardexJarra'] . "'";
        $ejecutar = $conexion->query($busqueda) or die($conexion->error);
        while ($row = $ejecutar->fetch_assoc()) {
            $ind = $row['KardexJarraLicor'];
            $licores["$ind"] = $licores["$ind"] + ($row['KardexJarraVenta'] / 3.0);
        }
    }
    if ($fila['kardexVaso'] != "") {
        $busqueda = "SELECT * FROM kardexvaso WHERE KardexVasoId='" . $fila['kardexVaso'] . "'";
        $ejecutar = $conexion->query($busqueda) or die($conexion->error);
        while ($row = $ejecutar->fetch_assoc()) {
            $ind = $row['KardexVasoLicor'];
            $licores["$ind"] = $licores["$ind"] + ($row['KardexVasoVenta'] / 12.0);
        }
    }
}
//print_r($licores);


echo "<div class = \"col s12 m12 l12\">
<table id = \"data-table-row-grouping\" class =  \"responsive-table display \" cellspacing = \"0\" width = \"100%\">
<thead>
<tr>

<th>Licor</th>
<th>Venta Total</th>
<th>Categoria</th>

</tr>
</thead>



<tbody id = >

";
$buscarLicor = "SELECT * FROM licor";
$ejec = $conexion->query($buscarLicor) or die($conexion->error);
while ($row = $ejec->fetch_assoc()) {
//    echo '0l';
    $indice = $row['licorId'];
//    echo $licores["$indice"];
    $nombres = $indice . "N";
//    echo $licores["$nombres"] ;
    $categoria = $indice . "C";
//    $licores["$categ "<td>" . $licores["$indice"] . "</td>"oria"];

    echo "<tr>"
    . "<td>" . $licores["$nombres"] . "</td>"
    . "<td>" . $licores["$indice"] . "</td>"
    . "<td>" . $licores["$categoria"] . "</td>"
    . "</tr>";
}
echo "</tbody>
</table>
</div>


</div>";











//
//
//
//
//
//$dinero = "OK";
//$color = "green";
//
//
////echo $buscar;
//echo "<div class = \"col s12 m12 l12\">
//<table id = \"data-table-row-simple\" class =  \"responsive-table display \" cellspacing = \"0\" width = \"100%\">
//<thead>
//<tr>
//
//<th>Fecha</th>
//<th>Discoteca</th>
//<th>Barra</th>
//<th>Encargado</th>
//<th>Dinero</th>
//<th>Estado</th>
//<th>Ver</th>
//
//</tr>
//</thead>
//
//
//
//<tbody id = >
//
//";
//$resultado = $conexion->query($buscar) or die($conexion->error);
//while ($fila = $resultado->fetch_assoc()) {
//    $estatus = "Cerrado";
//    $colo2 = "green";
//    if ($fila['kardexEstadoCuadre'] < 0) {
//        $dinero = "Faltante";
//        $color = "red";
//    }
//    if ($fila['kardexEstadoCuadre'] > 0) {
//        $dinero = "Sobrante";
//    }
//    if ($fila['kardexEstado'] == 0) {
//        $estatus = "Abierto";
//        $colo2 = "red";
//    }
////    print_r($fila);
////    echo $dinero;
//    echo "<tr>"
//    . "<td>" . $fila['kardexDia'] . "-" . $fila['kardexMes'] . "-" . $fila['kardexAnio'] . "</td>"
//    . "<td>" . $fila['discotecaNombre'] . "</td>"
//    . "<td>" . $fila['barraNombre'] . "</td>"
//    . "<td>" . $fila['kardexEncargado'] . "</td>"
//    . "<td> <span class=\"task-cat " . $color . "\">" . $dinero . "</td>"
//    . "<td> <span class=\"task-cat " . $colo2 . "\">" . $estatus . "</td>"
//    . "<td> <a href=\"page-ver-kardex-kardexControl.php?kardex=" . $fila['kardexId'] . "\" target=\"_blank\">Ver</a></td>"
//    . "</tr>";
//}
//echo "</tbody>
//</table>
//</div>
//
//
//</div>";
