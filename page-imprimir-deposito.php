<?php
SESSION_START();

if (!isset($_SESSION['usuario'])) {
    //si no hay sesion activa 
    header("location:index.php");
} else {
    date_default_timezone_set('America/Lima');
    $fecha = new DateTime();

    include 'conexion.php';
    ?>


    <!DOCTYPE html>
    <html lang="es">

        <head>
            <title>Deposito</title>
            <link href="kardex/css/materialize.css" type="text/css" rel="stylesheet">
            <link href="kardex/css/misEstilos.css" type="text/css" rel="stylesheet">
            <link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">


        </head>

        <body>
            <div class="container">

                <div class="row">
                    <div class="">
                        <p><?php
                            echo "Inventario Deposito";
                            ?>
                        </p>
                        <p><?php
                            echo "Fecha: ";
                            echo $fecha->format('Y-m-d');
                            ?></p>

                    </div>

                </div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <?php
                        //solo selladas consulta categorias
                        $consultaDetalle = "SELECT inventariogeneraldetalle.*,  licor.*, categorialicor.* FROM inventariogeneraldetalle "
                                . "LEFT JOIN licor ON inventariogeneraldetalle.inventarioGeneralDetalleLicor=licor.licorId "
                                . " LEFT JOIN categorialicor ON licor.licorCategoria=categorialicor.categoriaLicorId "
//                                                                                . " WHERE inventarioGeneralDetalleEstReg='A'"
//                                                                                . " ORDER BY licor.licorNombre"
                                . "GROUP BY categoriaLicorId";
                        $result = $conexion->query($consultaDetalle) or die($conexion->error);
                        ?>
                        <div class="col m6 s6 l6">
                            <ul class="collection with-header">
                                <li class="collection-header"><h5>Deposito</h5></li>
                                <li class="collection-item">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th class="delg2">Stock</th>
                                            </tr>
                                        </thead>    
                                        <?php while($fila = $result->fetch_assoc()) { ?>
                                            <thead>
                                                <tr>
                                                    <th colspan = "5"><?php echo $fila['categoriaLicorNombre']; ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $consultaSelladas = "SELECT inventariogeneraldetalle.*, cartasellada.*, licor.*, categorialicor.* FROM inventariogeneraldetalle "
                                                        . "LEFT JOIN licor ON inventariogeneraldetalle.inventarioGeneralDetalleLicor=licor.licorId "
                                                        . "LEFT JOIN cartasellada ON licor.licorId=cartasellada.cartaSelladaLicor AND cartasellada.cartaSelladaId='SCD001'"
                                                        . " LEFT JOIN categorialicor ON licor.licorCategoria=categorialicor.categoriaLicorId "
                                                        . " WHERE inventarioGeneralDetalleEstReg='A' AND categorialicor.categoriaLicorId='" . $fila['categoriaLicorId'] . "'"
//                                                                                . " ORDER BY licor.licorNombre"
                                                        . "ORDER BY inventariogeneraldetalle.inventarioGeneralDetalleRango DESC";
                                                //echo $consultaSelladas;
                                                $resultadoSelladas = $conexion->query($consultaSelladas) or die($conexion->error);
//                                                    $selladas = array();
                                                while ($sellada = $resultadoSelladas->fetch_assoc()) {
                                                    echo "<tr><td>" . $sellada['licorNombre'] . "</td>" . "<td>" . $sellada['inventarioGeneralDetalleCantidad'] . "</td>"
                                                    . "" . "</tr>";
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
                        ?>


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

