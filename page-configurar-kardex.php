<?php
SESSION_START();

if (!isset($_SESSION['usuario'])) {
    //si no hay sesion activa 
    header("location:index.php");
} else {
    include 'conexion.php';
    $kardex = $_GET['kardex'];
    if (!isset($kardex)) {
        header("location:page-ver-kardexGenerales.php");
    }
    $buscar = "SELECT * FROM kardexgbarra WHERE KardexGBarraId='$kardex'";
    $resultado = $conexion->query($buscar);
    if ($resultado->num_rows === 0) {
        header("location:page-ver-kardexGenerales.php");
    }
    $provBD = $resultado->fetch_assoc();
    ?>
    <!DOCTYPE html>
    <html lang="es">

        <head>
            <title>Ver e Inicializar Kardex</title>
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
                                        <h5 class="breadcrumbs-title">Ver e Inicializar Kardex</h5>
                                        <ol class="breadcrumb">
                                            <li class=" grey-text lighten-4">Kardex
                                            </li>
                                            <li class="grey-text lighten-4" >Ver Kardex</li>
                                            <li class="active blue-text">Ver e Inicializar Kardex</li>
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
                                            <h4 class="header">Ver e Inicializar Kardex</h4>
                                            <p class="caption">
                                                En este panel usted podra ver e inicializar los kardex generales de cada barra.
                                            </p>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <!-- Form with validation -->
                                                <div class="col offset-l1 s12 m12 l10">
                                                    <div class="card-panel">
                                                        <h4 class="header2">Kardex: <?php echo $provBD['KardexGBarraId']; ?></h4>
                                                        <div class="row">

                                                            <div class="row">
                                                                <div class="input-field col s12">
                                                                    <?php
                                                                    $buscarB = "SELECT * FROM barra WHERE barraId='" . $provBD['KardexGBarraIdBarra'] . "'";
                                                                    $result = $conexion->query($buscarB);
                                                                    if ($fila = $result->fetch_assoc()) {
                                                                        $buscarD = "SELECT * FROM discoteca WHERE discotecaId='" . $fila['barraDiscoteca'] . "'";
                                                                        $result2 = $conexion->query($buscarD);
                                                                        if ($row = $result2->fetch_assoc()) {
                                                                            ?>
                                                                            <input id="discotec" type="text" class="validate black-text" name="disc" required="" disabled  value="<?php echo $row['discotecaNombre'] . "-" . $fila['barraNombre']; ?>">
                                                                            <label for="discotec" class="active">Barra: </label>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>

                                                                </div>
                                                            </div> 
                                                            <br>
                                                            <div class="row">
                                                                <ul class="collection with-header">
                                                                    <li class="collection-header"><h4>Selladas</h4></li>
                                                                    <li class="collection-item">

                                                                        <?php
                                                                        $kardexSell = "S" . $provBD['KardexGBarraId'];

                                                                        $selladasQuery = "SELECT gbarrasellada.*"
                                                                                . ", licor.licorNombre, categorialicor.categoriaLicorNombre FROM gbarrasellada "
                                                                                . "LEFT JOIN licor ON  gbarrasellada.GBarraSelladaLicor=licor.licorId "
                                                                                . "LEFT JOIN categorialicor ON licor.licorCategoria=categorialicor.categoriaLicorId "
                                                                                . "WHERE gbarrasellada.GBarraSelladaId='$kardexSell' AND licor.licorEstReg='A'"
                                                                                . "ORDER BY licor.licorNombre";

                                                                        $selladasResul = $conexion->query($selladasQuery) or die($conexion->error);
                                                                        if ($selladasResul->num_rows > 0) {
                                                                            echo "<div>
                                                                                        <div class=\"row\">
                                                                                            <div class=\"col offset-s1 s10 offset-m1 m10 offset-l1 l10\">
                                                                                                <table id=\"data-table-row-grouping\" class=\"responsive-table display \" cellspacing=\"0\">
                                                                                                    <thead>
                                                                                                        <tr>
                                                                                                            <th>Producto</th>
                                                                                                            <th>Stock</th>
                                                                                                            <th>categoria</th>
                                                                                                            <th>Mover</th>
                                                                                                        </tr>
                                                                                                    </thead>
                                                                                                    
                                                                                                    <tbody>";
                                                                            while ($row = $selladasResul->fetch_assoc()) {
                                                                                echo "<tr>
                                                                                                <td>" . $row['licorNombre'] . "</td>
                                                                                                <td>" . $row['GBarraSelladaCantidad'] . "</td>
                                                                                                <td>" . $row['categoriaLicorNombre'] . "</td>
                                                                                                <td><a href=\"page-moverSellada.php?origen=$kardexSell&licor=" . $row['GBarraSelladaLicor'] . "\"><span class=\"task-cat cyan\">Mover</span></a></td>
                                                                                                </tr>";
                                                                                //echo $row['kardexSelladaLicor'] . $row['kardexSelladaPrecio'];
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
                                                                            <div class="input-field col s11 l5 m5">
                                                                                <a class="btn cyan waves-effect waves-light right" href="page-configurar-kardex-selladas.php?kardex=<?php echo $provBD['KardexGBarraId']; ?>" >Configurar Stock
                                                                                    <i class="mdi-action-settings left"></i>
                                                                                </a>
                                                                            </div>
                                                                            <div class="input-field col s11 l5 m5">
                                                                                <a class="btn cyan waves-effect waves-light right" href="page-anadir-kardexGSellada.php?codigo=<?php echo $provBD['KardexGBarraId']; ?>&barra=<?php echo $provBD['KardexGBarraIdBarra']; ?>" >Añadir Selladas
                                                                                    <i class="mdi-content-add left"></i>
                                                                                </a>
                                                                            </div>

                                                                        </div>
                                                                        <br><br>
                                                                    </li>

                                                                    <li class="collection-header"><h4>Jarras</h4></li>
                                                                    <li class="collection-item">

                                                                        <?php
                                                                        $kardexSell = "J" . $provBD['KardexGBarraId'];

                                                                        $selladasQuery = "SELECT gbarrajarra.*"
                                                                                . ", licor.licorNombre, categorialicor.categoriaLicorNombre FROM gbarrajarra "
                                                                                . "LEFT JOIN licor ON  gbarrajarra.GBarraJarraLicor=licor.licorId "
                                                                                . "LEFT JOIN categorialicor ON licor.licorCategoria=categorialicor.categoriaLicorId "
                                                                                . "WHERE gbarrajarra.GBarraJarraId='$kardexSell'"
                                                                                . "ORDER BY licor.licorNombre";
                                                                        $selladasResul = $conexion->query($selladasQuery);
                                                                        if ($selladasResul->num_rows > 0) {
                                                                            echo "<div>
                                                                                        <div class=\"row\">
                                                                                            <div class=\"col offset-s1 s10 offset-m1 m10 offset-l1 l10\">
                                                                                                <table id=\"data-table-row-grouping-j\" class=\"responsive-table display \" cellspacing=\"0\">
                                                                                                    <thead>
                                                                                                        <tr>
                                                                                                            <th>Producto</th>
                                                                                                            <th>Stock</th>
                                                                                                            <th>categoria</th>
                                                                                                            <th>Mover</th>
                                                                                                        </tr>
                                                                                                    </thead>
                                                                                                    <tbody>";
                                                                            while ($row = $selladasResul->fetch_assoc()) {
//                                                                                $BLicor = "SELECT * FROM licor WHERE licorId='" . $row['GBarraJarraLicor'] . "'";
//                                                                                $RLic = $conexion->query($BLicor);
//                                                                                $filaLic = $RLic->fetch_assoc();
                                                                                echo "<tr>
                                                                                                <td>" . $row['licorNombre'] . "</td>
                                                                                                <td>" . $row['GBarraJarraCantidad'] . "</td>
                                                                                                <td>" . $row['categoriaLicorNombre'] . "</td>
                                                                                                <td><a href=\"page-moverJarra.php?origen=$kardexSell&licor=" . $row['GBarraJarraLicor'] . "\"><span class=\"task-cat cyan\">Mover</span></a></td>
                                                                                                </tr>";
                                                                                //echo $row['kardexSelladaLicor'] . $row['kardexSelladaPrecio'];
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
                                                                            <div class="input-field col s11 l5 m5">
                                                                                <a class="btn cyan waves-effect waves-light right" href="page-configurar-kardex-jarras.php?kardex=<?php echo $provBD['KardexGBarraId']; ?>" >Configurar Stock
                                                                                    <i class="mdi-action-settings left"></i>
                                                                                </a>
                                                                            </div>
                                                                            <div class="input-field col s11 l5 m5">
                                                                                <a class="btn cyan waves-effect waves-light right" href="page-anadir-kardexGJarra.php?codigo=<?php echo $provBD['KardexGBarraId']; ?>&barra=<?php echo $provBD['KardexGBarraIdBarra']; ?>" >Añadir Jarras
                                                                                    <i class="mdi-content-add left"></i>
                                                                                </a>
                                                                            </div>

                                                                        </div>
                                                                        <br><br>
                                                                    </li>

                                                                    <li class="collection-header"><h4>Vasos</h4></li>
                                                                    <li class="collection-item">

                                                                        <?php
                                                                        $kardexSell = "V" . $provBD['KardexGBarraId'];

                                                                        $selladasQuery = "SELECT gbarravaso.*"
                                                                                . ", licor.licorNombre, categorialicor.categoriaLicorNombre FROM gbarravaso "
                                                                                . "LEFT JOIN licor ON  gbarravaso.GBarraVasoLicor=licor.licorId "
                                                                                . "LEFT JOIN categorialicor ON licor.licorCategoria=categorialicor.categoriaLicorId "
                                                                                . "WHERE gbarravaso.GBarraVasoId='$kardexSell'"
                                                                                . "ORDER BY licor.licorNombre";
                                                                        $selladasResul = $conexion->query($selladasQuery);
                                                                        if ($selladasResul->num_rows > 0) {
                                                                            echo "<div >
                                                                                        <div class=\"row\">
                                                                                            <div class=\"col offset-s1 s10 offset-m1 m10 offset-l1 l10\">
                                                                                                <table id=\"data-table-row-grouping-v\" class=\"responsive-table display \" cellspacing=\"0\">
                                                                                                    <thead>
                                                                                                        <tr>
                                                                                                            <th>Producto</th>
                                                                                                            <th>Stock</th>
                                                                                                            <th>categoria</th>
                                                                                                            <th>Mover</th>
                                                                                                        </tr>
                                                                                                    </thead>
                                                                                                    <tbody>";
                                                                            while ($row = $selladasResul->fetch_assoc()) {
                                                                                $BLicor = "SELECT * FROM licor WHERE licorId='" . $row['GBarraVasoLicor'] . "'";
                                                                                $RLic = $conexion->query($BLicor);
                                                                                $filaLic = $RLic->fetch_assoc();
                                                                                echo "<tr>
                                                                                                <td>" . $filaLic['licorNombre'] . "</td>
                                                                                                <td>" . $row['GBarraVasoCantidad'] . "</td>
                                                                                                <td>" . $row['categoriaLicorNombre'] . "</td>
                                                                                                <td><a href=\"page-moverVaso.php?origen=$kardexSell&licor=" . $row['GBarraVasoLicor'] . "\"><span class=\"task-cat cyan\">Mover</span></a></td>
                                                                                                </tr>";
                                                                                //echo $row['kardexSelladaLicor'] . $row['kardexSelladaPrecio'];
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
                                                                            <div class="input-field col s11 l5 m5">
                                                                                <a class="btn cyan waves-effect waves-light right" href="page-configurar-kardex-vasos.php?kardex=<?php echo $provBD['KardexGBarraId']; ?>" >Configurar Stock
                                                                                    <i class="mdi-action-settings left"></i>
                                                                                </a>
                                                                            </div>
                                                                            <div class="input-field col s11 l5 m5">
                                                                                <a class="btn cyan waves-effect waves-light right" href="page-anadir-kardexGVaso.php?codigo=<?php echo $provBD['KardexGBarraId']; ?>&barra=<?php echo $provBD['KardexGBarraIdBarra']; ?>" >Añadir Vasos
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


        </body>

    </html>
    <?php
}
?>



