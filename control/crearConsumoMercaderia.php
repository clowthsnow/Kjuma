<?php
include '../conexion.php';
date_default_timezone_set('America/Lima');
$hoy = new DateTime();
//reciviendo datos del formulario
$usuario = $_POST['usuario'];
$hora = $_POST['hora'];
$fecha = $_POST['fecha'];
$medida = $_POST['medida'];
$codigoLicor = $_POST['codigo'];
$cantidadProd = $_POST['cantidad'];
$detalle = $_POST['info'];
//$discoteca = $_POST['discotecas'];
//$barra = $_POST['barra'];
//$uso = $_POST['uso'];
//$codigoSJV;
$hora = $hoy->format('H:i:s');
;

// echo $usuario;
//echo $hora;
//echo $fecha;
//echo $codigoLicor;
//echo $barra;
//echo $discoteca;
//  echo $medida;
//  echo $uso;


$nombreLic = $_POST['licor'];
$stockLic = $_POST['stock'];
//echo $nombreLic;
//echo $stockLic;
if (!isset($usuario) || !isset($fecha) || !isset($codigoLicor) || !isset($cantidadProd) || !isset($hora)) {
    header("location:../page-consumo.php");
}
//partir la fecha en dia, mes, año
#01-01-2011
#0123456789
$dia = substr($fecha, 0, 4);
$mes = substr($fecha, 5, 2);
$anio = substr($fecha, 8, 2);

//calcular las unidades
$cantidadUni = $cantidadProd * $medida;
//echo $cantidadUni;
//Generar el codigo  de proovedor
$codigo = "S";
$codcont = "";

