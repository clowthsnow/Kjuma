<?php
SESSION_START();

if (!isset($_SESSION['usuario'])) {
    //si no hay sesion activa 
    header("location:index.php");
} else {
    include 'conexion.php';
    //echo $usuario;
    date_default_timezone_set('America/Lima');
    $fecha = new DateTime();
    ?>
    <!DOCTYPE html>
    <html lang="es">

        <head>
            <title>Ver Gastos de Dinero</title>
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
                                        <h5 class="breadcrumbs-title">Ver Gastos Economicos</h5>
                                        <ol class="breadcrumb">
                                            <li class=" grey-text lighten-4">Gestion de Gastos
                                            </li>
                                            <li class="active blue-text">Ver Gastos Economicos</li>
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
                                            <h4 class="header">Ver Gastos Economicos</h4>
                                            <p class="caption">
                                                En este panel usted podra ver todos los gastos de dinero, y podra filtrarlos por fecha, discotecas.
                                            </p>
                                            <div class="divider"></div>
                                            <div class="container">
                                                <!--DataTables example-->
                                                <div id="">
                                                    <h4 class="header">Gastos:</h4>
                                                    <div class="row">

                                                        <form class="col s12 l12 m12" id="buscar" action="control/buscarPorFec.php" method="POST">
                                                            <div class="row">
                                                                <div class="input-field col s12 m6 l6">
                                                                    <input id="fecha" type="text" class="datepicker" name="fechaI" required="" value="<?php echo $fecha->format('d-m-Y'); ?>">
                                                                    <label for="fecha" class="active green-text">Desde:</label>
                                                                </div>
                                                                <div class="input-field col s12 m6 l6">
                                                                    <input id="fecha" type="text" class="datepicker" name="fechaF" required="" value="<?php echo $fecha->format('d-m-Y'); ?>">
                                                                    <label for="fecha" class="active red-text">Hasta:</label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col s12 m6 l6">
                                                                    <label >Discoteca:</label>
                                                                    <?php
                                                                    $buscarDisco = "SELECT * FROM discoteca";
                                                                    $result = $conexion->query($buscarDisco);
                                                                    ?>
                                                                    <select id="disco" class="browser-default" name="discotecas" required="">
                                                                        <option value="ambas" selected>Ambas</option>
                                                                        <?php while ($row = $result->fetch_assoc()) { ?>
                                                                            <option value="<?php echo $row['discotecaId']; ?>"><?php echo $row['discotecaNombre']; ?></option>
                                                                        <?php }
                                                                        ?>

                                                                    </select>
                                                                </div>
                                                                <div class="col s12 m6 l6">
                                                                    <label >Detalle:</label>
                                                                    <?php
                                                                    $buscarDisco = "SELECT * FROM proveedor";
                                                                    $result = $conexion->query($buscarDisco);
                                                                    ?>
                                                                    <select id="disco" class="browser-default" name="proveedor" required="">
                                                                        <option value="" disabled="" selected>Escoga el detalle</option>
                                                                        <?php while ($row = $result->fetch_assoc()) { ?>
                                                                            <option value="<?php echo $row['proveedorId']; ?>"><?php echo $row['proveedorNombre']; ?></option>
                                                                        <?php }
                                                                        ?>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="divider"></div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col s12 1l2 m12">
                                                                    <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Buscar
                                                                        <i class="mdi-action-search left"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>



                                                    <br>
                                                    <div class="divider"></div>

                                                    <div class="row" id="resultado">

                                                        
                                                    
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
            <script type="text/javascript" src="js/plugins/data-tables/data-tables-gasto.js"></script>

            <!--plugins.js - Some Specific JS codes for Plugin Settings-->
            <script type="text/javascript" src="js/plugins.js"></script>

            <script>
                var frm = $('#buscar');

                frm.submit(function (ev) {
                    ev.preventDefault();
                    $('#estado').removeAttr("disabled");
                    $.ajax({
                        type: frm.attr('method'),
                        url: frm.attr('action'),
                        data: frm.serialize(),
                        success: function (respuesta) {
                            $('#resultado').html(respuesta);
                        }
                    });


                });
            </script>

        </body>

    </html>
    <?php
}
?>

