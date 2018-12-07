<?php
SESSION_START();

if (!isset($_SESSION['usuario'])) {
    //si no hay sesion activa 
    header("location:index.php");
} else {
    include 'conexion.php';
    $consultaUser = "SELECT * FROM inventariogeneral WHERE inventarioGeneralId='1'";
    $resultado = $conexion->query($consultaUser) or die($conexion->error);
    $fila = $resultado->fetch_assoc();
    if ($fila['inventarioGeneralEstado'] == 1) {
        header("location:page-inventario.php");
    }
    $cont=0;
    //echo $usuario;
    ?>
    <!DOCTYPE html>
    <html lang="es">

        <head>
            <title>Iniciar Inventario</title>
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
                                        <h5 class="breadcrumbs-title">Iniciar Inventario</h5>
                                        <ol class="breadcrumb">
                                            <li class=" grey-text lighten-4">Gestion de Deposito
                                            </li>
                                            <li class=" grey-text lighten-4">Inventario
                                            </li>
                                            <li class="active blue-text">Iniciar Inventario</li>
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
                                            <h4 class="header">Iniciar Invetario</h4>
                                            <p class="caption">
                                                En este panel usted dar el valor inicial a todos los productos para poder trabajar correctamente.
                                            </p>
                                            <div class="divider"></div>
                                            <div class="container">
                                                <!--DataTables example-->
                                                <div id="table-datatables">

                                                    <div class="row">

                                                        <div class="col s12 m12 l12">

                                                            <?php
                                                            echo "<table id=\"data-table-row-grouping\" class=\"responsive-table display \" cellspacing=\"0\">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Codigo</th>
                                                                                <th>Producto</th>
                                                                                <th>Categoria</th>
                                                                                <th>Inicio</th>
                                                                            </tr>
                                                                        </thead>
                                                                            <tfoot>
                                                                                <tr>
                                                                                    <th>Codigo</th>
                                                                                    <th>Nombre</th>
                                                                                    <th>Categoria</th>
                                                                                    <th>Inicio</th>
                                                                                </tr>
                                                                            </tfoot>
                                                                            <tbody>";
                                                            $consultaDetalle = "SELECT * FROM inventariogeneraldetalle WHERE inventarioGeneralDetalleEstReg='A'";
                                                            $result = $conexion->query($consultaDetalle) or die($conexion->error);
                                                            
                                                            while ($row = $result->fetch_assoc()) {
                                                                echo "<tr>
                                                                            <td id=\"licor".$cont."\">" . $row['inventarioGeneralDetalleLicor'] . "</td>";
                                                                $consultarLic = "SELECT * FROM licor WHERE licorId='" . $row['inventarioGeneralDetalleLicor'] . "'";
                                                                $resultado3 = $conexion->query($consultarLic);
                                                                if ($row3 = $resultado3->fetch_assoc()) {
                                                                    echo "<td>" . $row3['licorNombre'] . "</td>";
                                                                    $consultaCat = "SELECT * FROM categorialicor WHERE categoriaLicorId='" . $row3['licorCategoria'] . "'";
                                                                    $resultado2 = $conexion->query($consultaCat) or die($conexion->error);
                                                                    if ($row2 = $resultado2->fetch_assoc()) {
                                                                        echo "<td>" . $row2['categoriaLicorNombre'] . "</td>";
                                                                    }
                                                                }
                                                                echo "<td><div class=\"input-field col s6\"><input id=\"stock".$cont."\"placeholder=\"Inicio\" id=\"cantidad\" type=\"number\" step=\"any\" class=\"validate\" value=\"" . $row['inventarioGeneralDetalleCantidad'] . "\">
                                                                             </div></td>
                                                                            </tr>";
                                                                $cont++;
                                                            }
                                                            echo "</tbody>
                                                                        </table>";
                                                            ?>  
                                                            <br>
                                                            <br>
                                                            <div class="divider"></div>
                                                            <div class="row">
                                                                <div class="input-field col s12">
                                                                    <button class="btn cyan waves-effect waves-light right" name="action" onclick="guardar()">Guardar Cambios
                                                                        <i class="mdi-content-save left"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 

                                            </div>
                                        </div>
                                    </div>
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

            <script>
                
                function guardar(){
                    var licores=<?php echo $cont; ?>;
                    //alert(licores);
                    for(var i=0;i<licores;i++){
                        $templicor="licor".concat(i);
                        $tempcant="stock".concat(i);
                        $licor=$('#'+$templicor);
                        $stock=$('#'+$tempcant);
                        $.get( "control/guardarInventario.php", { licor:$licor.text() , cantidad: $stock.val() }, function (){
                            window.location.href="page-inventario.php";
                        });
                    }
                }
                
                
            </script>

        </body>

    </html>
    <?php
}
?>

