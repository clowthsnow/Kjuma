<?php

include '../conexion.php';

//reciviendo datos del formulario
$fechaI = $_POST['fechaI'];
$discoteca = $_POST['discotecas'];
if (!isset($fechaI)  || !isset($discoteca) ) {
    header("location:../page-filtrar-gastos.php");
}
//partir la fecha en dia, mes, año
#01-01-2011
#0123456789
//echo $discoteca;
$diaI = substr($fechaI, 0, 2);
$mesI = substr($fechaI, 3, 2);
$anioI = substr($fechaI, 6, 4);




$total = 0;

$buscar = "SELECT gastoeconomico.*, discoteca.discotecaNombre , usuario.usuarioNombre, proveedor.proveedorNombre "
        . "FROM gastoeconomico "
        . "LEFT JOIN discoteca ON gastoeconomico.gastoEconomicoDiscoteca=discoteca.discotecaId "
        . "LEFT JOIN usuario ON gastoeconomico.gastoEconomicoIdUsuario=usuario.usuarioId  "
        . "LEFT JOIN proveedor ON gastoeconomico.gastoEconomicoCobrador=proveedor.proveedorId "
        . " WHERE gastoEconomicoDia='$diaI' AND gastoEconomicoMes='$mesI' AND gastoEconomicoAnio='$anioI'";
//echo $buscar;
if ($discoteca !== "ambas") {
    $buscar = $buscar . " AND gastoEconomicoDiscoteca='$discoteca'";
    
    //echo $buscar;
}
//echo $buscar;
echo "<div class = \"col s12 m12 l12\">
<table id = \"data-table-row-simple\" class =  \"responsive-table display \" cellspacing = \"0\" width = \"100%\">
<thead>
<tr>

<th>Fecha</th>
<th>Discoteca</th>
<th>Para</th>
<th>Descripcion</th>
<th>Monto</th>
<th>Usuario</th>

</tr>
</thead>



<tbody id = >

";
$resultado = $conexion->query($buscar) or die($conexion->error);
while ($fila = $resultado->fetch_assoc()) {
//    print_r($fila);
//    echo "<br>"
    echo "<tr>"
    . "<td>" . $fila['gastoEconomicoDia'] . "-" . $fila['gastoEconomicoMes'] . "-" . $fila['gastoEconomicoAnio'] . "</td>"
    . "<td>" . $fila['discotecaNombre'] . "</td>"
    . "<td>" . $fila['proveedorNombre'] . "</td>"   
    . "<td>" . $fila['gastoEconomicoDescripcion'] . "</td>"
    . "<td>" . $fila['gastoEconomicoDinero'] . "</td>"
    . "<td>" . $fila['usuarioNombre'] . "</td>"
    . "</tr>";
    $total = $total + ($fila['gastoEconomicoDinero'] * 1.0);
}
echo "</tbody>
</table>
</div>
<br><br><br>
<div class=\"divider\"></div>

<div class=\"col s12 l12 m12\">
<div class=\" center\" style=\"margin-top:40px;\">Total: S/. " . $total . "</div>

</div>";