//$rs = $conexion->query("SELECT MAX(salidaId) AS id FROM salida");
//if ($row = $rs->fetch_assoc()) {
//    $id = $row;
//    $cod = $id['id'];
//    if ($cod == NULL) {
//        $codigo = $codigo . str_pad("1", 9, "0", STR_PAD_LEFT);
//    } else {
//        $codcont = substr($cod, 2);
//        $codcont = $codcont + 1;
//        $codigo = $codigo . str_pad($codcont, 9, "0", STR_PAD_LEFT);
//    }
//} else {
//    $codigo = $codigo . str_pad("1", 9, "0", STR_PAD_LEFT);
//}
if ($cantidadUni <= $stockLic) {
//    echo $codigo;
    //creamos una nueva salida
    $insertar = "INSERT INTO consumodeposito(consumoDepositoLicor, consumoDepositoFecha, consumoDepositoHora, consumoDepositoUsuario, consumoDepositoCantidad, consumoDepositoDetalle) VALUES "
            . "('$codigoLicor', '$fecha', '$hora', '$usuario','$cantidadUni', '$detalle')";
    $conexion->query($insertar) or die($conexion->error);
    echo "<tr>
            <td>$nombreLic</td>
            <td>$cantidadUni</td>
            <td><a href=\"control/eliminarSalidaMercaderia.php?codigo=$codigo\" class=\"borrar\"><span class=\"task-cat red\">Eliminar</span></a></td>
          </tr>";

//    if ($uso == 1) {
//        $codigoSJV = "SK";
//        $codigoSJV = $codigoSJV . "" . $barra;
//
//        $busqueda1 = "SELECT * FROM gbarrasellada WHERE GBarraSelladaId='$codigoSJV' AND GBarraSelladaLicor='$codigoLicor' ";
//        $resp1 = $conexion->query($busqueda1) or die($conexion->error);
//        if ($fila = $resp1->fetch_assoc()) {
//            $nuevoMonto = $fila['GBarraSelladaCantidad'];
//            $nuevoMonto = $nuevoMonto + $cantidadUni;
//            //echo $nuevoMonto;
//            
//            //aumentar en el kardex general de la barra
//            $aumenta = "UPDATE gbarrasellada SET GBarraSelladaCantidad=$nuevoMonto WHERE GBarraSelladaId='$codigoSJV' AND GBarraSelladaLicor='$codigoLicor'";
//            $conexion->query($aumenta) or die($conexion->error);
//
//            //aumentamos en el kardex si hay uno activo
//            $consultaActivo = "SELECT * FROM kardex WHERE kardexBarra='" . $barra . "' AND kardexEstado='0'";
//            $resultActivo = $conexion->query($consultaActivo);
//            if($row=$resultActivo->fetch_assoc()){
//                //$buscaSell="SELECT * FROM kardexsellada WHERE KardexSelladaId = '".$row['kardexSellada']."' AND KardexSelladaLicor='$codigoLicor'";
//                $add="UPDATE kardexsellada SET KardexSelladaAumento=  KardexSelladaAumento + $cantidadUni WHERE KardexSelladaId = '".$row['kardexSellada']."' AND KardexSelladaLicor='$codigoLicor'";
//                $conexion->query($add);
//            }
//
//            //creamos una nueva salida
//            $insertar = "INSERT INTO salida(salidaId, salidaDia, salidaMes, salidaAnio, salidaFecha , salidaHora, salidaIdUsuario, salidaIdBarra, salidaIdDiscoteca, salidaIdLicor, salidaCantidad) VALUES "
//                    . "('$codigo', '$dia', '$mes',  '$anio','$fecha', '$hora', '$usuario','$barra', '$discoteca', '$codigoLicor','$cantidadUni')";
//            ;
//
////$insertar2 = "INSERT INTO entrada (entradaId, entradaDia, entradaMes, entradaAnio, entradaHora, entradaIdUsuario, entradaIdProveedor, entradaIdLicor, entradaCantidad, entradaPrecio) VALUES"
//            //     . "('$codigo', '$dia', '$mes', '$anio','$hora', '$usuario', '$proveedor', '$codigoLicor', '$cantidadUni','$monto')";
//
//            if ($conexion->query($insertar) == TRUE) {
//
//
//                echo "<tr>
//            <td>$nombreLic</td>
//            <td>$cantidadUni</td>
//            <td><a href=\"control/eliminarSalidaMercaderia.php?codigo=$codigo\" class=\"borrar\"><span class=\"task-cat red\">Eliminar</span></a></td>
//          </tr>";
//                //echo "Registro exitoso";
//                //header("location:../page-asignar-permisos-user.php?usuario=$user"."&nombre=$nombre"."&apellidos=$apellidos");
//            } else {
//                echo '0';
//                //echo "Error, nombre de usuario existente";
//            }
//        }
//    }
//    if ($uso == 3) {
//        $codigoSJV = "JK";
//        //echo"cq";
//
//        $codigoSJV = $codigoSJV . "" . $barra;
//        //echo $codigoSJV;
//
//        $busqueda1 = "SELECT * FROM gbarrajarra WHERE GBarraJarraId='$codigoSJV' AND GBarraJarraLicor='$codigoLicor' ";
//        $resp1 = $conexion->query($busqueda1) or die($conexion->error);
//        if ($fila = $resp1->fetch_assoc()) {
//            $nuevoMonto = $fila['GBarraJarraCantidad'];
//            $nuevoMonto = $nuevoMonto + ($cantidadUni * 3);
//            $aumentoK=($cantidadUni * 3);
//            //echo $nuevoMonto;
//
//            $aumenta = "UPDATE gbarrajarra SET GBarraJarraCantidad=$nuevoMonto WHERE GBarraJarraId='$codigoSJV' AND GBarraJarraLicor='$codigoLicor'";
//            $conexion->query($aumenta) or die($conexion->error);
//
//            //aumentamos en el kardex si hay uno activo
//            $consultaActivo = "SELECT * FROM kardex WHERE kardexBarra='" . $barra . "' AND kardexEstado='0'";
//            $resultActivo = $conexion->query($consultaActivo);
//            if($row=$resultActivo->fetch_assoc()){
//                //$buscaSell="SELECT * FROM kardexsellada WHERE KardexSelladaId = '".$row['kardexSellada']."' AND KardexSelladaLicor='$codigoLicor'";
//                $add="UPDATE kardexjarra SET KardexJarraAumento= KardexJarraAumento + $aumentoK WHERE KardexJarraId = '".$row['kardexJarra']."' AND KardexJarraLicor='$codigoLicor'";
//                $conexion->query($add);
//            }
//            
//            $insertar = "INSERT INTO salida(salidaId, salidaDia, salidaMes, salidaAnio,salidaFecha , salidaHora, salidaIdUsuario, salidaIdBarra, salidaIdDiscoteca, salidaIdLicor, salidaCantidad) VALUES "
//                    . "('$codigo', '$dia', '$mes',  '$anio','$fecha', '$hora', '$usuario','$barra', '$discoteca', '$codigoLicor','$cantidadUni')";
//            ;
//
////$insertar2 = "INSERT INTO entrada (entradaId, entradaDia, entradaMes, entradaAnio, entradaHora, entradaIdUsuario, entradaIdProveedor, entradaIdLicor, entradaCantidad, entradaPrecio) VALUES"
//            //     . "('$codigo', '$dia', '$mes', '$anio','$hora', '$usuario', '$proveedor', '$codigoLicor', '$cantidadUni','$monto')";
//
//            if ($conexion->query($insertar) == TRUE) {
//
//
//                echo "<tr>
//            <td>$nombreLic</td>
//            <td>$cantidadUni</td>
//            <td><a href=\"control/eliminarSalidaMercaderia.php?codigo=$codigo\" class=\"borrar\"><span class=\"task-cat red\">Eliminar</span></a></td>
//          </tr>";
//                //echo "Registro exitoso";
//                //header("location:../page-asignar-permisos-user.php?usuario=$user"."&nombre=$nombre"."&apellidos=$apellidos");
//            } else {
//                echo '0';
//                //echo "Error, nombre de usuario existente";
//            }
//        }
//    }
//    if ($uso == 12) {
//        $codigoSJV = "VK";
//        //echo"cq";
//
//        $codigoSJV = $codigoSJV . "" . $barra;
//        //echo $codigoSJV;
//
//        $busqueda1 = "SELECT * FROM gbarravaso WHERE GBarraVasoId='$codigoSJV' AND GBarraVasoLicor='$codigoLicor' ";
//        $resp1 = $conexion->query($busqueda1) or die($conexion->error);
//        if ($fila = $resp1->fetch_assoc()) {
//            $nuevoMonto = $fila['GBarraVasoCantidad'];
//            $nuevoMonto = $nuevoMonto + ($cantidadUni * 12);
//            $aumentoK=($cantidadUni * 12);
//            //echo $nuevoMonto;
//
//            $aumenta = "UPDATE gbarravaso SET GBarraVasoCantidad=$nuevoMonto WHERE GBarraVasoId='$codigoSJV' AND GBarraVasoLicor='$codigoLicor'";
//            $conexion->query($aumenta) or die($conexion->error);
//
//            //aumentamos en el kardex si hay uno activo
//            $consultaActivo = "SELECT * FROM kardex WHERE kardexBarra='" . $barra . "' AND kardexEstado='0'";
//            $resultActivo = $conexion->query($consultaActivo);
//            if($row=$resultActivo->fetch_assoc()){
//                //$buscaSell="SELECT * FROM kardexsellada WHERE KardexSelladaId = '".$row['kardexSellada']."' AND KardexSelladaLicor='$codigoLicor'";
//                $add="UPDATE kardexvaso SET KardexVasoAumento= KardexVasoAumento + $aumentoK WHERE KardexVasoId = '".$row['kardexVaso']."' AND KardexVasoLicor='$codigoLicor'";
//                $conexion->query($add);
//            }
//            
//            $insertar = "INSERT INTO salida(salidaId, salidaDia, salidaMes, salidaAnio, salidaFecha , salidaHora, salidaIdUsuario, salidaIdBarra, salidaIdDiscoteca, salidaIdLicor, salidaCantidad) VALUES "
//                    . "('$codigo', '$dia', '$mes',  '$anio','$fecha', '$hora', '$usuario','$barra', '$discoteca', '$codigoLicor','$cantidadUni')";
//            ;
//
////$insertar2 = "INSERT INTO entrada (entradaId, entradaDia, entradaMes, entradaAnio, entradaHora, entradaIdUsuario, entradaIdProveedor, entradaIdLicor, entradaCantidad, entradaPrecio) VALUES"
//            //     . "('$codigo', '$dia', '$mes', '$anio','$hora', '$usuario', '$proveedor', '$codigoLicor', '$cantidadUni','$monto')";
//
//            if ($conexion->query($insertar) == TRUE) {
//
//
//                echo "<tr>
//            <td>$nombreLic</td>
//            <td>$cantidadUni</td>
//            <td><a href=\"control/eliminarSalidaMercaderia.php?codigo=$codigo\" class=\"borrar\"><span class=\"task-cat red\">Eliminar</span></a></td>
//          </tr>";
//                //echo "Registro exitoso";
//                //header("location:../page-asignar-permisos-user.php?usuario=$user"."&nombre=$nombre"."&apellidos=$apellidos");
//            } else {
//                echo '0';
//                //echo "Error, nombre de usuario existente";
//            }
//        }
//    }
} else {
    echo '0';
}

$conexion->close();

