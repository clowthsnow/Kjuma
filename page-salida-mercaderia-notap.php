<?php
SESSION_START();

if (!isset($_SESSION['usuario'])) {
    //si no hay sesion activa 
    header("location:index.php");
} else {
    include 'conexion.php';
    date_default_timezone_set('America/Lima');
    $fecha = new DateTime();
    $buscar = "SELECT * FROM discoteca";
    $result = $conexion->query($buscar);
    $buscarProv = "SELECT * FROM barra";
    $resultProv = $conexion->query($buscarProv);
    ?>
    <!DOCTYPE html>
    <html lang="es">

        <head>
            <title>Salida Mercaderia</title>
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


        </head>

        <body onload="ocultar()">

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
                                        <h5 class="breadcrumbs-title">Salida de Mercaderia</h5>
                                        <ol class="breadcrumb">
                                            <li class=" grey-text lighten-4">Gestion de Deposito
                                            </li>
                                            <li class="active blue-text" >Salida de Mercaderia</li>

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
                                            <h4 class="header">Salida de Mercaderia</h4>
                                            <p class="caption">
                                                En este panel usted podra realizar una salida de deposito hacia las respectivas barras.
                                            </p>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <!-- Form with validation -->
                                                <div class="col offset-l1 s12 m12 l10">
                                                    <div class="card-panel">
                                                        <h4 class="header2">Salida de Mercaderia</h4>
                                                        <div class="row">
                                                            <form id="create" class="col s12" action="page-salida-mercaderia-barra.php" method="POST">
                                                                <input type="text" hidden="true" name="usuario" id="usuario" value="<?php echo $_SESSION['usuario']; ?>">
                                                                <div class="row">
                                                                    <div class="input-field col s12 m6 l6">
                                                                        <input id="fecha" type="text" class="datepicker" name="fecha" required="" value="<?php echo $fecha->format('Y-m-d'); ?>">
                                                                        <label for="fecha" class="active">Fecha:</label>
                                                                    </div>
                                                                    <div class="col s12 m6 l6">

                                                                    </div>
                                                                </div>
                                                                <div class="row">

                                                                    <div class="col s12 m6 l6">
                                                                        <label >Discoteca:</label>
                                                                        <select id="disco" class="browser-default" name="discotecas" required="" onchange="cargarBarra(this.value)">
                                                                            <option value="" disabled selected>Escoge una discoteca</option>
                                                                            <?php while ($row = $result->fetch_assoc()) { ?>
                                                                                <option value="<?php echo $row['discotecaId']; ?>"><?php echo $row['discotecaNombre']; ?></option>
                                                                            <?php }
                                                                            ?>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col s12 m6 l6" id="contenedorTipo">
                                                                        <label >Barra:</label>
                                                                        <select id="barra" class="browser-default" name="barra" required="" >
                                                                            <option value="Contado"  disabled="true" selected="">Seleccione una barra</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <br>
                                                                <br>
                                                                <div class="divider"></div>

                                                                <div class="row">
                                                                    <div class="input-field col s12 l12 m12">
                                                                        <button class="btn cyan waves-effect waves-light right"  type="submit" name="action">Crear nota de Pedido
                                                                            <i class="mdi-content-add left"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>      

                                                            </form>
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
                                                                        $('.datepicker').pickadate({
                                                                            selectMonths: true, // Creates a dropdown to control month
                                                                            selectYears: 15 // Creates a dropdown of 15 years to control year
                                                                        });
                                                                       

                                                                        function cargarBarra(str) {

                                                                            $url2 = "control/buscarBarra.php?codigo=".concat(str);
                                                                            $.ajax({
                                                                                type: "GET",
                                                                                url: $url2,
                                                                                success: function (respuesta) {
                                                                                    $('#barra').html(respuesta);
                                                                                }
                                                                            });
                                                                        }
                                                                        
                                                                        



            </script>
        </body>

    </html>
    <?php
}
?>

