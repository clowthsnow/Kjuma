<?php
SESSION_START();

if (!isset($_SESSION['usuario'])) {
    //si no hay sesion activa 
    header("location:index.php");
} else {
    include 'conexion.php';
    $carta = $_GET['carta'];
    if (!isset($carta)) {
        header("location:page-ver-cartas.php");
    }
    $buscar = "SELECT * FROM carta WHERE cartaId='$carta'";
    $resultado = $conexion->query($buscar);
    if ($resultado->num_rows === 0) {
        header("location:page-ver-cartas.php");
    }
    $provBD = $resultado->fetch_assoc();
    ?>
    <!DOCTYPE html>
    <html lang="es">

        <head>
            <title>Configurar Cartas</title>
            <!--Let browser know website is optimized for mobile-->
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            <!-- Favicons-->
            <link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">


            <!-- CORE CSS-->    
            <link href="css/materialize.css" type="text/css" rel="stylesheet">
            <link href="css/style.css" type="text/css" rel="stylesheet" >
            <link href="css/estilos.css" type="text/css" rel="stylesheet" >


            <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->    
            <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" >
            <link href="js/plugins/data-tables/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet" media="screen,projection">


        </head>

        <body>

            <!-- START MAIN -->
            <div id="main">
                <!-- START WRAPPER -->
                <div class="wrapper">

                    <!-- START LEFT SIDEBAR NAV-->
                    <?php include 'inc/menu.inc'; ?>
                    <!-- END LEFT SIDEBAR NAV-->

                    <!-- //////////////////////////////////////////////////////////////////////////// -->

                    <!-- START CONTENT -->
                    <section id="content">

                        <!--breadcrumbs start-->
                        <div id="breadcrumbs-wrapper" class=" grey lighten-3">
                            <div class="container">
                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <h5 class="breadcrumbs-title">Configurar Carta</h5>
                                        <ol class="breadcrumb">
                                            <li class=" grey-text lighten-4">Kardex
                                            </li>
                                            <li class="grey-text lighten-4" >Ver Cartas</li>
                                            <li class="active blue-text">Configurar Carta</li>
                                        </ol>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--breadcrumbs end-->

                        <!--start container-->
                        <div class="container">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <div class="section">
                                        <div id="roboto">
                                            <h4 class="header">Configuracion de Cartas</h4>
                                            <p class="caption">
                                                En este panel usted podra hacer la gestion de la carta.
                                            </p>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <!-- Form with validation -->
                                                <div class="col offset-l1 s12 m12 l10">
                                                    <div class="card-panel">
                                                        <h4 class="header2">Carta: <?php echo $provBD['cartaId']; ?></h4>
                                                        <div class="row">

                                                            <div class="row">
                                                                <div class="input-field col s12">
                                                                    <?php
                                                                    $buscarD = "SELECT * FROM discoteca WHERE discotecaId='" . $provBD['cartaDiscoteca'] . "'";
                                                                    $result = $conexion->query($buscarD);
                                                                    while ($fila = $result->fetch_assoc()) {
                                                                        ?>
                                                                        <input id="discotec" type="text" class="validate black-text" name="disc" required="" disabled  value="<?php echo $fila['discotecaNombre']; ?>">
                                                                        <label for="discotec" class="active">Discoteca</label>
                                                                    <?php }
                                                                    ?>

                                                                </div>
                                                            </div> 
                                                            <br>
                                                            <div class="row">
                                                                <ul class="collection with-header">

                                                                    <li class="collection-header"><h4>Selladas</h4></li>
                                                                    <li class="collection-item">
                                                                        <?php
                                                                        $selladasQuery = "SELECT * FROM cartasellada WHERE cartaSelladaId='" . "S" . $provBD['cartaId'] . "'";
                                                                        $selladasResul = $conexion->query($selladasQuery);
                                                                        if ($selladasResul->num_rows > 0) {
                                                                            echo "<div id=\"\">
                                                                                        <div class=\"row\">
                                                                                            <div class=\"col offset-s1 s10 offset-m1 m10 offset-l1 l10\">
                                                                                                <table id=\"data-table-row-grouping\" class=\"responsive-table display \" cellspacing=\"0\">
                                                                                                    <thead>
                                                                                                        <tr>
                                                                                                            <th>Producto</th>
                                                                                                            <th>Precio</th>
                                                                                                            <th>categoria</th>
                                                                                                            <th>Configurar</th>
                                                                                                        </tr>
                                                                                                    </thead>
                                                                                                    <tbody>";
                                                                            while ($row = $selladasResul->fetch_assoc()) {
                                                                                $BLicor = "SELECT licor.*, categoriaLicor.categoriaLicorNombre FROM licor "
                                                                                        . "LEFT JOIN categoriaLicor ON licor.licorCategoria=categoriaLicor.categoriaLicorId "
                                                                                        . "WHERE licorId='" . $row['cartaSelladaLicor'] . "'";
                                                                                $RLic = $conexion->query($BLicor) or die ($conexion->error);
                                                                                $filaLic = $RLic->fetch_assoc();
                                                                                echo "<tr>
                                                                                                <td>" . $filaLic['licorNombre'] . "</td>
                                                                                                <td><div class=\"cambio\">" . $row['cartaSelladaPrecio'] . "</td>
                                                                                                <td>". $filaLic['categoriaLicorNombre'] ."</td>
                                                                                                <td><a href=\"page-cambiarPrecioSellada.php?idCarta=" . "S" . $provBD['cartaId'] . "&licor=" . $filaLic['licorId'] . "\"><span class=\"task-cat cyan\">Configurar</span></a></td>
                                                                                                </tr>";
                                                                                //echo $row['cartaSelladaLicor'] . $row['cartaSelladaPrecio'];
                                                                            }
                                                                            echo "</tbody>
                                                                                                </table>
                                                                                            </div>
                                                                                        </div>
                                                                                        </div>";
                                                                        }
                                                                        ?> 
                                                                        <br><br>
                                                                        <div class="divider"></div>
                                                                        <div class="row">
                                                                            <div class="input-field col s11 l11 m11">
                                                                                <a class="btn cyan waves-effect waves-light right" href="page-anadir-cartaSellada.php?codigo=<?php echo $provBD['cartaId']; ?>" >Añadir Selladas
                                                                                    <i class="mdi-content-add left"></i>
                                                                                </a>
                                                                            </div>

                                                                        </div>
                                                                        <br><br>

                                                                    </li>
                                                                    <li class="collection-header"><h4>Jarras</h4></li>
                                                                    <li class="collection-item">
                                                                        <?php
                                                                        $selladasQuery = "SELECT * FROM cartaJarra WHERE cartaJarraId='" . "J" . $provBD['cartaId'] . "'";
                                                                        $selladasResul = $conexion->query($selladasQuery);
                                                                        if ($selladasResul->num_rows > 0) {
                                                                            echo "<div id=\"hoverable-table\">
                                                                                        <div class=\"row\">
                                                                                            <div class=\"col offset-s1 s10 offset-m1 m10 offset-l1 l10\">
                                                                                                <table id=\"data-table-row-grouping-j\" class=\"responsive-table display \" cellspacing=\"0\">
                                                                                                    <thead>
                                                                                                        <tr>
                                                                                                            <th>Producto</th>
                                                                                                            <th>Precio</th>
                                                                                                            <th>categoria</th>
                                                                                                            <th>Configurar</th>
                                                                                                        </tr>
                                                                                                    </thead>
                                                                                                    <tbody>";
                                                                            while ($row = $selladasResul->fetch_assoc()) {
                                                                                $BLicor = "SELECT licor.*, categoriaLicor.categoriaLicorNombre FROM licor "
                                                                                        . "LEFT JOIN categoriaLicor ON licor.licorCategoria=categoriaLicor.categoriaLicorId "
                                                                                        . " WHERE licorId='" . $row['cartaJarraLicor'] . "'";
                                                                                $RLic = $conexion->query($BLicor) or die($conexion->error);
                                                                                $filaLic = $RLic->fetch_assoc();
                                                                                echo "<tr>
                                                                                                <td>" . $filaLic['licorNombre'] . "</td>
                                                                                                <td>" . $row['cartaJarraPrecio'] . "</td>
                                                                                                <td>". $filaLic['categoriaLicorNombre'] ."</td>
                                                                                                <td><a href=\"page-cambiarPrecioJarra.php?idCarta=" . "J" . $provBD['cartaId'] . "&licor=" . $filaLic['licorId'] . "\"><span class=\"task-cat cyan\">Configurar</span></a></td>
                                                                                                </tr>";
                                                                                //echo $row['cartaSelladaLicor'] . $row['cartaSelladaPrecio'];
                                                                            }
                                                                            echo "</tbody>
                                                                                                </table>
                                                                                            </div>
                                                                                        </div>
                                                                                        </div>";
                                                                        }
                                                                        ?>
                                                                        <br><br>
                                                                        <div class="divider"></div>
                                                                        <div class="row">
                                                                            <div class="input-field col s11 l11 m11">
                                                                                <a class="btn cyan waves-effect waves-light right" href="page-anadir-cartaJarra.php?codigo=<?php echo $provBD['cartaId']; ?>" >Añadir Jarras
                                                                                    <i class="mdi-content-add left"></i>
                                                                                </a>
                                                                            </div>

                                                                        </div>
                                                                        <br><br>
                                                                    </li>

                                                                    <li class="collection-header"><h4>Vasos</h4></li>
                                                                    <li class="collection-item">

                                                                        <?php
                                                                        $selladasQuery = "SELECT * FROM cartavaso WHERE cartaVasoId='" . "V" . $provBD['cartaId'] . "'";
                                                                        $selladasResul = $conexion->query($selladasQuery);
                                                                        if ($selladasResul->num_rows > 0) {
                                                                            echo "<div id=\"hoverable-table\">
                                                                                        <div class=\"row\">
                                                                                            <div class=\"col offset-s1 s10 offset-m1 m10 offset-l1 l10\">
                                                                                                <table id=\"data-table-row-grouping-v\" class=\"responsive-table display \" cellspacing=\"0\">
                                                                                                    <thead>
                                                                                                        <tr>
                                                                                                            <th>Producto</th>
                                                                                                            <th>Precio</th>
                                                                                                            <th>categoria</th>
                                                                                                            <th>Configurar</th>
                                                                                                        </tr>
                                                                                                    </thead>
                                                                                                    <tbody>";
                                                                            while ($row = $selladasResul->fetch_assoc()) {
                                                                                $BLicor = "SELECT  licor.*, categoriaLicor.categoriaLicorNombre FROM licor "
                                                                                        . "LEFT JOIN categoriaLicor ON licor.licorCategoria=categoriaLicor.categoriaLicorId "
                                                                                        . " WHERE licorId='" . $row['cartaVasoLicor'] . "'";
                                                                                $RLic = $conexion->query($BLicor) or die($conexion->error);
                                                                                $filaLic = $RLic->fetch_assoc();
                                                                                echo "<tr>
                                                                                                <td>" . $filaLic['licorNombre'] . "</td>
                                                                                                <td>" . $row['cartaVasoPrecio'] . "</td>
                                                                                                <td>". $filaLic['categoriaLicorNombre'] ."</td>
                                                                                                <td><a href=\"page-cambiarPrecioVaso.php?idCarta=" . "V" . $provBD['cartaId'] . "&licor=" . $filaLic['licorId'] . "\"><span class=\"task-cat cyan\">Configurar</span></a></td>
                                                                                                </tr>";
                                                                                //echo $row['cartaSelladaLicor'] . $row['cartaSelladaPrecio'];
                                                                            }
                                                                            echo "</tbody>
                                                                                                </table>
                                                                                            </div>
                                                                                        </div>
                                                                                        </div>";
                                                                        }
                                                                        ?>
                                                                        <br><br>
                                                                        <div class="divider"></div>
                                                                        <div class="row">
                                                                            <div class="input-field col s11 l11 m11">
                                                                                <a class="btn cyan waves-effect waves-light right" href="page-anadir-cartaVaso.php?codigo=<?php echo $provBD['cartaId']; ?>"  >Añadir Vasos
                                                                                    <i class="mdi-content-add left"></i>
                                                                                </a>
                                                                            </div>

                                                                        </div>
                                                                        <br><br>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                            <br>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </section>
                    <!-- END CONTENT -->

                    <!-- //////////////////////////////////////////////////////////////////////////// -->
                    <!-- START RIGHT SIDEBAR NAV-->
                    <aside id="right-sidebar-nav">

                    </aside>
                    <!-- LEFT RIGHT SIDEBAR NAV-->

                </div>
                <!-- END WRAPPER -->

            </div>
            <!-- END MAIN -->



            <!-- //////////////////////////////////////////////////////////////////////////// -->

            <!-- START FOOTER -->
            <?php include 'inc/footer.inc'; ?>
            <!-- END FOOTER -->


            <!-- ================================================
            Scripts
            ================================================ -->

            <!-- jQuery Library -->
            <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>  

            <!--materialize js-->
            <script type="text/javascript" src="js/materialize.js"></script>
            <!--scrollbar-->
            <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

                        <!-- data-tables -->
            <script type="text/javascript" src="js/plugins/data-tables/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="js/plugins/data-tables/data-tables-kG.js"></script>


            <!--plugins.js - Some Specific JS codes for Plugin Settings-->
            <script type="text/javascript" src="js/plugins.js"></script>
<!--            <script>
                $('.cambio').dblclick(function () {
                    var input = $('<input />', {
                        'type': 'number',
                        'value': $(this).text()
                    });
                    $(this).replaceWith(input);
                });

                $(document).ready(function () {
                    $('.tooltipped').tooltip({delay: 50});
                });
            </script>-->

        </body>

    </html>
    <?php
}
?>



