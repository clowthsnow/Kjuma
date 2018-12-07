<?php
SESSION_START();

if (!isset($_SESSION['usuario'])) {
    //si no hay sesion activa 
    header("location:index.php");
} else {
    include 'conexion.php';
    $codigo = $_GET['codigo'];
    $barra = $_GET['barra'];
    if (!isset($codigo) || !isset($barra)) {
        header("location:page-configurar-kardex.php");
    }
    $consultaBarra = "SELECT * FROM barra WHERE barraId='$barra'";
    $resultadoBarra = $conexion->query($consultaBarra);
    $discoArr = $resultadoBarra->fetch_assoc();
    $discoteca = $discoArr['barraDiscoteca'];

    $consultaUser = "SELECT * FROM gbarrajarra WHERE GBarraJarraId='" . "J" . $codigo . "'";
    $resultadoLicor = $conexion->query($consultaUser) or die($conexion->error);

    $consultaCarta = "SELECT * FROM cartajarra WHERE cartaJarraId='" . "JC" . $discoteca . "'";
    $resultadoCarta = $conexion->query($consultaCarta) or die($conexion->error);


    if ($resultadoLicor->num_rows === 0) {
        $licCarta[] = array();
    }
    while ($fila = $resultadoLicor->fetch_assoc()) {
        $licCarta[] = $fila['GBarraJarraLicor'];
    }
    $cont = 0;
    //$carta = "S" . $codigo;
    //echo $usuario;
    ?>
    <!DOCTYPE html>
    <html lang="es">

        <head>
            <title>Añadir jarras</title>
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
                                        <h5 class="breadcrumbs-title">Añadir Jarras</h5>
                                        <ol class="breadcrumb">
                                            <li class=" grey-text lighten-4">Kardex
                                            </li>
                                            <li class=" grey-text lighten-4">Ver Kardex Generales
                                            </li>
                                            <li class=" grey-text lighten-4">Configurar Kardex
                                            </li>
                                            <li class="active blue-text">Añadir Jarras</li>
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
                                            <h4 class="header">Añadir Jarras a <?php echo $discoArr['barraNombre'];
                ; ?></h4>
                                            <p class="caption">
                                                En este panel usted añadir jarras al kardex. Nota: Ingrese  cantidad de jarras no de selladas (1 sellada= 3 jarras).
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

                                                            while ($row = $resultadoCarta->fetch_assoc()) {
                                                                if (!(in_array($row['cartaJarraLicor'], $licCarta))) {
                                                                    echo "<tr>"
                                                                    . "<td id=\"licor" . $cont . "\">" . $row['cartaJarraLicor'] . "</td>";
                                                                    $licorB = "SELECT * FROM licor WHERE licorId='" . $row['cartaJarraLicor'] . "'";
                                                                    $ejecLic = $conexion->query($licorB);
                                                                    $licor = $ejecLic->fetch_assoc();
                                                                    echo "<td>" . $licor['licorNombre'] . "</td>";
                                                                    $consultaCat = "SELECT * FROM categorialicor WHERE categoriaLicorId='" . $licor['licorCategoria'] . "'";
                                                                    $resultado2 = $conexion->query($consultaCat) or die($conexion->error);
                                                                    if ($row2 = $resultado2->fetch_assoc()) {
                                                                        echo "<td>" . $row2['categoriaLicorNombre'] . "</td>";
                                                                    }

                                                                    echo "<td><div class=\"input-field col s6\"><input id=\"stock" . $cont . "\"placeholder=\"Stock\" id=\"cantidad\" type=\"number\" step=\"any\" class=\"validate\" value=\"\" min=\"0\">
                                                                             </div></td>
                                                                            </tr>";
                                                                    $cont++;
                                                                }
                                                            }
                                                            echo "</tbody>
                                                                        </table>";
                                                            ?>  
                                                            <br>
                                                            <br>
                                                            <div class="divider"></div>
                                                            <div class="row">
                                                                <div class="input-field col s12 m6 l6">
                                                                    <a class="btn cyan waves-effect waves-light right" href="javascript:window.history.back();">Terminar
                                                                        <i class="mdi-content-clear left"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="input-field col s12 m6 l6">
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
                                                                                var codigo = "<?php echo $codigo; ?>";
                                                                                //alert(licores);
                                                                                for (var i = 0; i < licores; i++) {
                                                                                    $templicor = "licor".concat(i);
                                                                                    $tempcant = "stock".concat(i);
                                                                                    $licor = $('#' + $templicor);
                                                                                    $stock = $('#' + $tempcant);
                                                                                    if ($stock.val() !== "") {
                                                                                        $licor.closest('tr').remove();
                                                                                        $.get("control/anadirKardexGJarra.php", {licor: $licor.text(), stock: $stock.val(), codigo: codigo}, function () {

                                                                                        });


                                                                                        console.log($licor.text());
                                                                                        console.log($stock.val());
                                                                                        console.log(codigo);
                                                                                    }


                                                                                }
                                                                            }


                </script>

        </body>

    </html>
    <?php
}
?>

