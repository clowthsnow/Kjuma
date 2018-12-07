<?php

include '../conexion.php';

//reciviendo datos del formulario
$fechaI = $_POST['fecha'];
if (!isset($fechaI)) {
    header("location:../page-verfecha-kardexDiario.php");
}
//partir la fecha en dia, mes, año
#01-01-2011
#0123456789
//echo $discoteca;
$diaI = substr($fechaI, 0, 2);
$mesI = substr($fechaI, 3, 2);
$anioI = substr($fechaI, 6, 4);


//$buscar = "SELECT gastoeconomico.*, discoteca.discotecaNombre , usuario.usuarioNombre "
//        . "FROM gastoeconomico "
//        . "LEFT JOIN discoteca ON gastoeconomico.gastoEconomicoDiscoteca=discoteca.discotecaId "
//        . "LEFT JOIN usuario ON gastoeconomico.gastoEconomicoIdUsuario=usuario.usuarioId  "
//        . " WHERE (gastoEconomicoAnio BETWEEN $anioI AND $anioF) "
//        . "AND (gastoEconomicoMes BETWEEN $mesI AND $mesF)"
//        . "AND (gastoEconomicoDia BETWEEN $diaI AND $diaF)"
//        . "AND gastoEconomicoCobrador = '$descripcion' ";

$buscar = "SELECT kardex.*, discoteca.discotecaNombre, barra.barraNombre "
        . "FROM kardex "
        . "LEFT JOIN barra ON kardex.kardexBarra=barra.barraId "
        . "LEFT JOIN discoteca ON barra.barraDiscoteca=discoteca.discotecaId "
        . "WHERE kardexAnio='$anioI' AND kardexMes='$mesI' AND kardexDia='$diaI'";

//$resultado = $conexion->query($buscar) or die($conexion->error);
//while ($fila = $resultado->fetch_assoc()) {
//    print_r($fila);
//}
//echo $buscar;
$dinero = "OK";
$color = "green";


//echo $buscar;
echo "<div class = \"col s12 m12 l12\">
<table id = \"data-table-row-simple\" class =  \"responsive-table display \" cellspacing = \"0\" width = \"100%\">
<thead>
<tr>

<th>Fecha</th>
<th>Discoteca</th>
<th>Barra</th>
<th>Encargado</th>
<th>Dinero</th>
<th>Estado</th>
<th>Ver</th>

</tr>
</thead>



<tbody id = >

";
$resultado = $conexion->query($buscar) or die($conexion->error);
while ($fila = $resultado->fetch_assoc()) {
    $estatus = "Cerrado";
    $colo2 = "green";
    if ($fila['kardexEstadoCuadre'] < 0) {
        $dinero = "Faltante";
        $color = "red";
    }
    if ($fila['kardexEstadoCuadre'] > 0) {
        $dinero = "Sobrante";
    }
    if ($fila['kardexEstado'] == 0) {
        $estatus = "Abierto";
        $colo2 = "red";
    }
//    print_r($fila);
    echo $dinero;
    echo "<tr>"
    . "<td>" . $fila['kardexDia'] . "-" . $fila['kardexMes'] . "-" . $fila['kardexAnio'] . "</td>"
    . "<td>" . $fila['discotecaNombre'] . "</td>"
    . "<td>" . $fila['barraNombre'] . "</td>"
    . "<td>" . $fila['kardexEncargado'] . "</td>"
    . "<td> <span class=\"task-cat " . $color . "\">" . $dinero . "</td>"
    . "<td> <span class=\"task-cat " . $colo2 . "\">" . $estatus . "</td>"
    . "<td> <a href=\"page-ver-kardex-kardexControl.php?kardex=" . $fila['kardexId'] . "\" target=\"_blank\">Ver</a></td>"
    . "</tr>";
}
echo "</tbody>
</table>
</div>


</div>";
