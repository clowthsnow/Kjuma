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
                                                En este panel usted podra ver todos los gastos de dinero, y podra buscarlos por fecha, discotecas, detalle, cancelados, etc.
                                            </p>
                                            <div class="divider"></div>
                                            <div class="container">
                                                <!--DataTables example-->
                                                <div id="table-datatables">
                                                    <h4 class="header">Gastos:</h4>

                                                    <br>
                                                    <div class="divider"></div>
                                                    <div class="row">

                                                        <div class="col s12 m12 l12">
                                                            <table id="data-table-row-grouping" class="responsive-table display " cellspacing="0" width="100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Fecha</th>
                                                                        <th>Discoteca</th>
                                                                        <th>Detalle</th>
                                                                        <th>Monto</th>
                                                                        <th>Descripcion</th>
                                                                        <th>Tipo</th>
                                                                        <th>Estado</th>
                                                                        <th>Usuario</th>
                                                                        <?php
                                                                        if (in_array('5', $_SESSION['permisos'])) {
                                                                            echo "<th>Configurar</th>"
                                                                            . "<th>Eliminar</th>";
                                                                        }
                                                                        ?>
                                                                    </tr>
                                                                </thead>

                                                                <tfoot>
                                                                    <tr>
                                                                        <th>Fecha</th>
                                                                        <th>Discoteca</th>
                                                                        <th>Detalle</th>
                                                                        <th>Monto</th>
                                                                        <th>Descripcion</th>
                                                                        <th>Tipo</th>
                                                                        <th>Estado</th>
                                                                        <th>Usuario</th>
                                                                        <?php
                                                                        if (in_array('5', $_SESSION['permisos'])) {
                                                                            echo "<th>Configurar</th>"
                                                                            . "<th>Eliminar</th>";
                                                                        }
                                                                        ?>
                                                                    </tr>
                                                                </tfoot>

                                                                <tbody>
                                                                    <?php
                                                                    $consultaUser = "SELECT * FROM gastoeconomico WHERE gastoEconomicoEstReg='A'";
                                                                    $resultado = $conexion->query($consultaUser) or die($conexion->error);
                                                                    while ($row = $resultado->fetch_assoc()) {
                                                                        echo "<tr>";
                                                                        $fecha = $row['gastoEconomicoDia'] . "-" . $row['gastoEconomicoMes'] . "-" . $row['gastoEconomicoAnio'];
                                                                        $fecha2=$row['gastoEconomicoFecha'];
                                                                        echo "<td>" . $fecha2 . "</td>";
                                                                        $consulta = "SELECT * FROM discoteca WHERE discotecaId='" . $row['gastoEconomicoDiscoteca'] . "'";
                                                                        $resultado2 = $conexion->query($consulta) or die($conexion->error);
                                                                        while ($disco = $resultado2->fetch_assoc()) {
                                                                            echo "<td>" . $disco['discotecaNombre'] . "</td>";
                                                                        }
                                                                        $consulta2 = "SELECT * FROM proveedor WHERE proveedorId='" . $row['gastoEconomicoCobrador'] . "'";
                                                                        $resultado3 = $conexion->query($consulta2) or die($conexion->error);
                                                                        while ($prov = $resultado3->fetch_assoc()) {
                                                                            echo "<td>" . $prov['proveedorNombre'] . "</td>";
                                                                        }

                                                                        echo "<td>" . $row['gastoEconomicoDinero'] . "</td>
                                                                <td>" . $row['gastoEconomicoDescripcion'] . "</td>
                                                                <td>" . $row['gastoEconomicoTipo'] . "</td>
                                                                <td>" . $row['gastoEconomicoEstado'] . "</td>
                                                                <td>" . $row['gastoEconomicoIdUsuario'] . "</td>";
                                                                        if (in_array('5', $_SESSION['permisos'])) {
                                                                            echo "<td><a href=\"page-configurar-gastosEconomicos.php?numero=" . $row['gastoEconomicoId'] . "\"><span class=\"task-cat cyan\">Configurar</span></a></td>
                                                                          <td><a href=\"control/eliminarGastoEconomico.php?numero=" . $row['gastoEconomicoId'] . "\" class=\"delete\"><span class=\"task-cat red\">Eliminar</span></a></td>";
                                                                        }
                                                                        echo "</tr>";
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                            </table>
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
                                <h4 class="red-text">ERROR!!!</h4>
                                <p>Movimiento no encontrado en la base de datos</p>
                            </div>
                            <div class="modal-footer">
                                <a href="page-ver-proveedores.php" class="modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
                            </div>
                        </div>
                        <!--modal eliminar-->
                        <div id="modal2" class="modal">
                            <div class="modal-content">
                                <h4 class="red-text">ELIMINAR!!!</h4>
                                <p>¿Desea eliminar este movimiento?</p>
                            </div>
                            <div class="modal-footer">                                
                                <a href="#!" id="cancelar" class="modal-action modal-close waves-effect waves-red btn-flat">Cancelar</a>
                                <a href="#!" id="eliminar" class="modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
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
            <script type="text/javascript" src="js/plugins/data-tables/data-tables-ingE.js"></script>

            <!--plugins.js - Some Specific JS codes for Plugin Settings-->
            <script type="text/javascript" src="js/plugins.js"></script>

            <script>

                $('#agrupar').click(function () {
                    if ($('#switch').prop('checked')) {

                    } else {
                        console.log("no");
                    }
                });
                $(document).ready(function () {
                    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
                    $('#modal1').modal();
                    $('#modal2').modal();
                });
                var href;
                $('.delete').click(function (evt) {
                    evt.preventDefault();
                    $('#modal2').openModal();
                    href = $(this).attr('href');
                });

                $('#eliminar').click(function (ev) {
                    ev.preventDefault();

                    $.ajax({
                        type: "GET",
                        url: href,
                        success: function (respuesta) {

                            if (respuesta == 1) {
                                location.reload(true);
                                //$('#modal1').openModal();
                            } else {

                                $('#modal1').openModal();
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

