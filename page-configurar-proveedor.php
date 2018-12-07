<?php
SESSION_START();

if (!isset($_SESSION['usuario'])) {
    //si no hay sesion activa 
    header("location:index.php");
} else {
    include 'conexion.php';
    $proveedor = $_GET['proveedor'];
    if (!isset($proveedor)) {
        header("location:page-ver-proveedores.php");
    }
    $buscar = "SELECT * FROM proveedor WHERE proveedorId='$proveedor'";
    $resultado = $conexion->query($buscar);
    if ($resultado->num_rows === 0) {
        header("location:page-ver-proveedores.php");
    }
    $provBD = $resultado->fetch_assoc();
    /*$consultaPermisos = "SELECT privilegioSistema FROM privilegio WHERE privilegioUsuario='" . $proveedor . "'";
    $result = $conexion->query($consultaPermisos);
    while ($fila = $result->fetch_assoc()) {
        $permisos[] = $fila['privilegioSistema'];
    }*/
    //echo $proveedor;
    ?>
    <!DOCTYPE html>
    <html lang="es">

        <head>
            <title>Configurar Proveedores</title>
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
                                        <h5 class="breadcrumbs-title">Configurar Proveedor</h5>
                                        <ol class="breadcrumb">
                                            <li class=" grey-text lighten-4">Gestion de Gastos
                                            </li>
                                            <li class="grey-text lighten-4" >Ver Proveedores</li>
                                            <li class="active blue-text">Configurar Proveedor</li>
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
                                            <h4 class="header">Configuracion de Proveedores</h4>
                                            <p class="caption">
                                                En este panel usted podra hacer la configuracion de los proveedores, como cambiar detalle, RUC y categoria.
                                            </p>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <!-- Form with validation -->
                                                <div class="col offset-l2 s12 m12 l8">
                                                    <div class="card-panel">
                                                        <h4 class="header2">Proveedor: <?php echo $provBD['proveedorId'] ; ?></h4>
                                                        <div class="row">
                                                            <form id="configurar" class="col s12" action="control/modificarProveedor.php" method="POST">
                                                                <div class="row">
                                                                    <div class="input-field col s12">
                                                                        <input id="username" type="text" class="validate" name="proveedor" required="" hidden="true" value="<?php echo $provBD['proveedorId']; ?>">
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="input-field col s12">
                                                                        <input id="nombre" type="text" class="validate" name="nombre" required="" value="<?php echo $provBD['proveedorNombre']; ?>">
                                                                        <label class="active" for="nombre">Detalle</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="input-field col s12">
                                                                        <input id="type-ruc" type="text" class="validate" name="ruc" required="" value="<?php echo $provBD['proveedorRuc']; ?> " maxlength="11" length="11">
                                                                        <label class="active" for="type-ruc">RUC</label>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col s12">
                                                                        <label>Categoria:</label>
                                                                        <select class="browser-default" name="categorias" required="">
                                                                            <option value="" disabled >Escoge una categoria</option>
                                                                            <option value="Deposito" <?php if($provBD['proveedorCategoria']=="Deposito"){ echo "selected"; } ?>>Depositos</option>
                                                                            <option value="Servicios" <?php if($provBD['proveedorCategoria']=="Servicios"){ echo "selected"; } ?>>Servicios</option>
                                                                            <option value="Planillas" <?php if($provBD['proveedorCategoria']=="Planillas"){ echo "selected"; } ?>>Planillas</option>                                                                            
                                                                            <option value="Utileria" <?php if($provBD['proveedorCategoria']=="Utileria"){ echo "selected"; } ?>>Utileria</option>
                                                                            <option value="Otros" <?php if($provBD['proveedorCategoria']=="Otros"){ echo "selected"; } ?>>Otros</option>
                                                                        </select>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="divider"></div>
                                                                <div class="row">
                                                                    <div class="input-field col s12">
                                                                        <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Guardar Cambios
                                                                            <i class="mdi-content-save left"></i>
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
                                <p> Proveedor modificado correctamente.</p>
                            </div>
                            <div class="modal-footer">
                                <a href="page-ver-proveedores.php" class="modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
                            </div>
                        </div>
                        <!--modal error-->
                        <div id="modal2" class="modal">
                            <div class="modal-content">
                                <h4 class="red-text">ERROR!!!</h4>
                                <p>El proveedor no puedo ser modificado, intentelo de nuevo.</p>
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


