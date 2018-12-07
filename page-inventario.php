<?php
SESSION_START();

if (!isset($_SESSION['usuario'])) {
    //si no hay sesion activa 
    header("location:index.php");
} else {
    include 'conexion.php';
    //echo $usuario;
    ?>
    <!DOCTYPE html>
    <html lang="es">

        <head>
            <title>Inventario</title>
            <!--Let browser know website is optimized for mobile-->
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            <!-- Favicons-->
            <link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">


            <!-- CORE CSS-->    
            <link href="css/materialize.css" type="text/css" rel="stylesheet">
            <link href="css/style.css" type="text/css" rel="stylesheet" >
            <link href="css/estilos.css" type="text/css" rel="stylesheet" >

            <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->    
            <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
            <link href="js/plugins/data-tables/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet" media="screen,projection">



        </head>

        <body>


            <!-- //////////////////////////////////////////////////////////////////////////// -->

            <!-- //////////////////////////////////////////////////////////////////////////// -->

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
                                        <h5 class="breadcrumbs-title">Inventario</h5>
                                        <ol class="breadcrumb">
                                            <li class=" grey-text lighten-4">Gestion de Deposito
                                            </li>
                                            <li class="active blue-text">Inventario</li>
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
                                            <h4 class="header">Inventario</h4>
                                            <p class="caption">
                                                En este panel usted podra ver todos los productos inventariados del deposito.
                                            </p>
                                            <div class="divider"></div>
                                            <div class="container">
                                                <!--DataTables example-->
                                                <div id="table-datatables">

                                                    <div class="row">

                                                        <div class="col s12 m12 l12">

                                                            <?php
                                                            $consultaUser = "SELECT * FROM inventariogeneral WHERE inventarioGeneralId='1'";
                                                            $resultado = $conexion->query($consultaUser) or die($conexion->error);
                                                            if ($fila = $resultado->fetch_assoc()) {
                                                                if ($fila['inventarioGeneralEstado'] == 0) {
                                                                    echo "<br><br><div class=\"input-field center\">
                                                                        <a href=\"page-inicio-inventario.php\" class=\"btn cyan waves-effect waves-light\">Iniciar Inventario
                                                                            <i class=\"mdi-image-edit left\"></i>
                                                                        </a>
                                                                    </div>";
                                                                } else {
                                                                    echo "<table id=\"data-table-row-grouping\" class=\"responsive-table display \" cellspacing=\"0\">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Codigo</th>
                                                                                    <th>Producto</th>
                                                                                    <th>Categoria</th>
                                                                                    <th>Stock</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tfoot>
                                                                                <tr>
                                                                                    <th>Codigo</th>
                                                                                    <th>Nombre</th>
                                                                                    <th>Categoria</th>
                                                                                    <th>Stock</th>
                                                                                </tr>
                                                                            </tfoot>
                                                                            <tbody>";
                                                                    $consultaDetalle = "SELECT inventariogeneraldetalle.*, cartasellada.*, licor.*, categorialicor.* FROM inventariogeneraldetalle "
                                                                            . "LEFT JOIN licor ON inventariogeneraldetalle.inventarioGeneralDetalleLicor=licor.licorId "
                                                                            . "LEFT JOIN cartasellada ON licor.licorId=cartasellada.cartaSelladaLicor AND cartasellada.cartaSelladaId='SCD001'"
                                                                            . " LEFT JOIN categorialicor ON licor.licorCategoria=categorialicor.categoriaLicorId "
//                                                                                . " WHERE inventarioGeneralDetalleEstReg='A'"
//                                                                                . " ORDER BY licor.licorNombre"
                                                                            . "ORDER BY inventariogeneraldetalle.inventarioGeneralDetalleRango DESC";
                                                                    $result = $conexion->query($consultaDetalle) or die($conexion->error);
                                                                    while ($row = $result->fetch_assoc()) {
                                                                        echo "<tr>
                                                                                <td>" . $row['inventarioGeneralDetalleLicor'] . "</td>";

//                                                                            $consultarLic = "SELECT * FROM licor WHERE licorId='" . $row['inventarioGeneralDetalleLicor'] . "'";
//                                                                            $resultado3 = $conexion->query($consultarLic);
//                                                                            if ($row3 = $resultado3->fetch_assoc()) {
//                                                                                echo "<td>" . $row3['licorNombre'] . "</td>";
//                                                                                $consultaCat = "SELECT * FROM categorialicor WHERE categoriaLicorId='" . $row3['licorCategoria'] . "'";
//                                                                                $resultado2 = $conexion->query($consultaCat) or die($conexion->error);
//                                                                                if ($row2 = $resultado2->fetch_assoc()) {
//                                                                                    
//                                                                                    
//                                                                                }
//                                                                            }

                                                                        echo "<td>" . $row['licorNombre'] . "</td>";
                                                                        echo "<td>" . $row['categoriaLicorNombre'] . "</td>";
                                                                        echo "<td>" . $row['inventarioGeneralDetalleCantidad'] . "</td>
                                                                                </tr>";
                                                                    }
                                                                    echo "</tbody>
                                                                            </table>";
//                                                                        
                                                                }
                                                            }
                                                            ?>                                                            
                                                        </div>
                                                    </div>
                                                </div> 

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col s4 m6 l12">

                                    <a href="page-imprimir-deposito.php" class="waves-effect waves-light btn">Imprimir</a>
                                </div>
                            </div>
                        </div>
                        <!--end container-->

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
            <script type="text/javascript" src="js/plugins/data-tables/data-tables-inventario.js"></script>

            <!--plugins.js - Some Specific JS codes for Plugin Settings-->
            <script type="text/javascript" src="js/plugins.js"></script>


        </body>

    </html>
    <?php
}
?>

