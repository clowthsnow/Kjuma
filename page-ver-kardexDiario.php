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
            <title>Ver Kardex Diarios</title>
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
                                        <h5 class="breadcrumbs-title">Kardex Diarios</h5>
                                        <ol class="breadcrumb">
                                            <li class=" grey-text lighten-4">Kardex
                                            </li>
                                            <li class="active blue-text">Kardex Diarios</li>
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
                                            <h4 class="header">Kardex Diaros</h4>
                                            <p class="caption">
                                                Estos kardex se generan para cada noche de trabajo.
                                            </p>
                                            <div class="divider"></div>
                                            <div class="container">
                                                <!--DataTables example-->
                                                <div id="table-datatables">
                                                    <h4 class="header">Kardex:</h4>
                                                    <div class="row">

                                                        <div class="col s12 m12 l12">
                                                            <table id="data-table-simple" class="responsive-table display " cellspacing="0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Codigo</th>
                                                                        <th>Discoteca</th>
                                                                        <th>Barra</th>
                                                                        <th>Crear/Imprimir/Cerrar</th>
                                                                    </tr>
                                                                </thead>

                                                                <tfoot>
                                                                    <tr>
                                                                        <th>Codigo</th>
                                                                        <th>Discoteca</th>
                                                                        <th>Barra</th>
                                                                        <th>Crear/Imprimir/Cerrar</th>
                                                                    </tr>
                                                                </tfoot>

                                                                <tbody>
                                                                    <?php
                                                                    $consultaUser = "SELECT * FROM kardexgbarra WHERE KardexGBarraEstReg='A'";
                                                                    $resultado = $conexion->query($consultaUser);
                                                                    while ($row = $resultado->fetch_assoc()) {
                                                                        $consultaActivo = "SELECT * FROM kardex WHERE kardexBarra='" . $row['KardexGBarraIdBarra'] . "' AND kardexEstado='0'";
                                                                        $resultActivo = $conexion->query($consultaActivo);

                                                                        echo "<tr>
                                                                        <td>" . $row['KardexGBarraId'] . "</td>";
                                                                        $consulta = "SELECT * FROM barra WHERE barraId='" . $row['KardexGBarraIdBarra'] . "'";
                                                                        $resultado2 = $conexion->query($consulta) or die($conexion->error);
                                                                        if ($barra = $resultado2->fetch_assoc()) {
                                                                            $consulta2 = "SELECT * FROM discoteca WHERE discotecaId='" . $barra['barraDiscoteca'] . "'";
                                                                            $resultado3 = $conexion->query($consulta2) or die($conexion->error);
                                                                            if ($disco = $resultado3->fetch_assoc()) {
                                                                                echo "<td>" . $disco['discotecaNombre'] . "</td>";
                                                                            }
                                                                            echo "<td>" . $barra['barraNombre'] . "</td>";
                                                                        }
                                                                        if ($resultActivo->num_rows === 0) {
                                                                            echo "<td><a href=\"page-crear-KardexDiario.php?barra=" . $row['KardexGBarraIdBarra'] . "\"><span class=\"task-cat cyan\">Crear</span></a></td>";
                                                                        } else {
                                                                            echo "<td><a href=\"page-ver-kardex.php?barra=" . $row['KardexGBarraIdBarra'] . "\" target=\"_blank\"><span class=\"task-cat indigo\">Imprimir</span></a>"
                                                                                    . " "."<a href=\"page-cerrar-kardex.php?barra=" . $row['KardexGBarraIdBarra'] . "\" target=\"_blank\"><span class=\"task-cat red\">Cerrar</span></a></td>";
                                                                        }
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
            <script type="text/javascript" src="js/plugins/data-tables/data-tables-script.js"></script>

            <!--plugins.js - Some Specific JS codes for Plugin Settings-->
            <script type="text/javascript" src="js/plugins.js"></script>



        </body>

    </html>
    <?php
}
?>

