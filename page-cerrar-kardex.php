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
    $consultaBarra = "SELECT barra.barraNombre, discoteca.discotecaId, discoteca.discotecaNombre FROM barra  "
            . "RIGHT JOIN discoteca ON barra.barraDiscoteca=discoteca.discotecaId "
            . "WHERE barra.barraId='$barraP'";
    $resultadoBarra = $conexion->query($consultaBarra) or die($conexion->error);
    $barra = $resultadoBarra->fetch_assoc();
//    print_r($barra);
    //buscamos el kardex si esta activo ok
    $consultaKardex = "SELECT kardex.* FROM kardex "
            . ""
            . "WHERE kardexBarra='" . $barraP . "' AND kardexEstado='0'";
    $resultadoKardex = $conexion->query($consultaKardex);
    if ($resultadoKardex->num_rows === 0) {
        header("location:page-ver-kardexDiario.php");
    }
    $kardex = $resultadoKardex->fetch_assoc();
//    print_r($kardex);
//    echo $kardex['kardexId'];
    //buscamos el dia de la semana de la fecha dada ok
    $fecha = $kardex['kardexDia'] . "-" . $kardex['kardexMes'] . "-" . $kardex['kardexAnio'];
    $dias = array('', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo');
    $dia = $dias[date('N', strtotime($fecha))];



    $kardexSellada = "0";
    $kardexJarra = "0";
    $contSell = 0;
    $contJarr = 0;
    $contVas = 0;
    ?>


    <!DOCTYPE html>
    <html lang="es">

        <head>
            <title>Kardex</title>
            <link href="kardex/css/materialize.css" type="text/css" rel="stylesheet">
            <link href="kardex/css/misEstilos.css" type="text/css" rel="stylesheet">
            <link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">



        </head>

        <body >
            <div class="container">

                <div class="row">
                    <div class="col s12">
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
                                    . "GROUP BY categoriaLicorId "
                                    . "";
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
                                                            . ", licor.licorNombre, licor.licorId, categorialicor.categoriaLicorNombre FROM kardexsellada "
                                                            . "LEFT JOIN licor ON  kardexsellada.KardexSelladaLicor=licor.licorId "
                                                            . "LEFT JOIN inventariogeneraldetalle ON licor.licorId=inventariogeneraldetalle.inventarioGeneralDetalleLicor "
                                                            . "LEFT JOIN categorialicor ON licor.licorCategoria=categorialicor.categoriaLicorId "
                                                            . "WHERE kardexsellada.KardexSelladaId='$kardexSellada' AND categorialicor.categoriaLicorId='" . $fila['categoriaLicorId'] . "' AND licor.licorEstReg='A'"
                                                            . " ORDER BY inventariogeneraldetalle.inventarioGeneralDetalleRango DESC ";
                                                    
                                                    //echo $consultaSelladas;
                                                    $resultadoSelladas = $conexion->query($consultaSelladas) or die($conexion->error);
//                                                    $selladas = array();
                                                    while ($sellada = $resultadoSelladas->fetch_assoc()) {
                                                        echo "<tr><td data-codigo=\"" . $sellada['licorId'] . "\" id=\"sellada" . $contSell . "\"\>" . $sellada['licorNombre'] . "</td><td>" . $sellada['KardexSelladaAumento'] . "</td><td>" . $sellada['KardexSelladaInicio'] . "</td>"
                                                        . "<td  style=\"width: 50px;\"><input  style=\"width: 50px;\" id=\"fin" . $contSell . "\"type=\"number\" value=\"" . $sellada['KardexSelladaFinal'] . "\" ></td><td>" . $sellada['KardexSelladaVenta'] . "</td></tr>";

                                                        $contSell++;
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
                                        . "GROUP BY categoriaLicorId "
                                        . "";
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
                                                            . ", licor.licorNombre, licor.licorId, categorialicor.categoriaLicorNombre FROM kardexjarra "
                                                            . "LEFT JOIN licor ON  kardexjarra.KardexJarraLicor=licor.licorId "
                                                            . "LEFT JOIN inventariogeneraldetalle ON licor.licorId=inventariogeneraldetalle.inventarioGeneralDetalleLicor "
                                                            . "LEFT JOIN categorialicor ON licor.licorCategoria=categorialicor.categoriaLicorId "
                                                            . "WHERE kardexjarra.KardexJarraId='$kardexJarra' AND categorialicor.categoriaLicorId='" . $fila['categoriaLicorId'] . "' AND licor.licorEstReg='A'"
                                                            . " ORDER BY inventariogeneraldetalle.inventarioGeneralDetalleRango DESC";
                                                    //echo $consultaSelladas;
                                                    $resultadoSelladas = $conexion->query($consultaSelladas) or die($conexion->error);

                                                    while ($sellada = $resultadoSelladas->fetch_assoc()) {
                                                        echo "<tr><td data-codigo=\"" . $sellada['licorId'] . "\" id=\"jarra" . $contJarr . "\">" . $sellada['licorNombre'] . "</td><td>" . $sellada['KardexJarraAumento'] . "</td><td>" . $sellada['KardexJarraInicio'] . "</td>"
                                                        . "<td  style=\"width: 50px;\"><input style=\"width: 50px;\" id=\"finj" . $contJarr . "\" type=\"number\" value=\"" . $sellada['KardexJarraFinal'] . "\"</td><td>" . $sellada['KardexJarraVenta'] . "</td></tr>";

                                                        $contJarr++;
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
                                        . "GROUP BY categoriaLicorId "
                                        . "";
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
                                                            . ", licor.licorNombre, licor.licorId, categorialicor.categoriaLicorNombre FROM kardexvaso "
                                                            . "LEFT JOIN licor ON  kardexvaso.KardexVasoLicor=licor.licorId "
                                                            . "LEFT JOIN inventariogeneraldetalle ON licor.licorId=inventariogeneraldetalle.inventarioGeneralDetalleLicor "
                                                            . "LEFT JOIN categorialicor ON licor.licorCategoria=categorialicor.categoriaLicorId "
                                                            . "WHERE kardexvaso.KardexVasoId='$kardexVaso' AND categorialicor.categoriaLicorId='" . $fila['categoriaLicorId'] . "' AND licor.licorEstReg='A'"
                                                            . " ORDER BY inventariogeneraldetalle.inventarioGeneralDetalleRango DESC";
                                                    //echo $consultaSelladas;
                                                    $resultadoSelladas = $conexion->query($consultaSelladas) or die($conexion->error);

                                                    while ($sellada = $resultadoSelladas->fetch_assoc()) {
                                                        echo "<tr><td data-codigo=\"" . $sellada['licorId'] . "\" id=\"vaso" . $contVas . "\" >" . $sellada['licorNombre'] . "</td><td>" . $sellada['KardexVasoAumento'] . "</td><td>" . $sellada['KardexVasoInicio'] . "</td>"
                                                        . "<td style=\"width: 50px;\"><input style=\"width: 50px;\" id=\"finv" . $contVas . "\"type=\"number\" value=\"" . $sellada['KardexVasoFinal'] . "\"</td><td>" . $sellada['KardexVasoVenta'] . "</td></tr>";

                                                        $contVas++;
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
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s6 m6 l6">
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
                                            <td><?php echo $kardex['kardexTotal']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Descuento</td>
                                            <td   class="center" style="width: 120px;"><input id="descuento" style="width: 100%;" type="number" min="0" value="<?php echo $kardex['kardexDescuento']; ?>" ></td>
                                        </tr>
                                        <tr>
                                            <td>Visa</td>
                                            <td  class="center" style="width: 120px;"><input id="visa" style="width: 100%;" type="number" min="0" value="<?php echo $kardex['kardexVisa']; ?>" ></td>
                                        </tr>
                                        <tr>
                                            <td>Mastercard</td>
                                            <td  class="center" style="width: 120px;"><input id="master" style="width: 100%;" type="number" min="0" value="<?php echo $kardex['kardexMaster']; ?>" ></td>
                                        </tr>
                                        <?php
                                        $coctelB = "SELECT * FROM barracoctel WHERE barraCoctelBarra='$barraP'";
                                        $result = $conexion->query($coctelB) or die($conexion->error);
                                        if ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td>Cocteles</td>
                                                <td class="center" style="width: 120px;"> <input id="coctel" style="width: 100%;" type="number" min="0" value="<?php echo $kardex['kardexCoctel']; ?>" > </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        <tr>
                                            <td>Agua</td>
                                            <td><?php echo $kardex['kardexAguas']; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Total Efectivo</td>
                                            <td><?php echo $kardex['kardexTotalEfectivo']; ?></td>
                                        </tr>
                                        <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
                                        <tr>
                                            <td>Dinero Entregado</td> 
                                            <td  class="center" style="width: 120px;"><input id="dinero" style="width: 100%;" type="number" min="0" value="<?php echo $kardex['kardexDineroEntregado']; ?>" ></td>
                                        </tr>
                                        <?php $estado = $kardex['kardexDineroEntregado'] - $kardex['kardexTotalEfectivo'];
                                        ?>
                                        <tr>
                                            <td>Estado</td> 
                                            <td  class="<?php
                                            if ($estado < 0) {
                                                echo "red";
                                            } else {
                                                echo "green";
                                            }
                                            ?>" style="width: 120px;"><?php echo $estado; ?></td>
                                        </tr>
                                    </tbody>

                                </table>
                            </li>


                        </ul>
                    </div>

                </div>

                <div class="row">
                    <div class="input-field col s12 m4 l4 center" style="padding-bottom: 10px;">
                        <button class="btn cyan waves-effect waves-light center" id="pr" name="action" onclick="guardar()">Cuadrar Kardex
                            <i class="mdi-content-save left"></i>
                        </button>
                    </div>
                    <div class="input-field col s12 l4 l4 " style="padding-bottom: 10px;">
                        <button class="btn red waves-effect waves-light right" name=enter"action" onclick="cerrar()">Cerrar Kardex
                            <i class="mdi-content-save left"></i>
                        </button>
                    </div>
                    <div class="input-field col s12 m4 l4 " style="padding-bottom: 10px;">
                        <button class="btn grey darken-3 waves-effect waves-light right" name=enter"action" onclick="anular()">Anular Kardex
                            <i class="mdi-content-save left"></i>
                        </button>
                    </div>

                </div>


            </div>
            <!-- jQuery Library -->
            <script type="text/javascript" src="kardex/js/jquery-3.1.1.min.js"></script>  

            <!--materialize js-->
            <script type="text/javascript" src="kardex/js/materialize.js"></script>



            <script>
                            function guardar() {
    //                                $('#resultado').append("Cargando...");
                                console.log("cargando...");
                                var selladaTrue = "<?php echo $kardexSellada; ?>";
                                var jarraTrue = "<?php echo $kardexJarra; ?>";


                                if (selladaTrue != 0) {
                                    //console.log("oli es cero");
                                    var selladas =<?php echo $contSell; ?>;
                                    var codSell = "<?php echo $kardex['kardexSellada']; ?>";
                                    var discoteca = "<?php echo $barra['discotecaId'] ?>";
                                    //Para selladas;
                                    for (var i = 0; i < selladas; i++) {
                                        $templicor = "sellada".concat(i);
                                        $tempcant = "fin".concat(i);
                                        $licor = $('#' + $templicor);
                                        $stock = $('#' + $tempcant);
                                        $url = "control/anadirCierreSellada.php?licor=" + $licor.data("codigo") + "&fin=" + $stock.val() + "&bd=" + codSell + "&disco=" + discoteca;
    //                                    console.log($url);
                                        if ($stock.val() >= 0) {
    //                                        console.log('oli');
                                            $.ajax({
                                                type: 'GET',
                                                url: $url,
                                                async: false,

                                                success: function (respuesta) {
                                                    console.log("sucecs");
    //                                                console.log(respuesta);
    //                                                    location.reload();
    //                                                    if (jarraTrue == 0) {
    //
    //                                                        location.reload();
    //                                                    }

                                                }
                                            });
                                        }


                                    }

    //                                    if (jarraTrue == 0) {
    //                                        //cuadrar();
    //                                        location.reload();
    //                                    }

                                }
                                if (jarraTrue != 0) {
                                    //console.log("jarra es cero");
                                    //Para jarras;
                                    var jarras =<?php echo $contJarr; ?>;
                                    var codJarr = "<?php echo $kardex['kardexJarra']; ?>";
                                    for (var i = 0; i < jarras; i++) {
                                        $templicor = "jarra".concat(i);
                                        $tempcant = "finj".concat(i);
                                        $licor = $('#' + $templicor);
                                        $stock = $('#' + $tempcant);
                                        $url = "control/anadirCierreJarra.php?licor=" + $licor.data("codigo") + "&fin=" + $stock.val() + "&bd=" + codJarr + "&disco=" + discoteca;
    //                                    console.log($url);
                                        if ($stock.val() >= 0) {
                                            //console.log('oli');
                                            $.ajax({
                                                type: 'GET',
                                                url: $url,
                                                async: false,

                                                success: function (respuesta) {
                                                    console.log("sucecs");
    //                                                console.log(respuesta);
    //                                                    location.reload();
                                                }
                                            });
                                        }


                                    }
                                    //Para vaso;
                                    var vasos =<?php echo $contVas; ?>;
                                    var codVas = "<?php echo $kardex['kardexVaso']; ?>";
                                    for (var i = 0; i < vasos; i++) {
    //                                    console.log(oli);
                                        $templicor = "vaso".concat(i);
                                        $tempcant = "finv".concat(i);
                                        $licor = $('#' + $templicor);
                                        $stock = $('#' + $tempcant);
                                        $url = "control/anadirCierreVaso.php?licor=" + $licor.data("codigo") + "&fin=" + $stock.val() + "&bd=" + codVas + "&disco=" + discoteca;
                                        //console.log($url);
                                        if ($stock.val() >= 0) {
                                            //console.log('oli');
                                            $.ajax({
                                                type: 'GET',
                                                url: $url,
                                                async: false,

                                                success: function (respuesta) {
                                                    console.log("sucecs");
                                                    //console.log(respuesta);
    //                                                    location.reload();
                                                }
                                            });
                                        }


                                    }
                                    //cuadrar();
    //                                    location.reload();
                                }

    //                                location.reload();
                                // cuadrar();
                                console.log("final");
                                cuadrar();
                            }


                            function cuadrar() {
                                var kardex = "<?php echo $kardex['kardexId']; ?>";
                                var descuento = $('#descuento').val();
                                var visa = $('#visa').val();
                                var master = $('#master').val();
                                var dinero = $('#dinero').val();
                                var coctel = 0;
                                if ($('#coctel').val() === undefined) {

                                } else {
                                    coctel = $('#coctel').val();

                                }
//                                alert(coctel);
                                $url = "control/calcularCierre.php?kardex=" + kardex + "&visa=" + visa + "&descuento=" + descuento + "&master=" + master + "&dinero=" + dinero + "&coctel=" + coctel;
                                $.ajax({
                                    type: 'GET',
                                    url: $url,
                                    async: false,

                                    success: function (respuesta) {
                                        console.log(respuesta);
                                        //console.log(respuesta);
                                        //console.log(respuesta);
                                        location.reload();

                                    }
                                });
    //                                $.get("control/calcularCierre.php", {kardex: kardex, descuento: descuento, visa: visa, master: master}, function () {
    //    //                                                location.reload();
    //                                });
    //                                location.reload();
                            }

                            function cerrar() {
                                var kardex = "<?php echo $kardex['kardexId']; ?>";
                                $url = "control/cerrarKardexDiario.php?kardex=" + kardex;
                                $.ajax({
                                    type: 'GET',
                                    url: $url,
                                    async: false,

                                    success: function (respuesta) {
                                        console.log(respuesta);
    //                                                console.log(respuesta);
                                        location.reload();
                                    }
                                });
                            }

                            function anular() {
                                var kardex = "<?php echo $kardex['kardexId']; ?>";
                                $url = "control/anularKardexDiario.php?kardex=" + kardex;
                                $.ajax({
                                    type: 'GET',
                                    url: $url,
                                    async: false,

                                    success: function (respuesta) {
                                        console.log(respuesta);
    //                                                console.log(respuesta);
                                        location.reload();
                                    }
                                });
                            }
            </script>
        </body>

    </html>

    <?php
}
?>

