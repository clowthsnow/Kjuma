<?php
SESSION_START();

if (!isset($_SESSION['usuario'])) {
    //si no hay sesion activa 
    header("location:index.php");
} else {
    include 'conexion.php';
    $numero = $_GET['numero'];
    if (!isset($numero)) {
        header("location:page-ver-ingresosEconomicos.php");
    }
    $buscar = "SELECT * FROM ingresoeconomico WHERE ingresoEconomicoId='$numero'";
    $resultado = $conexion->query($buscar);
    if ($resultado->num_rows === 0) {
        header("location:page-ver-ingresosEconomicos.php");
    }
    $provBD = $resultado->fetch_assoc();
    ?>
    <!DOCTYPE html>
    <html lang="es">

        <head>
            <title>Configurar Ingresos Economicos</title>
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
                                        <h5 class="breadcrumbs-title">Configurar Ingresos Economicos</h5>
                                        <ol class="breadcrumb">
                                            <li class=" grey-text lighten-4">Gestion de Gastos
                                            </li>
                                            <li class="grey-text lighten-4" >Ver Ingresos</li>
                                            <li class="active blue-text">Configurar Ingresos Economicos</li>
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
                                            <h4 class="header">Configuracion de Ingresos</h4>
                                            <p class="caption">
                                                En este panel usted podra hacer la configuracion de los ingresos, como cambiar fecha, monto, discoteca y la descripcion.
                                            </p>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <!-- Form with validation -->
                                                <div class="col offset-l2 s12 m12 l8">
                                                    <div class="card-panel">
                                                        <h4 class="header2">Ingreso N°: <?php echo $provBD['ingresoEconomicoId']; ?></h4>
                                                        <div class="row">
                                                            <form id="configurar" class="col s12" action="control/modificarIngresoEconomico.php" method="POST">
                                                                <input type="text" hidden="true" name="usuario" value="<?php echo $_SESSION['usuario']; ?>">
                                                                <input type="text" hidden="true" name="numero" value="<?php echo $provBD['ingresoEconomicoId']; ?>">
                                                                <div class="row">
                                                                    <div class="input-field col s12 m6 l6">
                                                                        <input id="fecha" type="text" class="datepicker" name="fecha" required="" value="<?php echo $provBD['ingresoEconomicoDia'] . "-" . $provBD['ingresoEconomicoMes'] . "-" . $provBD['ingresoEconomicoAnio']; ?>">
                                                                        <label for="fecha" class="active">Fecha:</label>
                                                                    </div>
                                                                    <div class="col s12 m6 l6">
                                                                        <label >Discoteca:</label>
                                                                        <select id="disco" class="browser-default" name="discotecas" required="">
                                                                            <option value="" disabled>Escoge una discoteca</option>
                                                                            <?php
                                                                            $buscarD = "SELECT * FROM discoteca";
                                                                            $result = $conexion->query($buscarD);
                                                                            while ($fila = $result->fetch_assoc()) {
                                                                                ?>
                                                                                <option value="<?php echo $fila['discotecaId']; ?>" <?php if($fila['discotecaId']==$provBD['ingresoEconomicoDiscoteca']){echo "selected";}?>><?php echo $fila['discotecaNombre']; ?></option>
                                                                            <?php }
                                                                            ?>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="input-field col s12">
                                                                        <i class="mdi-editor-attach-money prefix"></i>
                                                                        <input id="dinero" type="number" class="validate" name="dinero" step="any" required="" value="<?php echo $provBD['ingresoEconomicoDinero'];?>">
                                                                        <label for="dinero" class="active">Monto:</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="input-field col s12">
                                                                        <i class="mdi-action-speaker-notes prefix"></i>
                                                                        <textarea id="desc" class="materialize-textarea" length="150" name="descripcion" ><?php echo $provBD['ingresoEconomicoDescripcion'];?></textarea>
                                                                        <label for="desc" class="active">Descripcion:</label>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="divider"></div>
                                                                <div class="row">
                                                                    <div class="input-field col s12">
                                                                        <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Guardar Cambios
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
                                <a href="page-ver-ingresosEconomicos.php" class="modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
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


