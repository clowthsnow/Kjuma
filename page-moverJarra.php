<?php
SESSION_START();

if (!isset($_SESSION['usuario'])) {
    //si no hay sesion activa 
    header("location:index.php");
} else {
    include 'conexion.php';
    $licor = $_GET['licor'];
    $origen = $_GET['origen'];
    if (!isset($licor) || !isset($origen)) {
        header("location:page-configurar-kardex.php");
    }
//    $buscar = "SELECT * FROM licor WHERE licorId='$licor'";
//    $resultado = $conexion->query($buscar);
//    if ($resultado->num_rows === 0) {
//        header("location:page-ver-licores.php");
//    }
//    $provBD = $resultado->fetch_assoc();
    $buscar = "SELECT gbarrajarra.*, licor.licorNombre, kardexgbarra.KardexGBarraIdBarra, barra.barraNombre, discoteca.discotecaNombre, discoteca.discotecaId "
            . "FROM gbarrajarra "
            . "LEFT JOIN licor ON gbarrajarra.GBarraJarraLicor=licor.licorId "
            . "LEFT JOIN kardexgbarra ON gbarrajarra.GBarraJarraId=kardexgbarra.KardexGBarraJarras "
            . "LEFT JOIN barra ON kardexgbarra.KardexGBarraIdBarra=barra.barraId "
            . "LEFT JOIN discoteca ON barra.barraDiscoteca=discoteca.discotecaId "
            . "WHERE gbarrajarra.GBarraJarraId='$origen' AND gbarrajarra.GBarraJarraLicor='$licor'";
    $resultadoBusq = $conexion->query($buscar) or die($conexion->error);
    $resultado = $resultadoBusq->fetch_assoc();
//    print_r($resultado);
    $kardexG="K".$resultado['KardexGBarraIdBarra'];
    ?>
    <!DOCTYPE html>
    <html lang="es">

        <head>
            <title>Mover Jarras</title>
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
                                        <h5 class="breadcrumbs-title">Mover Jarras</h5>
                                        <ol class="breadcrumb">
                                            <li class=" grey-text lighten-4">Kardex
                                            </li>
                                            <li class="grey-text lighten-4" >Ver Kardex Generales</li>
                                            <li class="grey-text lighten-4" >Configurar Kardex </li>
                                            <li class="active blue-text">Mover Jarras</li>
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
                                            <h4 class="header">Mover Jarras</h4>
                                            <p class="caption">
                                                En este panel usted podra mover jarras de una barra hacia otra como sellada, barra o jarra.
                                            </p>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <!-- Form with validation -->
                                                <div class="col offset-l2 s12 m12 l8">
                                                    <div class="card-panel">
                                                        <h4 class="header2">Mover: <?php echo $resultado['licorNombre']; ?> <br> Stock: <?php echo $resultado['GBarraJarraCantidad']; ?> <br> De: <?php echo $resultado['discotecaNombre'] . "-" . $resultado['barraNombre']; ?><br> A: </h4>
                                                        <div class="row">
                                                            <form id="configurar" class="col s12" action="control/moverJarras.php" method="POST">
                                                                <div class="row">
                                                                    <div class="input-field col s12">
                                                                        <input id="" type="text" class="validate" name="origen" required="" hidden="true" value="<?php echo $resultado['GBarraJarraId']; ?>">
                                                                        <input id="" type="text" class="validate" name="licor" required="" hidden="true" value="<?php echo $resultado['GBarraJarraLicor']; ?>">
                                                                        <input id="" type="text" class="validate" name="stockBD" required="" hidden="true" value="<?php echo $resultado['GBarraJarraCantidad']; ?>">
                                                                    </div>
                                                                </div>


                                                                <div class="row">
                                                                    <div class="col s12 m6 l6">
                                                                        <label >Discoteca:</label>
                                                                        <select id="disco" class="browser-default" name="discotecas" required="" onchange="cargarBarra(this.value)">
                                                                            <option value="" disabled selected="">Escoge una discoteca</option>
                                                                            <?php
                                                                            $buscarD = "SELECT * FROM discoteca";
                                                                            $result = $conexion->query($buscarD) or die($conexion->error);
                                                                            while ($fila = $result->fetch_assoc()) {
                                                                                ?>
                                                                                <option value="<?php echo $fila['discotecaId']; ?>"><?php echo $fila['discotecaNombre']; ?></option>
                                                                            <?php }
                                                                            ?>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col s12 m6 l6" id="contenedorTipo">
                                                                        <label >Barra:</label>
                                                                        <select id="barra" class="browser-default" name="barra" required="" >
                                                                            <option value=""  disabled="true" selected="">Seleccione una barra</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="input-field col s12 m6 l6">
                                                                        <input id="nombre" type="number" class="validate" name="stock" required="" value="" max="<?php echo $resultado['GBarraSelladaCantidad']; ?>" min="0">
                                                                        <label class="" for="nombre">Jarras:</label>
                                                                    </div>
                                                                    <div class="col s12 m6 l6" id="contenedorTipo">
                                                                        <label >Como:</label>
                                                                        <select id="" class="browser-default" name="tipo" required="" >
                                                                            <option value="SK" >Sellada</option>
                                                                            <option value="JK" selected="" >Jarra</option>
                                                                            <option value="VK" >Vaso</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="divider"></div>
                                                                <div class="row">
                                                                    <div class="input-field col s12 l6 m6">
                                                                        <a class="btn cyan waves-effect waves-light right" href="javascript:window.history.back();">Atras
                                                                            <i class="mdi-content-reply left"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="input-field col s12 l6 m6">
                                                                        <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Mover
                                                                            <i class="mdi-action-swap-horiz left"></i>
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
                                <p> Movimiento realizado.</p>
                            </div>
                            <div class="modal-footer">
                                <a href="page-configurar-kardex.php?kardex=<?php echo $kardexG;?>" class="modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
                            </div>
                        </div>
                        <!--modal error-->
                        <div id="modal2" class="modal">
                            <div class="modal-content">
                                <h4 class="red-text">ERROR!!!</h4>
                                <p>Error, intentelo de nuevo.</p>
                            </div>
                            <div class="modal-footer">
                                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
                            </div>
                        </div>
                        <!--modal error2-->
                        <div id="modal3" class="modal">
                            <div class="modal-content">
                                <h4 class="red-text">ERROR!!!</h4>
                                <p>Error al transformar de jarras a selladas, no cubre una sellada entera, intentelo de nuevo.</p>
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
                                                                                $('#modal3').modal();
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
                                                                                            if(respuesta==2){
                                                                                                $('#modal3').openModal();
                                                                                            }
                                                                                            else{
                                                                                                $('#modal2').openModal();
                                                                                            }
                                                                                            
                                                                                        }
                                                                                    }
                                                                                });


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


