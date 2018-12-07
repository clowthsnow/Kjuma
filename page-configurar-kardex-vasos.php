<?php
SESSION_START();

if (!isset($_SESSION['usuario'])) {
    //si no hay sesion activa 
    header("location:index.php");
} else {
    include 'conexion.php';
    $kardex = $_GET['kardex'];
    if (!isset($kardex)) {
        header("location:page-configurar-kardex.php");
    }
    $buscar = "SELECT kardexgbarra.* ,barra.barraNombre FROM kardexgbarra "
            . "LEFT JOIN barra ON kardexgbarra.KardexGBarraIdBarra=barra.barraId "
            . "WHERE KardexGBarraId='$kardex'";
    $resultado = $conexion->query($buscar);
//    if ($resultado->num_rows === 0) {
//        header("location:page-ver-kardexGenerales.php");
//    }
    $provBD = $resultado->fetch_assoc();
    $cont = 0;
    ?>
    <!DOCTYPE html>
    <html lang="es">

        <head>
            <title>Configurar Stock Vasos</title>
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
                                        <h5 class="breadcrumbs-title">Configurar Stock Vasos</h5>
                                        <ol class="breadcrumb">
                                            <li class=" grey-text lighten-4">Kardex
                                            </li>
                                            <li class=" grey-text lighten-4">Ver Kardex Generales
                                            </li>
                                            <li class=" grey-text lighten-4">Configurar Kardex
                                            </li>
                                            <li class="active blue-text">Configurar Stock Vasos</li>
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
                                            <h4 class="header">Configurar Stock Vasos a <?php
                                                echo $provBD['barraNombre'];
                                                ;
                                                ?></h4>
                                            <p class="caption">
                                                En este panel usted podra configurar stock de vasos del kardex.
                                            </p>
                                            <div class="divider"></div>
                                            <div class="container">
                                                <!--DataTables example-->
                                                <div id="table-datatables">

                                                    <div class="row">

                                                        <div class="col s12 m12 l12">

                                                            <?php
                                                            $kardexSell = "V" . $provBD['KardexGBarraId'];

                                                            $selladasQuery = "SELECT gbarravaso.*"
                                                                    . " ,licor.licorNombre, categorialicor.categoriaLicorNombre FROM gbarravaso "
                                                                    . "LEFT JOIN licor ON  gbarravaso.GBarraVasoLicor=licor.licorId "
                                                                    . "LEFT JOIN categorialicor ON licor.licorCategoria=categorialicor.categoriaLicorId "
                                                                    . "WHERE gbarravaso.GBarraVasoId='$kardexSell'"
                                                                    . "ORDER BY licor.licorNombre";

                                                            $selladasResul = $conexion->query($selladasQuery) or die($conexion->error);


                                                            echo "<table id=\"data-table-row-grouping\" class=\"responsive-table display \" cellspacing=\"0\">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Codigo</th>
                                                                                <th>Producto</th>
                                                                                <th>categoria</th>
                                                                                <th>Stock</th>
                                                                                
                                                                            </tr>
                                                                        </thead>
                                                                            <tfoot>
                                                                                <tr>
                                                                                    <th>Codigo</th>
                                                                                    <th>Producto</th>
                                                                                    <th>categoria</th>
                                                                                    <th>Stock</th>
                                                                                </tr>
                                                                            </tfoot>
                                                                            <tbody>";

                                                            while ($row = $selladasResul->fetch_assoc()) {
                                                                echo "<tr>
                                                                    <td id=\"licor" . $cont . "\">" . $row['GBarraVasoLicor'] . "</td>
                                                                    <td>" . $row['licorNombre'] . "</td>
                                                                    <td>" . $row['categoriaLicorNombre'] . "</td>
                                                                    <td><div class=\"input-field col s6\"><input id=\"stock" . $cont . "\"placeholder=\"Stock\" id=\"cantidad\" type=\"number\" step=\"any\" class=\"validate\" value=\"" . $row['GBarraVasoCantidad'] . "\" min=\"0\">
                                                                             </div>" . "</td>

                                                                    </tr>";
                                                                //echo $row['kardexSelladaLicor'] . $row['kardexSelladaPrecio'];
                                                                $cont++;
                                                            }
                                                            echo "</tbody>
                                                                        </table>";
                                                            ?>  
                                                            <br>
                                                            <br>
                                                            <div class="divider"></div>
                                                            <div class="row">
                                                                <div class="input-field col s6 hide" id="terminar">
                                                                    <a class="btn cyan waves-effect waves-light right" href="javascript:window.history.back();">Terminar
                                                                        <i class="mdi-content-clear left"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="input-field col s6">
                                                                    <button class="btn cyan waves-effect waves-light right" name="action" onclick="guardar()">Guardar Stock

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
            <script type="text/javascript" src="js/plugins/data-tables/data-tables-anadir.js"></script>

            <!--plugins.js - Some Specific JS codes for Plugin Settings-->
            <script type="text/javascript" src="js/plugins.js"></script>

            <script>

                                                                        function guardar() {
                                                                            var licores =<?php echo $cont; ?>;
                                                                            var codigo = "<?php echo $kardex; ?>";
                                                                            //alert(licores);
                                                                            for (var i = 0; i < licores; i++) {
                                                                                $templicor = "licor".concat(i);
                                                                                $tempcant = "stock".concat(i);
                                                                                $licor = $('#' + $templicor);
                                                                                $stock = $('#' + $tempcant);
                                                                                if ($stock.val() !== "") {
                                                                                    $url = "control/configurarKardexGVaso.php?licor=" + $licor.text() + "&stock=" + $stock.val() + "&codigo=" + codigo;
                                                                                    console.log($url);
                                                                                    $.ajax({
                                                                                        type: 'GET',
                                                                                        url: $url,
                                                                                        async: false,

                                                                                        success: function (respuesta) {
                                                                                            console.log(respuesta);
                                                                                            //                                                console.log(respuesta);
                                                                                            //                                                    location.reload();
                                                                                            //                                                    if (jarraTrue == 0) {
                                                                                            //
                                                                                            //                                                        location.reload();
                                                                                            //                                                    }

                                                                                        }
                                                                                    });
                                                                                }
                                                                                $('#terminar').removeAttr('class','hide');
                                                                                $('#terminar').attr('class','input-field col s6');


                                                                            }
                                                                            //                                                                            window.location.reload();
                                                                        }


            </script>

        </body>

    </html>
    <?php
}
?>

