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
    $buscarProv = "SELECT * FROM proveedor WHERE proveedorCategoria='Deposito'";
    $resultProv = $conexion->query($buscarProv);
    ?>
    <!DOCTYPE html>
    <html lang="es">

        <head>
            <title>Ingreso Mercaderia</title>
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
                                        <h5 class="breadcrumbs-title">Ingreso de Mercaderia</h5>
                                        <ol class="breadcrumb">
                                            <li class=" grey-text lighten-4">Gestion de Depsito
                                            </li>
                                            <li class="active blue-text" >Ingreso de Mercaderia</li>

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
                                            <h4 class="header">Ingreso de Mercaderia</h4>
                                            <p class="caption">
                                                En este panel usted podra registrar un nuevo ingreso de mercaderia al deposito el cual se registrara tambien en el sistema de gastos.
                                            </p>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <!-- Form with validation -->
                                                <div class="col offset-l1 s12 m12 l10">
                                                    <div class="card-panel">
                                                        <h4 class="header2">Ingreso de Mercaderia</h4>
                                                        <div class="row">
                                                            <form id="create" class="col s12" action="control/crearIngresoMercaderia.php" method="POST">
                                                                <input type="text" hidden="true" name="usuario" id="usuario" value="<?php echo $_SESSION['usuario']; ?>">
                                                                <input type="text" hidden="true" name="hora" id="hora" value="<?php echo $fecha->format('H:i:s'); ?>">
                                                                <div class="row">
                                                                    <div class="input-field col s12 m6 l6">
                                                                        <input id="fecha" type="text" class="datepicker" name="fecha" required="" value="<?php echo $fecha->format('Y-m-d'); ?>">
                                                                        <label for="fecha" class="active">Fecha:</label>
                                                                    </div>
                                                                    <div class="col s12 m6 l6">
                                                                        <label >Proveedor:</label>
                                                                        <select id="cobrador" class="browser-default" name="cobrador" required="">
                                                                            <option value="" disabled selected>Escoge el proveedor:</option>
                                                                            <?php while ($row = $resultProv->fetch_assoc()) { ?>
                                                                                <option value="<?php echo $row['proveedorId']; ?>"><?php echo $row['proveedorNombre']; ?></option>
                                                                            <?php }
                                                                            ?>

                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="input-field col s10 m10 l10">
                                                                        <input id="codigo" type="text" class="validate" name="codigo" required="" onchange="cambiar()">
                                                                        <label for="codigo" id="codigotag">Codigo:</label>
                                                                    </div>
                                                                    <div class="input-field col s1 m1 l1">
                                                                        <a class="btn cyan waves-effect waves-light" onclick="vermateriales()" >
                                                                            <i class="mdi-action-search center"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="input-field col s12 m12 l12">
                                                                        <input id="licor" type="text" class="validate" name="licor" required="" readonly="true">
                                                                        <label id="licortag" for="licor"  >Producto:</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="input-field col s12 m6 l6">
                                                                        <input id="cantidad" type="number" class="validate" name="cantidad" required="" >
                                                                        <label for="cantidad" id="cantidadtag">Cantidad:</label>
                                                                    </div>
                                                                    <div class="col s12 m6 l6">
                                                                        <label >Medida:</label>
                                                                        <select id="medida" class="browser-default" name="medida" required="">

                                                                            <option value="1" selected="">Por Unidad</option>
                                                                            <option value="6">Por Paquete 6</option>
                                                                            <option value="10">Por Paquete 10</option>
                                                                            <option value="12">Por Paquete 12</option>
                                                                            <option value="15">Por Paquete 15</option>
                                                                            <option value="24">Por Paquete 24</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <br>


                                                                <br>
                                                                <div class="divider"></div>
                                                                <div class="row"><h4 class="header2">Datos de Pago</h4></div>
                                                                <div class="row">
                                                                    <div class="input-field col s12">
                                                                        <i class="mdi-editor-attach-money prefix"></i>
                                                                        <input id="dinero" type="number" class="validate" name="dinero" step="any" required="">
                                                                        <label for="dinero" id="dinerotag" >Monto:</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">

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
                                                                    <div class="col s12 m6 l6" id="contenedorTipo">
                                                                        <label >Tipo:</label>
                                                                        <select id="tipoCC" class="browser-default" name="tipo" required="" onchange="tipoPago()">
                                                                            <option value="Contado" selected="">Contado</option>
                                                                            <option value="Credito" >Credito</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col s12 m6 l6">
                                                                        <label >Estado:</label>
                                                                        <select id="estado" class="browser-default" name="estado" required="" disabled="true">
                                                                            <option value="Cancelado" selected>Cancelado</option>
                                                                            <option value="Por Cancelar">Por Cancelar</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="input-field col s12 m6 l6" >
                                                                        <input id="cuotas" type="number" class="validate" name="cuotas" required="" value="0" readonly="true">
                                                                        <label for="cuotas" class="active">Cuotas:</label>
                                                                    </div>
                                                                </div>
                                                                <br>

                                                                <input type="text" hidden="true" name="descripcion"  id="descripcion">
                                                                <br>
                                                                <div class="divider"></div>

                                                                <div class="row">
                                                                    <div class="input-field col s12 l6 m6">
                                                                        <a class="btn cyan waves-effect waves-light right" onclick="limpiar()" >Cancelar
                                                                            <i class="mdi-content-clear left"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="input-field col s12 l6 m6">
                                                                        <button class="btn cyan waves-effect waves-light right"  type="submit" name="action">Añadir
                                                                            <i class="mdi-content-add left"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>      

                                                            </form>
                                                        </div>

                                                        <div id="tabla">
                                                            <br><br>
                                                            <div class="divider"></div>
                                                            <div class="row" >
                                                                <div class="col s12 m12 l12">
                                                                    <table class="hoverable">
                                                                        <thead>
                                                                            <tr>
                                                                                <th data-field="id">Producto</th>
                                                                                <th data-field="name">Cantidad</th>
                                                                                <th data-field="price">Precio Total</th>
                                                                                <th>Precio Unidad</th>
                                                                                <th>Eliminar</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="tablaReg">
                                                                        </tbody>
                                                                    </table>
                                                                </div>

                                                            </div>
                                                            <div class="row">
                                                                <div class="input-field col s12 l12 m12">
                                                                    <a class="btn cyan waves-effect waves-light right"  onclick="verModal()" >Terminar Ingreso
                                                                        <i class="mdi-content-save left"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <br>
                                                            <div class="divider"></div>
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

                         <!--modal materiales-->
                        <div id="modalM" class="modal">
                            <div class="modal-content">
                                <h4 class="red-text">Materiales</h4>
                                <p>Escoja el material que desea usar.</p>
                                <div class="container">
                                    <!--DataTables example-->
                                    <div id="table-datatables">
                                        <h4 class="header">Materiales:</h4>
                                        <div class="row">

                                            <div class="col s12 m12 l12">
                                                <table id="data-table-row-grouping" class="responsive-table display " cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>Codigo</th>
                                                            <th>Nombre</th>
                                                            <th>Stock</th>
                                                            <th>Medida</th>

                                                        </tr>
                                                    </thead>

                                                    <tfoot>
                                                        <tr>
                                                            <th>Codigo</th>
                                                            <th>Nombre</th>
                                                            <th>Stock</th>
                                                            <th>Medida</th>
                                                        </tr>
                                                    </tfoot>

                                                    <tbody>
                                                        <?php
                                                        $consultaDetalle = "SELECT inventariogeneraldetalle.*, licor.*, categorialicor.* FROM inventariogeneraldetalle "
                                                                . "LEFT JOIN licor ON inventariogeneraldetalle.inventarioGeneralDetalleLicor=licor.licorId "
                                                                ."LEFT JOIN categorialicor ON licor.licorCategoria=categorialicor.categoriaLicorId"
                                                                . " WHERE inventarioGeneralDetalleEstReg='A'"
