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



    $consultaCategoriaLicor = "SELECT * FROM categorialicor";
    $resultadoCategoriaLicor = $conexion->query($consultaCategoriaLicor) or die($conexion->error);


    $consultaBarra = "SELECT * FROM barra WHERE barraId='$barraP'";
    $resultadoBarra = $conexion->query($consultaBarra);
    $barra = $resultadoBarra->fetch_assoc();
    //echo $barra['barraNombre'];


    $consultaDiscoteca = "SELECT * FROM discoteca WHERE discotecaId='" . $barra['barraDiscoteca'] . "'";
    $resultadoDiscoteca = $conexion->query($consultaDiscoteca);
    $discoteca = $resultadoDiscoteca->fetch_assoc();
    //echo $discoteca['discotecaNombre'];

    $consultaKardex = "SELECT * FROM kardex WHERE kardexBarra='" . $barra['barraId'] . "' AND kardexEstado='0'";
    $resultadoKardex = $conexion->query($consultaKardex);
    if ($resultadoKardex->num_rows === 0) {
        header("location:page-ver-kardexDiario.php");
    }
    $kardex = $resultadoKardex->fetch_array();
//    echo $kardex['kardexId'];
    $fecha = $kardex['kardexDia'] . "-" . $kardex['kardexMes'] . "-" . $kardex['kardexAnio'];
    $dias = array('', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo');
    $dia = $dias[date('N', strtotime($fecha))];
    ?>
    <!DOCTYPE html>
    <html lang="es">

        <head>
            <title>Kardex</title>
            <link href="kardex/css/materialize.css" type="text/css" rel="stylesheet">
            <link href="kardex/css/misEstilos.css" type="text/css" rel="stylesheet">

        </head>

        <body>
            <div class="container">

                <div class="row">
                    <div class="col s12">
                        <p><?php
                            echo (strtoupper("kardex " . $discoteca['discotecaNombre'] . " barra " . $barra['barraNombre'] . " en cargo :   "));
                            echo $kardex['kardexEncargado'];
                            ?>
                        </p>
                        <p><?php echo strtoupper("Fecha: " . $dia . " $fecha caja chica: S/. 400.00"); ?></p>

                    </div>

                </div>

                <div>
                    <table class="bordered">
                        <?php while ($categoriaLicor = $resultadoCategoriaLicor->fetch_array()) {
                            ?>
                            <thead>
                                <tr>
                                    <th><?php echo $categoriaLicor['categoriaLicorNombre']; ?></th>
                                    <?php if (!$kardex['kardexSellada'] == NULL) { ?>
                                        <th class="delg">Aumento</th>
                                        <th class="delg">Inicio</th>
                                        <th class="delg">Final</th>
                                        <th class="delg">Vendido</th>
                                    <?php }
                                    ?>
                                    <?php if (!$kardex['kardexJarra'] == NULL) { ?>
                                        <th class="delg">Aumento</th>
                                        <th class="delg">Inicio</th>
                                        <th class="delg">Final</th>
                                        <th class="delg">Vendido</th>
                                    <?php }
                                    ?>
                                    <?php if (!$kardex['kardexVaso'] == NULL) { ?>
                                        <th class="delg">Aumento</th>
                                        <th class="delg">Inicio</th>
                                        <th class="delg">Final</th>
                                        <th class="delg">Vendido</th>
                                        <?php }
                                        ?>

                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $v = "SELECT * FROM licor WHERE licorCategoria='" . $categoriaLicor['categoriaLicorId'] . "'";

                                $r = $conexion->query($v);

                                if ($licor = $r->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $licor['licorNombre'];
                                    ?></td>

                                        <?php
                                        $v1 = "SELECT * FROM kardexsellada WHERE KardexSelladaId='" . $kardex['kardexSellada'] . "' AND KardexSelladaLicor='" . $licor['licorId'] . "'";
                                        echo $v1;
                                        $r1 = $conexion->query($v1);
                                        if ($fila = $r1->fetch_assoc()) {
                                            ?>
                                            <td><?php echo $fila['KardexSelladaAumento']; ?></td>
                                            <td><?php echo $fila['KardexSelladaInicio']; ?></td>
                                            <td><input type="number" value="<?php echo $fila['KardexSelladaFinal'] ?>"></td>
                                            <td><?php echo $fila['KardexSelladaVenta']; ?></td>

                                            <?php
                                        }
                                        ?>

                                        <?php
                                        $v1 = "SELECT * FROM kardexjarra WHERE KardexJarraId='" . $kardex['kardexJarra'] . "' AND KardexJarraLicor='" . $licor['licorId'] . "'";
                                        echo $v1;
                                        $r1 = $conexion->query($v1);
                                        if ($fila = $r1->fetch_assoc()) {
                                            ?>
                                            <td><?php echo $fila['KardexJarraAumento']; ?></td>
                                            <td><?php echo $fila['KardexJarraInicio']; ?></td>
                                            <td><input type="number" value="<?php echo $fila['KardexJarraFinal'] ?>"></td>
                                            <td><?php echo $fila['KardexJarraVenta']; ?></td>

                                            <?php
                                        }
                                        ?>
                                        <?php
                                        $v1 = "SELECT * FROM kardexvaso WHERE KardexVasoId='" . $kardex['kardexVaso'] . "' AND KardexVasoLicor='" . $licor['licorId'] . "'";
                                        echo $v1;
                                        $r1 = $conexion->query($v1);
                                        if ($fila = $r1->fetch_assoc()) {
                                            ?>
                                            <td><?php echo $fila['KardexVasoAumento']; ?></td>
                                            <td><?php echo $fila['KardexVasoInicio']; ?></td>
                                            <td><input type="number" value="<?php echo $fila['KardexVasoFinal'] ?>"></td>
                                            <td><?php echo $fila['KardexVasoVenta']; ?></td>

                                            <?php
                                        }
                                        ?>

                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        <?php }
                        ?>


                    </table>

                </div>
            </div>
            <!-- jQuery Library -->
            <script type="text/javascript" src="kardex/js/jquery-3.1.1.min.js"></script>  

            <!--materialize js-->
            <script type="text/javascript" src="kardex/js/materialize.js"></script>
        </body>

    </html>

    <?php
}
?>

