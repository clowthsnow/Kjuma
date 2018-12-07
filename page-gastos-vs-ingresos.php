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
    $anio = $fecha->format('Y');
    //echo $anio;
    $mesesIngresoSsiomama = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
    $mesesSalidaSsiomama = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

    $mesesIngresoKjuma = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
    $mesesSalidaKjuma = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

    //ssiomama
    $buscarIngresos = "SELECT * FROM ingresoeconomico WHERE ingresoEconomicoAnio='$anio' AND ingresoEconomicoDiscoteca='D001'";
    $resultadoIngresos = $conexion->query($buscarIngresos) or die($conexion->error);
    while ($fila = $resultadoIngresos->fetch_assoc()) {
        $monto = ($fila['ingresoEconomicoDinero'] * 1.0);
        if ($fila['ingresoEconomicoMes'] == 1) {
            $mesesIngresoSsiomama[0] = $mesesIngresoSsiomama[0] + $monto;
        } elseif ($fila['ingresoEconomicoMes'] == 2) {
            $mesesIngresoSsiomama[1] = $mesesIngresoSsiomama[1] + $monto;
        } elseif ($fila['ingresoEconomicoMes'] == 3) {
            $mesesIngresoSsiomama[2] = $mesesIngresoSsiomama[2] + $monto;
        } elseif ($fila['ingresoEconomicoMes'] == 4) {
            $mesesIngresoSsiomama[3] = $mesesIngresoSsiomama[3] + $monto;
        } elseif ($fila['ingresoEconomicoMes'] == 5) {
            $mesesIngresoSsiomama[4] = $mesesIngresoSsiomama[4] + $monto;
        } elseif ($fila['ingresoEconomicoMes'] == 6) {
            $mesesIngresoSsiomama[5] = $mesesIngresoSsiomama[5] + $monto;
        } elseif ($fila['ingresoEconomicoMes'] == 7) {
            $mesesIngresoSsiomama[6] = $mesesIngresoSsiomama[6] + $monto;
        } elseif ($fila['ingresoEconomicoMes'] == 8) {
            $mesesIngresoSsiomama[7] = $mesesIngresoSsiomama[7] + $monto;
        } elseif ($fila['ingresoEconomicoMes'] == 9) {
            $mesesIngresoSsiomama[8] = $mesesIngresoSsiomama[8] + $monto;
        } elseif ($fila['ingresoEconomicoMes'] == 10) {
            $mesesIngresoSsiomama[9] = $mesesIngresoSsiomama[9] + $monto;
        } elseif ($fila['ingresoEconomicoMes'] == 11) {
            $mesesIngresoSsiomama[10] = $mesesIngresoSsiomama[10] + $monto;
        } elseif ($fila['ingresoEconomicoMes'] == 12) {
            $mesesIngresoSsiomama[11] = $mesesIngresoSsiomama[11] + $monto;
        }
    }

    $buscarSalidas = "SELECT * FROM gastoeconomico WHERE gastoEconomicoAnio='$anio' AND gastoEconomicoDiscoteca='D001'";
    $resultadoSalida = $conexion->query($buscarSalidas) or die($conexion->error);
    while ($fila = $resultadoSalida->fetch_assoc()) {
        $monto = ($fila['gastoEconomicoDinero'] * 1.0);
        if ($fila['gastoEconomicoMes'] == 1) {
            $mesesSalidaSsiomama[0] = $mesesSalidaSsiomama[0] + $monto;
        } elseif ($fila['gastoEconomicoMes'] == 2) {
            $mesesSalidaSsiomama[1] = $mesesSalidaSsiomama[1] + $monto;
        } elseif ($fila['gastoEconomicoMes'] == 3) {
            $mesesSalidaSsiomama[2] = $mesesSalidaSsiomama[2] + $monto;
        } elseif ($fila['gastoEconomicoMes'] == 4) {
            $mesesSalidaSsiomama[3] = $mesesSalidaSsiomama[3] + $monto;
        } elseif ($fila['gastoEconomicoMes'] == 5) {
            $mesesSalidaSsiomama[4] = $mesesSalidaSsiomama[4] + $monto;
        } elseif ($fila['gastoEconomicoMes'] == 6) {
            $mesesSalidaSsiomama[5] = $mesesSalidaSsiomama[5] + $monto;
        } elseif ($fila['gastoEconomicoMes'] == 7) {
            $mesesSalidaSsiomama[6] = $mesesSalidaSsiomama[6] + $monto;
        } elseif ($fila['gastoEconomicoMes'] == 8) {
            $mesesSalidaSsiomama[7] = $mesesSalidaSsiomama[7] + $monto;
        } elseif ($fila['gastoEconomicoMes'] == 9) {
            $mesesSalidaSsiomama[8] = $mesesSalidaSsiomama[8] + $monto;
        } elseif ($fila['gastoEconomicoMes'] == 10) {
            $mesesSalidaSsiomama[9] = $mesesSalidaSsiomama[9] + $monto;
        } elseif ($fila['gastoEconomicoMes'] == 11) {
            $mesesSalidaSsiomama[10] = $mesesSalidaSsiomama[10] + $monto;
        } elseif ($fila['gastoEconomicoMes'] == 12) {
            $mesesSalidaSsiomama[11] = $mesesSalidaSsiomama[11] + $monto;
        }
    }

    //kjuma

    $buscarIngresos = "SELECT * FROM ingresoeconomico WHERE ingresoEconomicoAnio='$anio' AND ingresoEconomicoDiscoteca='D002'";
    $resultadoIngresos = $conexion->query($buscarIngresos) or die($conexion->error);
    while ($fila = $resultadoIngresos->fetch_assoc()) {
        $monto = ($fila['ingresoEconomicoDinero'] * 1.0);
        if ($fila['ingresoEconomicoMes'] == 1) {
            $mesesIngresoKjuma[0] = $mesesIngresoKjuma[0] + $monto;
        } elseif ($fila['ingresoEconomicoMes'] == 2) {
            $mesesIngresoKjuma[1] = $mesesIngresoKjuma[1] + $monto;
        } elseif ($fila['ingresoEconomicoMes'] == 3) {
            $mesesIngresoKjuma[2] = $mesesIngresoKjuma[2] + $monto;
        } elseif ($fila['ingresoEconomicoMes'] == 4) {
            $mesesIngresoKjuma[3] = $mesesIngresoKjuma[3] + $monto;
        } elseif ($fila['ingresoEconomicoMes'] == 5) {
            $mesesIngresoKjuma[4] = $mesesIngresoKjuma[4] + $monto;
        } elseif ($fila['ingresoEconomicoMes'] == 6) {
            $mesesIngresoKjuma[5] = $mesesIngresoKjuma[5] + $monto;
        } elseif ($fila['ingresoEconomicoMes'] == 7) {
            $mesesIngresoKjuma[6] = $mesesIngresoKjuma[6] + $monto;
        } elseif ($fila['ingresoEconomicoMes'] == 8) {
            $mesesIngresoKjuma[7] = $mesesIngresoKjuma[7] + $monto;
        } elseif ($fila['ingresoEconomicoMes'] == 9) {
            $mesesIngresoKjuma[8] = $mesesIngresoKjuma[8] + $monto;
        } elseif ($fila['ingresoEconomicoMes'] == 10) {
            $mesesIngresoKjuma[9] = $mesesIngresoKjuma[9] + $monto;
        } elseif ($fila['ingresoEconomicoMes'] == 11) {
            $mesesIngresoKjuma[10] = $mesesIngresoKjuma[10] + $monto;
        } elseif ($fila['ingresoEconomicoMes'] == 12) {
            $mesesIngresoKjuma[11] = $mesesIngresoKjuma[11] + $monto;
        }
    }

    $buscarSalidas = "SELECT * FROM gastoeconomico WHERE gastoEconomicoAnio='$anio' AND gastoEconomicoDiscoteca='D002'";
    $resultadoSalida = $conexion->query($buscarSalidas) or die($conexion->error);
    while ($fila = $resultadoSalida->fetch_assoc()) {
        $monto = ($fila['gastoEconomicoDinero'] * 1.0);
        if ($fila['gastoEconomicoMes'] == 1) {
            $mesesSalidaKjuma[0] = $mesesSalidaKjuma[0] + $monto;
        } elseif ($fila['gastoEconomicoMes'] == 2) {
            $mesesSalidaKjuma[1] = $mesesSalidaKjuma[1] + $monto;
        } elseif ($fila['gastoEconomicoMes'] == 3) {
            $mesesSalidaKjuma[2] = $mesesSalidaKjuma[2] + $monto;
        } elseif ($fila['gastoEconomicoMes'] == 4) {
            $mesesSalidaKjuma[3] = $mesesSalidaKjuma[3] + $monto;
        } elseif ($fila['gastoEconomicoMes'] == 5) {
            $mesesSalidaKjuma[4] = $mesesSalidaKjuma[4] + $monto;
        } elseif ($fila['gastoEconomicoMes'] == 6) {
            $mesesSalidaKjuma[5] = $mesesSalidaKjuma[5] + $monto;
        } elseif ($fila['gastoEconomicoMes'] == 7) {
            $mesesSalidaKjuma[6] = $mesesSalidaKjuma[6] + $monto;
        } elseif ($fila['gastoEconomicoMes'] == 8) {
            $mesesSalidaKjuma[7] = $mesesSalidaKjuma[7] + $monto;
        } elseif ($fila['gastoEconomicoMes'] == 9) {
            $mesesSalidaKjuma[8] = $mesesSalidaKjuma[8] + $monto;
        } elseif ($fila['gastoEconomicoMes'] == 10) {
            $mesesSalidaKjuma[9] = $mesesSalidaKjuma[9] + $monto;
        } elseif ($fila['gastoEconomicoMes'] == 11) {
            $mesesSalidaKjuma[10] = $mesesSalidaKjuma[10] + $monto;
        } elseif ($fila['gastoEconomicoMes'] == 12) {
            $mesesSalidaKjuma[11] = $mesesSalidaKjuma[11] + $monto;
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="es">

        <head>
            <title>Gastos Vs Ingresos</title>
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

            <link href="js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">



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
                                        <h5 class="breadcrumbs-title">Gastos Vs Ingresos</h5>
                                        <ol class="breadcrumb">
                                            <li class=" grey-text lighten-4">Gestion de Gastos
                                            </li>
                                            <li class="active blue-text">Gastos Vs Ingresos</li>
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
                                            <h4 class="header">Gastos Vs Ingresos</h4>
                                            <p class="caption">
                                                En esta pagina ustes podra observar graficamente el estado de ingreso y gastos por mes de las discotecas
                                            </p>
                                            <div class="divider"></div>
                                            <div class="container">
                                                <!--DataTables example-->
                                                <div id="">
                                                    <h4 class="header">Ssiomama:</h4>
                                                    <div class="row">
                                                        <!--Bar Chart-->
                                                        <div class="col s12 m2 l2">
                                                            <ul class="bar-chart-legend">
                                                                <li class=" ultra-small" style="background-color:rgba(220,220,220,1);"><span class="" >Ingresos</span></li>
                                                                <li class=" ultra-small" style="background-color:rgba(151,187,205,1);"><span class="legend-color"></span>Gastos</li>
                                                            </ul>
                                                        </div>
                                                        <div id="chartjs-bar-chart" class="section">

                                                            <div class="row">

                                                                <div class="col s12 m12 l12">
                                                                    <div class="sample-chart-wrapper">
                                                                        <canvas id="bar-chart-sample" height="120"></canvas>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>



                                                    <br>
                                                    <div class="divider "></div>

                                                    <div class="row" id="resultado">



                                                    </div> 

                                                </div>


                                                <div id="">
                                                    <h4 class="header">K-Juma:</h4>
                                                    <div class="row">
                                                        <div class="col s12 m2 l2">
                                                            <ul class="bar-chart-legend">
                                                                <li class=" ultra-small" style="background-color:rgba(220,220,220,1);"><span class="" >Ingresos</span></li>
                                                                <li class=" ultra-small" style="background-color:rgba(151,187,205,1);"><span class="legend-color"></span>Gastos</li>
                                                            </ul>
                                                        </div>
                                                        <!--Bar Chart-->
                                                        <div id="chartjs-bar-chart2" class="section">

                                                            <div class="row">

                                                                <div class="col s12 m12 l12">
                                                                    <div class="sample-chart-wrapper">
                                                                        <canvas id="bar-chart-sample2" height="120"></canvas>
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


            <!-- chartjs -->
            <script type="text/javascript" src="js/plugins/chartjs/chart.min.js"></script>
            <!--<script type="text/javascript" src="js/plugins/chartjs/chartjs-sample-chart.js"></script>-->


            <!--plugins.js - Some Specific JS codes for Plugin Settings-->
            <script type="text/javascript" src="js/plugins.js"></script>

            <script>


    //Sampel Bar Chart
                var BarChartSampleData = {
                    labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                    datasets: [
                        {
                            label: "Ingresos",
                            fillColor: "rgba(220,220,220,0.5)",
                            strokeColor: "rgba(220,220,220,0.8)",
                            highlightFill: "rgba(220,220,220,0.75)",
                            highlightStroke: "rgba(220,220,220,1)",
                            data: [<?php echo $mesesIngresoSsiomama[0]; ?>, <?php echo $mesesIngresoSsiomama[1]; ?>, <?php echo $mesesIngresoSsiomama[2]; ?>, <?php echo $mesesIngresoSsiomama[3]; ?>, <?php echo $mesesIngresoSsiomama[4]; ?>, <?php echo $mesesIngresoSsiomama[5]; ?>, <?php echo $mesesIngresoSsiomama[6]; ?>,<?php echo $mesesIngresoSsiomama[7]; ?>,<?php echo $mesesIngresoSsiomama[8]; ?>,<?php echo $mesesIngresoSsiomama[9]; ?>,<?php echo $mesesIngresoSsiomama[10]; ?>,<?php echo $mesesIngresoSsiomama[11]; ?>]
                        },
                        {
                            label: "Gastos",
                            fillColor: "rgba(151,187,205,0.5)",
                            strokeColor: "rgba(151,187,205,0.8)",
                            highlightFill: "rgba(151,187,205,0.75)",
                            highlightStroke: "rgba(151,187,205,1)",
                            data: [<?php echo $mesesSalidaSsiomama[0]; ?>, <?php echo $mesesSalidaSsiomama[1]; ?>, <?php echo $mesesSalidaSsiomama[2]; ?>, <?php echo $mesesSalidaSsiomama[3]; ?>, <?php echo $mesesSalidaSsiomama[4]; ?>, <?php echo $mesesSalidaSsiomama[5]; ?>, <?php echo $mesesSalidaSsiomama[6]; ?>,<?php echo $mesesSalidaSsiomama[7]; ?>,<?php echo $mesesSalidaSsiomama[8]; ?>,<?php echo $mesesSalidaSsiomama[9]; ?>,<?php echo $mesesSalidaSsiomama[10]; ?>,<?php echo $mesesSalidaSsiomama[11]; ?>]
                        }
                    ]
                };

                var BarChartSampleData2 = {
                    labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                    datasets: [
                        {
                            label: "Ingresos",
                            fillColor: "rgba(220,220,220,0.5)",
                            strokeColor: "rgba(220,220,220,0.8)",
                            highlightFill: "rgba(220,220,220,0.75)",
                            highlightStroke: "rgba(220,220,220,1)",
                            data: [<?php echo $mesesIngresoKjuma[0]; ?>, <?php echo $mesesIngresoKjuma[1]; ?>, <?php echo $mesesIngresoKjuma[2]; ?>, <?php echo $mesesIngresoKjuma[3]; ?>, <?php echo $mesesIngresoKjuma[4]; ?>, <?php echo $mesesIngresoKjuma[5]; ?>, <?php echo $mesesIngresoKjuma[6]; ?>,<?php echo $mesesIngresoKjuma[7]; ?>,<?php echo $mesesIngresoKjuma[8]; ?>,<?php echo $mesesIngresoKjuma[9]; ?>,<?php echo $mesesIngresoKjuma[10]; ?>,<?php echo $mesesIngresoKjuma[11]; ?>]
                        },
                        {
                            label: "Gastos",
                            fillColor: "rgba(151,187,205,0.5)",
                            strokeColor: "rgba(151,187,205,0.8)",
                            highlightFill: "rgba(151,187,205,0.75)",
                            highlightStroke: "rgba(151,187,205,1)",
                            data: [<?php echo $mesesSalidaKjuma[0]; ?>, <?php echo $mesesSalidaKjuma[1]; ?>, <?php echo $mesesSalidaKjuma[2]; ?>, <?php echo $mesesSalidaKjuma[3]; ?>, <?php echo $mesesSalidaKjuma[4]; ?>, <?php echo $mesesSalidaKjuma[5]; ?>, <?php echo $mesesSalidaKjuma[6]; ?>,<?php echo $mesesSalidaKjuma[7]; ?>,<?php echo $mesesSalidaKjuma[8]; ?>,<?php echo $mesesSalidaKjuma[9]; ?>,<?php echo $mesesSalidaKjuma[10]; ?>,<?php echo $mesesSalidaKjuma[11]; ?>]
                        }
                    ]
                };




                window.onload = function () {



                    window.BarChartSample = new Chart(document.getElementById("bar-chart-sample").getContext("2d")).Bar(BarChartSampleData, {
                        segmentStrokeColor: "#fff",
                        tooltipTitleFontFamily: "'Roboto','Helvetica Neue', 'Helvetica', 'Arial', sans-serif", // String - Tooltip title font declaration for the scale label		
                        percentageInnerCutout: 50,
                        animationSteps: 100,
                        segmentStrokeWidth: 4,
                        animateScale: true,
                        percentageInnerCutout: 60,
                        responsive: true,
                        legend: true
                    });

                    window.BarChartSample = new Chart(document.getElementById("bar-chart-sample2").getContext("2d")).Bar(BarChartSampleData2, {
                        responsive: true
                    });


                    var ctx = document.getElementById("bar-chart-sample");

                    var chart = new Chart(ctx, {
                        type: 'bar',
                        data: BarChartSampleData,
                        options: {
                            legend: {
                                display: true,
                                labels: {
                                    fontColor: 'rgb(255, 99, 132)'
                                }
                            }
                        }
                    });


                };
            </script>
        </body>

    </html>
    <?php
}
?>