//                                                                . " ORDER BY categorialicor.categoriaLicorNombre"
                                                                . "ORDER BY inventariogeneraldetalle.inventarioGeneralDetalleRango ASC";
                                                        $result = $conexion->query($consultaDetalle) or die($conexion->error);
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo "<tr class=\"mat\" style=\"cursor:pointer;\" onclick=\"anadirMat(this);\">
                                                                                <td>" . $row['inventarioGeneralDetalleLicor'] . "</td>"
                                                            . "<td>" . $row['licorNombre'] . "</td>";

                                                            echo "<td>" . $row['categoriaLicorNombre'] . "</td>"
                                                            . "<td>" . $row['inventarioGeneralDetalleCantidad'] . "</td>" . "</tr>";
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div> 

                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Cerrar</a>
                            </div>
                        </div>

                        
                        
                        <!--modal error-->
                        <div id="modal1" class="modal">
                            <div class="modal-content">
                                <h4 class="red-text">ERROR!!!</h4>
                                <p>Registro de ingreso fallido, intente de nuevo.</p>
                            </div>
                            <div class="modal-footer">
                                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
                            </div>
                        </div>
                        <!--modal error-->
                        <div id="modal2" class="modal">
                            <div class="modal-content">
                                <h4 class="green-text">EXITO!!!</h4>
                                <p>Registro exitoso.</p>
                            </div>
                            <div class="modal-footer">
                                <a href="page-ingreso-mercaderia.php" class="modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
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
            <script type="text/javascript" src="js/plugins/data-tables/data-tables-inventario.js"></script>
            
            
            <!--plugins.js - Some Specific JS codes for Plugin Settings-->
            <script type="text/javascript" src="js/plugins.js"></script>

            <script>
                                                                        $('.datepicker').pickadate({
                                                                            selectMonths: true, // Creates a dropdown to control month
                                                                            selectYears: 15, // Creates a dropdown of 15 years to control year
                                                                            closeOnSelect: true
                                                                        });
                                                                        $(document).ready(function () {

                                                                            // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered

                                                                            $('#modal2').modal();
                                                                            $('#modal1').modal();

                                                                        });
                                                                        
                                                                        function vermateriales() {
                                                                            $('#modalM').openModal();
                                                                        }
                                                                        
                                                                        function anadirMat(e) {
                                                                            console.log(e);
                                                                            console.log(e.cells[0].innerHTML);
                                                                            console.log(e.cells[1].innerHTML);
                                                                            console.log(e.cells[2].innerHTML);

                                                                            $("#codigo").val(e.cells[0].innerHTML);
                                                                            $('#codigotag').attr('class', 'active');
                                                                            $("#licor").val(e.cells[1].innerHTML);
                                                                            $('#licortag').attr('class', 'active');
//                                                                            $("#licorstock").val(e.cells[2].innerHTML);
//                                                                            $('#licorstocktag').attr('class', 'active');

                                                                            $('#modalM').closeModal();
                                                                        }
                                                                        
                                                                        function ocultar() {
                                                                            $('#tabla').hide();
                                                                            $('#codigo').focus();
                                                                        }
                                                                        function mostrar(){
                                                                            $('#tabla').show("fast");
                                                                        }
                                                                        var frm = $('#create');

                                                                        frm.submit(function (ev) {
                                                                            ev.preventDefault();
                                                                            $('#estado').removeAttr("disabled");
                                                                            $descripcion = "Pago por " + ($('#cantidad').val() * $('#medida option:selected').val()) + " unidades de " + $('#licor').val() + " por un monto de S/. " + $('#dinero').val();
                                                                            $('#descripcion').val($descripcion);
                                                                            mostrar();
                                                                            $.ajax({
                                                                                type: frm.attr('method'),
                                                                                url: frm.attr('action'),
                                                                                data: frm.serialize(),
                                                                                success: function (respuesta) {
                                                                                    $('#tablaReg').append(respuesta);
                                                                                    limpiar();
                                                                                }
                                                                            });


                                                                        });

                                                                        function cambiar() {
                                                                            $lic = $('#codigo').val();
                                                                            $('#codigo').attr('readonly', 'true');
                                                                            $('#licortag').attr('class', 'active');
                                                                            $url = "control/buscarLicor.php?codigo=".concat($lic);
                                                                            $.ajax({
                                                                                type: "GET",
                                                                                url: $url,

                                                                                success: function (respuesta) {
                                                                                    $('#licor').val(respuesta);

                                                                                }
                                                                            });
                                                                            $('#cantidad').focus();
                                                                        }

                                                                        function tipoPago() {
                                                                            $tipo = $('#tipoCC option:selected').val();

                                                                            if ($tipo == "Contado") {
                                                                                console.log($tipo);
                                                                                $('#estado').attr('disabled', 'true');
                                                                                $('#cuotas').attr('readonly', 'true');
                                                                            }
                                                                            if ($tipo == "Credito") {
                                                                                console.log($tipo);
                                                                                $('#estado').removeAttr("disabled");
                                                                                $('#cuotas').removeAttr("readonly");
                                                                            }
                                                                        }
                                                                        function limpiar() {
                                                                            $('#codigo').val("");
                                                                            $('#licor').val("");
                                                                            $('#codigo').removeAttr('readonly', 'true');
                                                                            $('#licortag').removeAttr('class', 'active');
                                                                            $('#codigotag').removeAttr('class', 'active');
                                                                            $('#cantidad').val("");
                                                                            $('#cantidadtag').removeAttr('class', 'active');
                                                                            $('#dinero').val("");
                                                                            $('#dinerotag').removeAttr('class', 'active');
                                                                            $('#estado').attr('disabled', 'true');
                                                                            $('#cuotas').attr('readonly', 'true');
                                                                            $('#codigo').focus();

                                                                        }
                                                                        function verModal() {
                                                                            $('#modal2').openModal();
                                                                        }
                                                                        var href;


                                                                        $(document).on('click', '.borrar', function (event) {
                                                                            event.preventDefault();
                                                                            $(this).closest('tr').remove();
                                                                            href = $(this).attr('href');
                                                                            $.ajax({
                                                                                type: "GET",
                                                                                url: href,
                                                                                success: function (respuesta) {

                                                                                    if (respuesta == 1) {

                                                                                    } else {
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

