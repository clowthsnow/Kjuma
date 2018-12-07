<?php
SESSION_START();

if (!isset($_SESSION['usuario'])) {
    //si no hay sesion activa 
    header("location:index.php");
} else {
    include 'conexion.php';
    $numero = $_GET['numero'];
    if (!isset($numero)) {
        header("location:page-ver-gastos.php");
    }
    $buscar = "SELECT * FROM gastoeconomico WHERE gastoEconomicoId='$numero'";
    $resultado = $conexion->query($buscar);
    if ($resultado->num_rows === 0) {
        header("location:page-ver-gastos.php");
    }
    $provBD = $resultado->fetch_assoc();

    $buscardis = "SELECT * FROM discoteca";
    $result = $conexion->query($buscardisc);
    $buscarProv = "SELECT * FROM proveedor";
    $resultProv = $conexion->query($buscarProv);
    ?>
    <!DOCTYPE html>
    <html lang="es">

        <head>
            <title>Configurar Gastos Economicos</title>
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
                                        <h5 class="breadcrumbs-title">Configurar Gastos Economicos</h5>
                                        <ol class="breadcrumb">
                                            <li class=" grey-text lighten-4">Gestion de Gastos
                                            </li>
                                            <li class="grey-text lighten-4" >Ver Ingresos</li>
                                            <li class="active blue-text">Configurar Gastos Economicos</li>
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
                                            <h4 class="header">Configuracion de gastos</h4>
                                            <p class="caption">
                                                En este panel usted podra hacer la configuracion de los gastos, como cambiar fecha, monto, discoteca y la descripcion.
                                            </p>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <!-- Form with validation -->
                                                <div class="col offset-l2 s12 m12 l8">
                                                    <div class="card-panel">
                                                        <h4 class="header2">Gasto N°: <?php echo $provBD['gastoEconomicoId']; ?></h4>
                                                        <div class="row">
                                                            <form id="create" class="col s12" action="control/crearGastoEconomico.php" method="POST">
                                                                <input type="text" hidden="true" name="usuario" value="<?php echo $_SESSION['usuario']; ?>">
                                                                <div class="row">
                                                                    <div class="input-field col s12 m6 l6">
                                                                        <input id="fecha" type="text" class="datepicker" name="fecha" required="" value="<?php echo $fecha->format('d-m-Y'); ?>">
                                                                        <label for="fecha" class="active">Fecha:</label>
                                                                    </div>
                                                                    <div class="col s12 m6 l6">
                                                                        <label >Discoteca:</label>
                                                                        <select id="disco" class="browser-default" name="discotecas" required="">
                                                                            <option value="" disabled selected>Escoge una discoteca</option>
                                                                            <?php while ($row = $result->fetch_assoc()) { ?>
                                                                                <option value="<?php echo $row['discotecaId']; ?>"><?php echo $row['discotecaNombre']; ?></option>
                                                                            <?php }
                                                                            ?>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col s12 m6 l6">
                                                                        <label >Detalle:</label>
                                                                        <select id="cobrador" class="browser-default" name="cobrador" required="">
                                                                            <option value="" disabled selected>Escoge el detalle:</option>
                                                                            <?php while ($row = $resultProv->fetch_assoc()) { ?>
                                                                                <option value="<?php echo $row['proveedorId']; ?>"><?php echo $row['proveedorNombre']; ?></option>
                                                                            <?php }
                                                                            ?>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col s12 m6 l6" id="contenedorTipo">
                                                                        <label >Tipo:</label>
                                                                        <select id="tipoCC" class="browser-default" name="tipo" required="">
                                                                            <option value="Contado" selected="">Contado</option>
                                                                            <option value="Credito" >Credito</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col s12 m6 l6">
                                                                        <label >Estado:</label>
                                                                        <select id="cobrador" class="browser-default" name="estado" required="">
                                                                            <option value="Cancelado" selected>Cancelado</option>
                                                                            <option value="Por Cancelar">Por Cancelar</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="input-field col s12 m6 l6" >
                                                                        <input id="dinero" type="number" class="validate" name="cuotas" required="" value="0">
                                                                        <label for="dinero" class="active">Cuotas:</label>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                    <div class="input-field col s12">
                                                                        <i class="mdi-editor-attach-money prefix"></i>
                                                                        <input id="dinero" type="number" class="validate" name="dinero" step="any" required="">
                                                                        <label for="dinero" >Monto:</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="input-field col s12">
                                                                        <i class="mdi-action-speaker-notes prefix"></i>
                                                                        <textarea id="desc" class="materialize-textarea" length="150" name="descripcion"></textarea>
                                                                        <label for="desc">Descripcion:</label>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="divider"></div>
                                                                <div class="row">
                                                                    <div class="input-field col s12">
                                                                        <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Guardar
                                                                            <i class="mdi-image-edit left"></i>
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
                        <!--modal correcto-->
                        <div id="modal1" class="modal">
                            <div class="modal-content">
                                <h4 class="green-text">EXITO!!!</h4>
                                <p> Movimiento modificado correctamente.</p>
                            </div>
                            <div class="modal-footer">
                                <a href="page-ver-gastosEconomicos.php" class="modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
                            </div>
                        </div>
                        <!--modal error-->
                        <div id="modal2" class="modal">
                            <div class="modal-content">
                                <h4 class="red-text">ERROR!!!</h4>
                                <p>Movimiento no puedo ser modificado, intentelo de nuevo.</p>
                            </div>
                            <div class="modal-footer">
                                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
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

            <!--plugins.js - Some Specific JS codes for Plugin Settings-->
            <script type="text/javascript" src="js/plugins.js"></script>

            <script>
                $(document).ready(function () {
                    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
                    $('input#type-ruc').characterCounter();
                    $('#modal1').modal();
                    $('#modal2').modal();
                });
                var frm = $('#configurar');

                frm.submit(function (ev) {
                    ev.preventDefault();
                    $.ajax({
                        type: frm.attr('method'),
                        url: frm.attr('action'),
                        data: frm.serialize(),
                        success: function (respuesta) {
                            if (respuesta == 1) {
                                $('#modal1').openModal();
                            } else {

                                $('#modal2').openModal();
                            }
                        }
                    });


                });
            </script>

        </body>

    </html>
    <?php
}
?>


