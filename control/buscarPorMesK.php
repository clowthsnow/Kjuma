<?php

include '../conexion.php';

//reciviendo datos del formulario
$fechaI = $_POST['mes'];
if (!isset($fechaI)) {
    header("location:../page-verMes-kardexDiario.php");
}





$buscar = "SELECT kardex.*, discoteca.discotecaNombre, barra.barraNombre "
        . "FROM kardex "
        . "LEFT JOIN barra ON kardex.kardexBarra=barra.barraId "
        . "LEFT JOIN discoteca ON barra.barraDiscoteca=discoteca.discotecaId "
        . "WHERE kardexMes='$fechaI' AND kardexEstadoRegistro='A' "
        . "ORDER BY kardex.kardexFecha DESC";
//echo $buscar;
//$resultado = $conexion->query($buscar) or die($conexion->error);
//while ($fila = $resultado->fetch_assoc()) {
//    print_r($fila);
//}
//echo $buscar;



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
	$dinero = "OK";
	$color = "green";
    $estatus = "Cerrado";
    $colo2 = "green";
    if ($fila['kardexEstadoCuadre'] < 0) {
        $dinero = "Faltante";
        $color = "red";
    }
    if ($fila['kardexEstadoCuadre'] > 0) {
        $dinero = "Sobrante";
	$color="green";
    }
    if ($fila['kardexEstado'] == 0) {
        $estatus = "Abierto";
        $colo2 = "red";
    }
//    print_r($fila);
//    echo $dinero;
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
