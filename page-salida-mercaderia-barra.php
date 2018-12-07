<?php
SESSION_START();

if (!isset($_SESSION['usuario'])) {
    //si no hay sesion activa 
    header("location:index.php");
} else {
    include 'conexion.php';
    date_default_timezone_set('America/Lima');
    $fecha = new DateTime();

    $usuario = $_POST['usuario'];
    $fecha2 = $_POST['fecha'];
    $discoteca = $_POST['discotecas'];
    $barra = $_POST['barra'];

    $buscar = "SELECT * FROM discoteca WHERE discotecaId='$discoteca'";
    $discoB = $conexion->query($buscar);
    if ($row = $discoB->fetch_assoc()) {
        $discoNombre = $row['discotecaNombre'];
    }
    $buscarBarra = "SELECT * FROM barra WHERE barraId='$barra'";
    $barraB = $conexion->query($buscarBarra);
    if ($row2 = $barraB->fetch_assoc()) {
        $barraNombre = $row2['barraNombre'];
    }
    ?>
    <!DOCTYPE html>
    <html lang="es">

        <head>
            <title>Salida Mercaderia</title>
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
                                        <h5 class="breadcrumbs-title">Salida de Mercaderia</h5>
                                        <ol class="breadcrumb">
                                            <li class=" grey-text lighten-4">Gestion de Deposito
                                            </li>
                                            <li class="active blue-text" >Salida de Mercaderia</li>

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
                                            <h4 class="header">Salida de Mercaderia </h4>
                                            <p class="caption">
                                                En este panel usted podra realizar una salida de deposito hacia las respectivas barras.
                                            </p>
                                            <div class="divider"></div>
                                            <div class="row">
                                                <!-- Form with validation -->
                                                <div class="col offset-l1 s12 m12 l10">
                                                    <div class="card-panel">
                                                        <h4 class="header2">Salida de Mercaderia <b><?php echo $discoNombre . "-" . $barraNombre ?></b></h4>
                                                        <div class="row">
                                                            <form id="create" class="col s12" >
                                                                <input type="text" hidden="true" name="usuario" id="usuario" value="<?php echo $usuario; ?>">
                                                                <input type="text" hidden="true" name="hora" id="hora" value="<?php echo $fecha->format('H:i:s'); ?>">                                                                
                                                                <input type="text" hidden="true" name="fecha" id="hora" value="<?php echo $fecha2; ?>">



                                                                <br>
                                                                <br>
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
                                                                    <div class="input-field col s12 m6 l6">
                                                                        <input id="licor" type="text" class="validate" name="licor" required="" readonly="true">
                                                                        <label id="licortag" for="licor"  >Producto:</label>
                                                                    </div>
                                                                    <div class="input-field col s12 m6 l6">
                                                                        <input id="licorstock" type="text" class="validate" name="stock" required="" readonly="true">
                                                                        <label id="licorstocktag" for="licor"  >Stock:</label>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <br>
                                                                <div class="row">
                                                                    <div class="input-field col s12 m6 l6">
                                                                        <input id="cantidad" type="number" class="validate" name="cantidad" required="" min="0" >
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

                                                                <div class="row">
                                                                    <div class="col s12 m6 l6">
                                                                        <label >Uso:</label>
                                                                        <select id="uso" class="browser-default" name="uso" required="">
                                                                            <option value="1" selected>Selladas</option>
                                                                            <option value="3">Jarras</option>
                                                                            <option value="12">Vasos</option>
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                                <br>
                                                                <br>
                                                                <div class="divider"></div>

                                                                <div class="row">
                                                                    <div class="input-field col s12 l6 m6">
                                                                        <a class="btn cyan waves-effect waves-light right" onclick="limpiar()" >Limpiar
                                                                            <i class="mdi-content-clear left"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="input-field col s12 l6 m6">
                                                                        <button class="btn cyan waves-effect waves-light right"  type="submit" name="action" onclick="anadirTabla($('#codigo').val(), $('#licorstock').val(), $('#cantidad').val(), $('#medida').val(), $('#uso').val())">Añadir
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
                                                                    <table class="hoverable" id="peds">
                                                                        <thead>
                                                                            <tr>
                                                                                <th data-field="id">Producto</th>
                                                                                <th data-field="name">Cantidad(Botellas)</th>
                                                                                <th>Uso</th>
                                                                                <th>Eliminar</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="tablaReg">
                                                                        </tbody>
                                                                    </table>
                                                                </div>

                                                            </div>
                                                            <div class="row">
                                                                <div class="input-field col s12 l6 m6">
                                                                    <a class="btn cyan waves-effect waves-light right"  onclick="registrar()" >Guardar Salida de Productos
                                                                        <i class="mdi-content-save left"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="input-field col s12 l6 m6">
                                                                    <a class="btn red waves-effect waves-light right"  onclick="cancelar()" >Cancelar Nota de Pedido
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
                        <div id="modalM" class="modal modal-fixed-footer">
                            <div class="modal-content">
                                <h4 class="red-text">Productos</h4>
                                <p>Escoja el producto que desea usar.</p>
                                <div class="container" id="contenido-tabla">
                                    <!--DataTables example-->
                                    <div id="table-datatables">
                                        <h4 class="header">Productos:</h4>
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
                                                                . "LEFT JOIN categorialicor ON licor.licorCategoria=categorialicor.categoriaLicorId"
                                                                . " WHERE inventarioGeneralDetalleEstReg='A'"
//                                                                . " ORDER BY categorialicor.categoriaLicorNombre"
                                                                . "ORDER BY inventariogeneraldetalle.inventarioGeneralDetalleRango DESC";
                                                        $result = $conexion->query($consultaDetalle) or die($conexion->error);
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo "<tr class=\"mat\" style=\"cursor:pointer;\" onclick=\"anadirMat(this);\">
                                                                                <td>" . $row['inventarioGeneralDetalleLicor'] . "</td>"
                                                            . "<td>" . $row['licorNombre'] . "</td>";

                                                            echo "<td>" . $row['categoriaLicorNombre'] . "</td>"
                                                            . "<td id=\"" . $row['licorId'] . "\">" . $row['inventarioGeneralDetalleCantidad'] . "</td>" . "</tr>";
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
                                <p>Stock insuficiente</p>
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
                                <a href="page-salida-mercaderia-notap.php" class="modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
                            </div>
                        </div>
                        <!--modal error-->
                        <div id="modal3" class="modal">
                            <div class="modal-content">
                                <h4 class="red-text">ERROR!!!</h4>
                                <p>No puede usar el producto para ese tipo de uso</p>
                            </div>
                            <div class="modal-footer">
                                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
                            </div>
                        </div>

                        <!--modal error-->
                        <div id="modal4" class="modal">
                            <div class="modal-content">
                                <h4 class="red-text">¿Desea Cancelar la nota de pedido?</h4>
                                <p>Si usted presiona "SI" la nota de pedido se cancelara y ningun cambio sera guardado</p>
                            </div>
                            <div class="modal-footer">
                                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">No</a>
                                <a href="page-salida-mercaderia-notap.php" class="modal-action modal-close waves-effect waves-red btn-flat">Si</a>
                            </div>
                        </div>
                        
                        <!--modal error-->
                        <div id="modal5" class="modal">
                            <div class="modal-content">
                                <h4 class="red-text">ERROR!!!</h4>
                                <p>Se produjo un error al guardar producto.</p>
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

            <!-- data-tables -->
            <script type="text/javascript" src="js/plugins/data-tables/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="js/plugins/data-tables/data-tables-inventario.js"></script>

            <!--plugins.js - Some Specific JS codes for Plugin Settings-->
            <script type="text/javascript" src="js/plugins.js"></script>

            <script>

                                                                        var contador = 0;
                                                                        var estate = "";
                                                                        var barra = "<?php echo $barra; ?>";
                                                                        var discoteca = "<?php echo $discoteca; ?>";

                                                                        $('.datepicker').pickadate({
                                                                            selectMonths: true, // Creates a dropdown to control month
                                                                            selectYears: 15 // Creates a dropdown of 15 years to control year
                                                                        });
                                                                        $(document).ready(function () {

                                                                            // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered

                                                                            $('#modal2').modal();
                                                                            $('#modal1').modal();
                                                                            $('#modal3').modal();
                                                                            $('#modalM').modal();
                                                                        });
                                                                        function anadirTabla(codigo, stock, cantidad, medida, uso) {
                                                                            var usotxt = "Selladas";
                                                                            $codigos = codigo;
                                                                            if (uso == 3) {
                                                                                usotxt == "Jarras";
                                                                            }
                                                                            if (uso == 12) {
                                                                                usotxt == "Vasos";
                                                                            }
                                                                            if ((cantidad * medida * 1.0) <= (stock * 1.0)) {


                                                                                var url1 = "control/buscar-licor.php?uso=" + uso + "&codigo=" + codigo + "&barra=" + barra;

                                                                                $.ajax({

                                                                                    type: "GET",
                                                                                    url: url1,
                                                                                    async: false,
                                                                                    success: function (respuesta) {

                                                                                        estate = respuesta;
                                                                                    }
                                                                                });

    //                                                                                console.log(estate);
                                                                                if (estate == "ok") {

                                                                                    $stockg = $('#' + $codigos).text();
                                                                                    $stockN = ($stockg * 1.0) - (cantidad * medida * 1.0);
    //                                                                                console.log($stockN);
                                                                                    $('#' + $codigos).html($stockN);

                                                                                    contador++;
                                                                                    mostrar();
    //                                                                                    console.log(codigo + " " + stock + " " + cantidad + " " + medida + " " + uso);
                                                                                    var cont = "<tr><td data-codigo=\"" + codigo + "\" data-uso=\"" + uso + "\" id=ped" + contador + ">" + $('#licor').val() + "</td><td id=cant" + contador + ">" + cantidad * medida + "</td><td>" + usotxt + "</td><td><a href=\"!#\" class=\"borrar\"><span class=\"task-cat red\">Eliminar</span></a></td></tr>";
                                                                                    $('#tablaReg').append(cont);
                                                                                    limpiar();
                                                                                    $('#codigo').focus();
                                                                                } else {
                                                                                    $('#modal3').openModal();
                                                                                }

                                                                            } else {
                                                                                $('#modal1').openModal();
                                                                                $('#cantidad').val("");
                                                                                $('#cantidad').focus();
                                                                            }

                                                                        }

                                                                        function vermateriales() {

                                                                            $('#modalM').openModal();
                                                                        }

                                                                        function anadirMat(e) {
    //                                                                            console.log(e);
    //                                                                            console.log(e.cells[0].innerHTML);
    //                                                                            console.log(e.cells[1].innerHTML);
    //                                                                            console.log(e.cells[2].innerHTML);
                                                                            $("#codigo").val(e.cells[0].innerHTML);
                                                                            $('#codigotag').attr('class', 'active');
                                                                            $("#licor").val(e.cells[1].innerHTML);
                                                                            $('#licortag').attr('class', 'active');
                                                                            $("#licorstock").val(e.cells[2].innerHTML);
                                                                            $('#licorstocktag').attr('class', 'active');
                                                                            $('#modalM').closeModal();
                                                                            $('#cantidad').focus();

                                                                        }

                                                                        function ocultar() {
                                                                            $('#tabla').hide();
                                                                            $('#codigo').focus();
                                                                        }
                                                                        function mostrar() {
                                                                            $('#tabla').show("fast");
                                                                        }
                                                                        var frm = $('#create');

                                                                        frm.submit(function (ev) {
                                                                            ev.preventDefault();
                                                                        });

                                                                        function cambiar() {
                                                                            $lic = $('#codigo').val();
                                                                            $('#codigo').attr('readonly', 'true');
                                                                            $('#licortag').attr('class', 'active');
                                                                            $('#licorstocktag').attr('class', 'active');
                                                                            $url = "control/buscarEnInventario.php?codigo=".concat($lic);
                                                                            $.ajax({
                                                                                dataType: "json",
                                                                                type: "GET",
                                                                                url: $url,
                                                                                success: function (respuesta) {

                                                                                    $('#licor').val(respuesta["licor"]);
                                                                                    $('#licorstock').val(respuesta["stock"]);
                                                                                }
                                                                            });
                                                                            $('#cantidad').focus();
                                                                        }


                                                                        function limpiar() {
                                                                            $('#codigo').val("");
                                                                            $('#licor').val("");
                                                                            $('#codigo').removeAttr('readonly', 'true');
                                                                            $('#licortag').removeAttr('class', 'active');
                                                                            $('#codigotag').removeAttr('class', 'active');
                                                                            $('#cantidad').val("");
                                                                            $('#cantidadtag').removeAttr('class', 'active');
                                                                            $('#licorstock').val("");
                                                                            $('#licorstocktag').removeAttr('class', 'active');
                                                                            $('#codigo').focus();
                                                                        }
                                                                        function verModal() {
                                                                            $('#modal2').openModal();
                                                                        }
                                                                        var href;


                                                                        $(document).on('click', '.borrar', function (event) {
                                                                            event.preventDefault();

                                                                            $id = $(this).parents("tr").find("td").eq(0).data("codigo");
                                                                            $menos = $(this).parents("tr").find("td").eq(1).html();
    //                                                                                alert($id+""+$menos);

                                                                            $(this).closest('tr').remove();
                                                                            limpiar();
                                                                            $('#codigo').focus();
                                                                            contador--;

                                                                            $stockg = $('#' + $id).text();
                                                                            $stockN = ($stockg * 1.0) + ($menos * 1.0);
    //                                                                            console.log($stockN);
                                                                            $('#' + $id).html($stockN);

                                                                            var nFilas = $("#peds tr").length;
                                                                            if (nFilas == 1) {
                                                                                ocultar();
                                                                            }
    //                                                                            alert(nFilas);

                                                                        });

                                                                        function cancelar() {
                                                                            $('#modal4').openModal();
                                                                        }
                                                                        function registrar() {
                                                                            $res="ok";
                                                                            var usuario = "<?php echo $usuario; ?>"
                                                                            var fecha = "<?php echo $fecha2; ?>";
                                                                            var productos = contador;
                                                                            for (var i = 1; i <= productos; i++) {
                                                                                $templicor = "ped".concat(i);
                                                                                $tempcant = "cant".concat(i);
                                                                                $licor = $('#' + $templicor);
                                                                                $cantidad = $('#' + $tempcant);
                                                                                $url = "control/crearSalidaMercaderia.php?usuario=" + usuario + "&fecha=" + fecha + "&medida=1&codigo=" + $licor.data("codigo") + "&cantidad=" + $cantidad.text() + "&discotecas=" + discoteca + "&barra=" + barra + "&uso=" + $licor.data("uso");
                                                                                console.log($url);
                                                                                $.ajax({
                                                                                    type: 'GET',
                                                                                    url: $url,
                                                                                    async: false,

                                                                                    success: function (respuesta) {
                                                                                        if(respuesta=="1"){
                                                                                            console.log("oli");
                                                                                        }else{
                                                                                            console.log("no");
                                                                                            $res="no";
                                                                                        }
                                                                                    }
                                                                                });
                                                                            }
                                                                            if($res=="ok"){
                                                                                $('#modal2').openModal();
                                                                            }else{
                                                                                $('#modal5').openModal();
                                                                            }
                                                                        }



            </script>
        </body>

    </html>
    <?php
}
?>

