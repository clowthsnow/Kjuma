<?php
SESSION_START();

if (!isset($_SESSION['usuario'])) {
    //si no hay sesion activa 
    header("location:index.php");
} else {
    include 'conexion.php';
    $barraP = $_GET['barra'];
    if (!isset($barraP)) {
        header("location:page-ver-kardexDiario.php");
    }


    //buscar Barra ok
    $consultaBarra = "SELECT barra.barraNombre, discoteca.discotecaNombre FROM barra  "
            . "RIGHT JOIN discoteca ON barra.barraDiscoteca=discoteca.discotecaId "
            . "WHERE barra.barraId='$barraP'";
    $resultadoBarra = $conexion->query($consultaBarra) or die($conexion->error);
    $barra = $resultadoBarra->fetch_assoc();
//    print_r($barra);
    //buscamos el kardex si esta activo ok
    $consultaKardex = "SELECT kardex.* FROM kardex "
            . " "
            . "WHERE kardexBarra='" . $barraP . "' AND kardexEstado='0'";
    $resultadoKardex = $conexion->query($consultaKardex);
    if ($resultadoKardex->num_rows === 0) {
        header("location:page-ver-kardexDiario.php");
    }
    $kardex = $resultadoKardex->fetch_assoc();

//    echo $kardex['kardexId'];
    //buscamos el dia de la semana de la fecha dada ok
    $fecha = $kardex['kardexDia'] . "-" . $kardex['kardexMes'] . "-" . $kardex['kardexAnio'];
    $dias = array('', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo');
    $dia = $dias[date('N', strtotime($fecha))];
    //selladas
//    
    ?>


    <!DOCTYPE html>
    <html lang="es">

        <head>
            <title>Kardex</title>
            <link href="kardex/css/materialize.css" type="text/css" rel="stylesheet">
            <link href="kardex/css/misEstilos.css" type="text/css" rel="stylesheet">
            <link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">


        </head>

        <body>
            <div class="container">

                <div class="row">
                    <div class="">
                        <p><?php
                            echo (strtoupper("kardex " . $barra['discotecaNombre'] . " barra " . $barra['barraNombre'] . " en cargo :   "));
                            echo $kardex['kardexEncargado'];
                            ?>
                        </p>
                        <p><?php echo strtoupper("Fecha: " . $dia . " $fecha caja chica: S/. 400.00"); ?></p>

                    </div>

                </div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <?php
                        //solo selladas consulta categorias
                        if (!$kardex['kardexSellada'] == NULL) {
                            $kardexSellada = $kardex['kardexSellada'];
                            $consultaCategorias = "SELECT "
                                    . " categorialicor.* FROM kardexsellada "
                                    . "LEFT JOIN licor ON  kardexsellada.KardexSelladaLicor=licor.licorId "
                                    . "LEFT JOIN categorialicor ON licor.licorCategoria=categorialicor.categoriaLicorId "
                                    . "WHERE kardexsellada.KardexSelladaId='$kardexSellada'"
                                    . "GROUP BY categoriaLicorId";
                            $resultadoCategorias = $conexion->query($consultaCategorias) or die($conexion->error);
                            ?>
                            <div class="col m6 s6 l6">
                                <ul class="collection with-header">
                                    <li class="collection-header"><h5>Selladas</h5></li>
                                    <li class="collection-item">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th class="delg">Aumento</th>
                                                    <th class="delg">Inicio</th>
                                                    <th class="delg">Final</th>
                                                    <th class="delg">Vendido</th>
                                                </tr>
                                            </thead>    
                                            <?php while ($fila = $resultadoCategorias->fetch_assoc()) { ?>
                                                <thead>
                                                    <tr>
                                                        <th colspan = "5"><?php echo $fila['categoriaLicorNombre']; ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    $consultaSelladas = "SELECT kardexsellada.*, inventariogeneraldetalle.*"
                                                            . ", licor.licorNombre,licor.licorId, categorialicor.categoriaLicorNombre FROM kardexsellada "
                                                            . "LEFT JOIN licor ON  kardexsellada.KardexSelladaLicor=licor.licorId "
                                                            . "LEFT JOIN inventariogeneraldetalle ON licor.licorId=inventariogeneraldetalle.inventarioGeneralDetalleLicor "
                                                            . "LEFT JOIN categorialicor ON licor.licorCategoria=categorialicor.categoriaLicorId "
                                                            . "WHERE kardexsellada.KardexSelladaId='$kardexSellada' AND categorialicor.categoriaLicorId='" . $fila['categoriaLicorId'] . "' AND licor.licorEstReg='A'"
                                                            . " ORDER BY inventariogeneraldetalle.inventarioGeneralDetalleRango DESC";
//                                                            . "ORDER BY inventariogeneraldetalle.inventarioGeneralDetalleRango ASC";
                                                    //echo $consultaSelladas;
                                                    $resultadoSelladas = $conexion->query($consultaSelladas) or die($conexion->error);
//                                                    $selladas = array();
                                                    while ($sellada = $resultadoSelladas->fetch_assoc()) {
                                                        echo "<tr><td>" . $sellada['licorNombre'] . "</td><td>" . "</td><td>" . $sellada['KardexSelladaInicio'] . "</td>"
                                                        . "<td></td><td>" . "</td></tr>";
                                                    }
                                                    ?>

                                                </tbody>
                                                <?php
                                            }
                                            //print_r($categoria);
                                            ?>


                                        </table>
                                    </li>
                                </ul>
                            </div>
                            <?php
                        }
                        ?>

                        <div class="col m6 s6 l6">
                            <?php
                            //solo jarras
                            if (!$kardex['kardexJarra'] == NULL) {
                                $kardexJarra = $kardex['kardexJarra'];
                                $consultaCategorias = "SELECT "
                                        . " categorialicor.* FROM kardexjarra "
                                        . "LEFT JOIN licor ON  kardexjarra.KardexJarraLicor=licor.licorId "
                                        . "LEFT JOIN categorialicor ON licor.licorCategoria=categorialicor.categoriaLicorId "
                                        . "WHERE kardexjarra.KardexJarraId='$kardexJarra'"
                                        . "GROUP BY categoriaLicorId";
                                $resultadoCategorias = $conexion->query($consultaCategorias) or die($conexion->error);
                                ?>
                                <ul class="collection with-header">
                                    <li class="collection-header"><h5>Jarras</h5></li>
                                    <li class="collection-item">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th class="delg">Aumento</th>
                                                    <th class="delg">Inicio</th>
                                                    <th class="delg">Final</th>
                                                    <th class="delg">Vendido</th>
                                                </tr>
                                            </thead>    
                                            <?php while ($fila = $resultadoCategorias->fetch_assoc()) { ?>
                                                <thead>
                                                    <tr>
                                                        <th colspan = "5"><?php echo $fila['categoriaLicorNombre']; ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    $consultaSelladas = "SELECT kardexjarra.*, inventariogeneraldetalle.*"
                                                            . ", licor.licorNombre,licor.licorId, categorialicor.categoriaLicorNombre FROM kardexjarra "
                                                            . "LEFT JOIN licor ON  kardexjarra.KardexJarraLicor=licor.licorId "
                                                            . "LEFT JOIN inventariogeneraldetalle ON licor.licorId=inventariogeneraldetalle.inventarioGeneralDetalleLicor "
                                                            . "LEFT JOIN categorialicor ON licor.licorCategoria=categorialicor.categoriaLicorId "
                                                            . "WHERE kardexjarra.KardexJarraId='$kardexJarra' AND categorialicor.categoriaLicorId='" . $fila['categoriaLicorId'] . "' AND licor.licorEstReg='A'"
                                                            . " ORDER BY inventariogeneraldetalle.inventarioGeneralDetalleRango DESC";
                                                    //echo $consultaSelladas;
                                                    $resultadoSelladas = $conexion->query($consultaSelladas) or die($conexion->error);

                                                    while ($sellada = $resultadoSelladas->fetch_assoc()) {
                                                        echo "<tr><td>" . $sellada['licorNombre'] . "</td><td>" . "</td><td>" . $sellada['KardexJarraInicio'] . "</td>"
                                                        . "<td></td><td>" . "</td></tr>";
                                                    }
                                                    ?>

                                                </tbody>
                                                <?php
                                            }
                                            //print_r($categoria);
                                            ?>


                                        </table>
                                    </li>
                                </ul>
                                <?php
                            }
                            ?>
                            <?php
                            if (!$kardex['kardexVaso'] == NULL) {
                                $kardexVaso = $kardex['kardexVaso'];
                                $consultaCategorias = "SELECT "
                                        . " categorialicor.* FROM kardexvaso "
                                        . "LEFT JOIN licor ON  kardexvaso.KardexVasoLicor=licor.licorId "
                                        . "LEFT JOIN categorialicor ON licor.licorCategoria=categorialicor.categoriaLicorId "
                                        . "WHERE kardexvaso.KardexVasoId='$kardexVaso'"
                                        . "GROUP BY categoriaLicorId";
                                $resultadoCategorias = $conexion->query($consultaCategorias) or die($conexion->error);
                                ?>
                                <ul class="collection with-header">
                                    <li class="collection-header"><h5>Vasos</h5></li>
                                    <li class="collection-item">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th class="delg">Aumento</th>
                                                    <th class="delg">Inicio</th>
                                                    <th class="delg">Final</th>
                                                    <th class="delg">Vendido</th>
                                                </tr>
                                            </thead>    
                                            <?php while ($fila = $resultadoCategorias->fetch_assoc()) { ?>
                                                <thead>
                                                    <tr>
                                                        <th colspan = "5"><?php echo $fila['categoriaLicorNombre']; ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    $consultaSelladas = "SELECT kardexvaso.*, inventariogeneraldetalle.*"
                                                            . ", licor.licorNombre,licor.licorId, categorialicor.categoriaLicorNombre FROM kardexvaso "
                                                            . "LEFT JOIN licor ON  kardexvaso.KardexVasoLicor=licor.licorId " 
                                                            . "LEFT JOIN inventariogeneraldetalle ON licor.licorId=inventariogeneraldetalle.inventarioGeneralDetalleLicor "
                                                            . "LEFT JOIN categorialicor ON licor.licorCategoria=categorialicor.categoriaLicorId "
                                                            . "WHERE kardexvaso.KardexVasoId='$kardexVaso' AND categorialicor.categoriaLicorId='" . $fila['categoriaLicorId'] . "' AND licor.licorEstReg='A'"
                                                            . " ORDER BY inventariogeneraldetalle.inventarioGeneralDetalleRango DESC ";
                                                    //echo $consultaSelladas;
                                                    $resultadoSelladas = $conexion->query($consultaSelladas) or die($conexion->error);

                                                    while ($sellada = $resultadoSelladas->fetch_assoc()) {
                                                        echo "<tr><td>" . $sellada['licorNombre'] . "</td><td>" . "</td><td>" . $sellada['KardexVasoInicio'] . "</td>"
                                                        . "<td></td><td>" . "</td></tr>";
                                                    }
                                                    ?>

                                                </tbody>
                                                <?php
                                            }
                                            //print_r($categoria);
                                            ?>


                                        </table>
                                    </li>
                                </ul>
                                <?php
                            }
                            ?>

                            <ul class="collection with-header">
                                <li class="collection-header"><h5></h5></li>
                                <li class="collection-item">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th colspan="2">Arqueo Oficina</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Total</td>
                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td>Descuento</td>
                                                <td>&nbsp;&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td>Visa</td>
                                                <td>&nbsp;&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td>Masterkard</td>
                                                <td>&nbsp;&nbsp;</td>
                                            </tr>
                                            <?php
                                            $coctelB = "SELECT * FROM barracoctel WHERE barraCoctelBarra='$barraP'";
                                            $result = $conexion->query($coctelB) or die($conexion->error);
                                            if ($row = $result->fetch_assoc()) {
                                                ?>
                                                <tr>
                                                    <td>Cocteles</td>
                                                    <td>&nbsp;&nbsp;</td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            <tr>
                                                <td>Agua</td>
                                                <td>&nbsp;&nbsp;</td>
                                            </tr>
                                            
                                            <tr>
                                                <td>Total Efectivo</td>
                                                <td>&nbsp;&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;&nbsp;</td>
                                                <td>&nbsp;&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td><b>Efectivo Oficina</b></td>
                                                <td>&nbsp;&nbsp;</td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </li>


                            </ul>

                            <ul class="collection with-header">
                                <li class="collection-header"><h5></h5></li>
                                <li class="collection-item">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th colspan="2">Observaciones Oficina</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Faltante</td>
                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

                                            </tr>
                                            <tr>
                                                <td colspan="2">Observaciones</td>

                                            </tr>
                                            <tr>
                                                <td colspan="2">&nbsp;&nbsp;
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                </td>
                                            </tr>

                                        </tbody>

                                    </table>
                                </li>


                            </ul>


                        </div>
                    </div>
                </div>
                <!--                <div class="row">
                                    <div class="col s6 m6 l6">
                
                                    </div>
                
                                </div>-->
                <div class="row">
                    <input id="butn" type="button" name="imprimir" value="Imprimir" onclick="imprimir();">
                </div>

            </div>
            <!-- jQuery Library -->
            <script type="text/javascript" src="kardex/js/jquery-3.1.1.min.js"></script>  

            <!--materialize js-->
            <script type="text/javascript" src="kardex/js/materialize.js"></script>
            <script>
                        function imprimir() {
                            $('#butn').hide();
                            window.print();

                        }

            </script>
        </body>

    </html>

    <?php
}
?>

