<?php

include '../conexion.php';
date_default_timezone_set('America/Lima');
$hoy = new DateTime();
//reciviendo datos del formulario
$usuario = $_POST['usuario'];
$hora = $_POST['hora'];
$fecha = $_POST['fecha'];
$proveedor = $_POST['cobrador'];
$codigoLicor = $_POST['codigo'];
$cantidadProd = $_POST['cantidad'];
$medida = $_POST['medida'];
$monto = $_POST['dinero'];
$discoteca = $_POST['discotecas'];
$descripcion = $_POST['descripcion'];
$tipoPago = $_POST['tipo'];
$estado = $_POST['estado'];
$cuotas = $_POST['cuotas'];
$hora=$hoy->format('H:i:s'); ;
/* echo $usuario;
  echo $hora;
  echo $fecha;
  echo $proveedor;
  echo $codigoLicor;
  echo $monto;
  echo $discoteca;
  echo $descripcion;
  echo $tipoPago;
  echo $estado;
  echo $cuotas;
 */
$nombreLic = $_POST['licor'];
//echo $nombreLic;
if (!isset($usuario) || !isset($fecha) || !isset($monto) || !isset($discoteca) || !isset($proveedor) || !isset($tipoPago) || !isset($estado) || !isset($cuotas)) {
    header("location:../page-ingreso-mercaderia.php");
}
//partir la fecha en dia, mes, año
#01-01-2011
#0123456789
$anio = substr($fecha, 0, 4);
$mes = substr($fecha, 5, 2);
$dia = substr($fecha, 8, 2);

//calcular las unidades
$cantidadUni = $cantidadProd * $medida;
//echo $cantidadUni;
//Generar el codigo  de proovedor
$codigo = "E";
$codcont = "";

$rs = $conexion->query("SELECT MAX(entradaId) AS id FROM entrada");
if ($row = $rs->fetch_assoc()) {
    $id = $row;
    $cod = $id['id'];
    if ($cod == NULL) {
        $codigo = $codigo . str_pad("1", 9, "0", STR_PAD_LEFT);
    } else {
        $codcont = substr($cod, 2);
        $codcont = $codcont + 1;
        $codigo = $codigo . str_pad($codcont, 9, "0", STR_PAD_LEFT);
    }
} else {
    $codigo = $codigo . str_pad("1", 9, "0", STR_PAD_LEFT);
}

//echo $codigo;
$insertar = "INSERT INTO gastoeconomico(gastoEconomicoDiscoteca, gastoEconomicoDinero, gastoEconomicoDia, gastoEconomicoMes, gastoEconomicoAnio, gastoEconomicoFecha, gastoEconomicoIdUsuario, gastoEconomicoDescripcion, gastoEconomicoCobrador, gastoEconomicoTipo, gastoEconomicoEstado, gastoEconomicoCuotas) VALUES ('$discoteca', '$monto', '$dia','$mes', '$anio','$fecha', '$usuario', '$descripcion', '$proveedor', '$tipoPago', '$estado', '$cuotas')";
;
$insertar2 = "INSERT INTO entrada (entradaId, entradaDia, entradaMes, entradaAnio, entradaFecha, entradaHora, entradaIdUsuario, entradaIdProveedor, entradaIdLicor, entradaCantidad, entradaPrecio) VALUES"
        . "('$codigo', '$dia', '$mes', '$anio','$fecha','$hora', '$usuario', '$proveedor', '$codigoLicor', '$cantidadUni','$monto')";
if ($conexion->query($insertar) == TRUE && $conexion->query($insertar2) == TRUE) {
    $precioUni=$monto*1.0/$cantidadUni*1.0;
    echo "<tr>
            <td>$nombreLic</td>
            <td>$cantidadUni</td>
            <td>$monto</td>
            <td>$precioUni</td>
            <td><a href=\"control/eliminarIngresoMercaderia.php?codigo=$codigo\" class=\"borrar\"><span class=\"task-cat red\">Eliminar</span></a></td>
          </tr>";
    //echo "Registro exitoso";
    //header("location:../page-asignar-permisos-user.php?usuario=$user"."&nombre=$nombre"."&apellidos=$apellidos");
} else {
    echo '0';
    //echo "Error, nombre de usuario existente";
}
$conexion->close();

