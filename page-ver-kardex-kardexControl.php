<?php
SESSION_START();

if (!isset($_SESSION['usuario'])) {
    //si no hay sesion activa 
    header("location:index.php");
} else {
    include 'conexion.php';
    $kardex = $_GET['kardex'];
    if (!isset($kardex)) {
        header("location:page-verfecha-kardexDiario.php");
    }


    //buscamps el kardex por id
    //
//    $$consultaKardex = "SELECT * FROM kardex WHERE kardexBarra='" . $kardex . "' AND kardexEstado='0'";
    $consultaKardex="SELECT kardex.*, discoteca.discotecaNombre, barra.barraNombre "
        . "FROM kardex "
        . " "
        . "LEFT JOIN barra ON kardex.kardexBarra=barra.barraId "
        . "LEFT JOIN discoteca ON barra.barraDiscoteca=discoteca.discotecaId "
        . "WHERE kardexId='$kardex'";
    $resultadoKardex = $conexion->query($consultaKardex);
    if ($resultadoKardex->num_rows === 0) {
        header("location:page-verfecha-kardexDiario.php");
    }
    $kardex = $resultadoKardex->fetch_assoc();


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
                            echo (strtoupper("kardex " . $kardex['discotecaNombre'] . " barra " . $kardex['barraNombre'] . " en cargo :   "));
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
                                                    $consultaSelladas = "SELECT kardexsellada.*"
                                                            . ", licor.licorNombre, categorialicor.categoriaLicorNombre FROM kardexsellada "
                                                            . "LEFT JOIN licor ON  kardexsellada.KardexSelladaLicor=licor.licorId "
                                                            . "LEFT JOIN categorialicor ON licor.licorCategoria=categorialicor.categoriaLicorId "
                                                            . "WHERE kardexsellada.KardexSelladaId='$kardexSellada' AND categorialicor.categoriaLicorId='" . $fila['categoriaLicorId'] . "'"
                                                            . "";
                                                    //echo $consultaSelladas;
                                                    $resultadoSelladas = $conexion->query($consultaSelladas) or die($conexion->error);
//                                                    $selladas = array();
                                                    while ($sellada = $resultadoSelladas->fetch_assoc()) {
                                                        echo "<tr><td>" . $sellada['licorNombre'] . "</td><td>" .$sellada['KardexSelladaAumento']. "</td><td>" . $sellada['KardexSelladaInicio'] . "</td>"
                                                        . "<td>".$sellada['KardexSelladaFinal']. "</td><td>" .$sellada['KardexSelladaVenta'].  "</td></tr>";
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
                                                    $consultaSelladas = "SELECT kardexjarra.*"
                                                            . ", licor.licorNombre, categorialicor.categoriaLicorNombre FROM kardexjarra "
                                                            . "LEFT JOIN licor ON  kardexjarra.KardexJarraLicor=licor.licorId "
                                                            . "LEFT JOIN categorialicor ON licor.licorCategoria=categorialicor.categoriaLicorId "
                                                            . "WHERE kardexjarra.KardexJarraId='$kardexJarra' AND categorialicor.categoriaLicorId='" . $fila['categoriaLicorId'] . "'"
                                                            . "";
                                                    //echo $consultaSelladas;
                                                    $resultadoSelladas = $conexion->query($consultaSelladas) or die($conexion->error);

                                                    while ($sellada = $resultadoSelladas->fetch_assoc()) {
                                                        echo "<tr><td>" . $sellada['licorNombre'] . "</td><td>" . $sellada['KardexJarraAumento'] ."</td><td>" . $sellada['KardexJarraInicio'] . "</td>"
                                                        . "<td>". $sellada['KardexJarraFinal'] ."</td><td>" . $sellada['KardexJarraVenta'] . "</td></tr>";
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
                                                    $consultaSelladas = "SELECT kardexvaso.*"
                                                            . ", licor.licorNombre, categorialicor.categoriaLicorNombre FROM kardexvaso "
                                                            . "LEFT JOIN licor ON  kardexvaso.KardexVasoLicor=licor.licorId "
                                                            . "LEFT JOIN categorialicor ON licor.licorCategoria=categorialicor.categoriaLicorId "
                                                            . "WHERE kardexvaso.KardexVasoId='$kardexVaso' AND categorialicor.categoriaLicorId='" . $fila['categoriaLicorId'] . "'"
                                                            . "";
                                                    //echo $consultaSelladas;
                                                    $resultadoSelladas = $conexion->query($consultaSelladas) or die($conexion->error);

                                                    while ($sellada = $resultadoSelladas->fetch_assoc()) {
                                                        echo "<tr><td>" . $sellada['licorNombre'] . "</td><td>" . $sellada['KardexVasoAumento'] . "</td><td>" . $sellada['KardexVasoInicio'] . "</td>"
                                                        . "<td>". $sellada['KardexVasoFinal'] ."</td><td>" . $sellada['KardexVasoVenta'] . "</td></tr>";
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
                                                <td><?php echo $kardex['kardexTotal']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Descuento</td>
                                                <td><?php echo $kardex['kardexDescuento']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Visa</td>
                                                <td><?php echo $kardex['kardexVisa']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Masterkard</td>
                                                <td><?php echo $kardex['kardexMaster']; ?></td>
                                            </tr>
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
                </div>
<!--                <div class="row">
                    <div class="col s6 m6 l6">

                    </div>

                </div>-->
                <div class="row">
                    <input id="butn" type="button" name="imprimir" value="Imprimir" onclick="imprimir();">
                    <?php if ($_SESSION['usuario']=="admin"){
                    ?>
                        <input id="butn" type="button" name="editar" value="Editar" onclick="editar();">
                        <?php    
                    }?>
                    
                    
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
