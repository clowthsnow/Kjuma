<?php
if (in_array('5', $_SESSION['permisos'])) {
    ?>
    <aside id="left-sidebar-nav">
        <ul id="slide-out" class="side-nav fixed leftside-navigation">
            <li class="user-details cyan darken-2">
                <div class="row">
                    <div class="col col s4 m4 l4">
                        <img src="images/user.png" alt="" class="circle responsive-img valign profile-image">
                    </div>
                    <div class="col col s8 m8 l8">

                        <a class="btn-flat waves-effect waves-light white-text profile-btn" href="#!"><?php echo $_SESSION['usuarioNombres']; ?></a>
                        <p class="user-roal">Administrador</p>
                    </div>
                </div>
            </li>
            <li class="bold"><a href="index.php" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i>Inicio</a>
            </li>
            <li class="no-padding">
                <ul class="collapsible collapsible-accordion">
                    <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-account-box"></i>Gestion de Usuarios</a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="page-crear-usuario.php">Crear Nuevo Usuario</a>
                                </li>                                        
                                <li><a href="page-ver-usuarios.php">Ver Usuarios</a>
                                </li>
                                <li><a href="page-ver-sistemas.php">Ver Sistemas</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-shopping-cart"></i>Gestion de Deposito</a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="page-ingreso-mercaderia.php">Ingreso de Licores</a>
                                </li>
                                <li><a href="page-salida-mercaderia-notap.php">Salida de Licores</a>
                                </li>
                                <li><a href="page-inventario.php">Inventario</a>
                                </li>
                                <li><a href="page-consumo.php">Hacer Consumo</a>
                                </li>

                                <li><a href="page-ver-consumo.php">Ver Consumo</a>
                                </li>



                                <li class="divider"></li><li><a href="pedido-mes.php">Pedido Mensual</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="page-ver-ingresoMercaderia.php">Ver Ingreso Licores</a>
                                </li>
                                <li><a href="page-ver-salidaMercaderia.php">Ver Salidas Licores </a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="page-crear-licor.php">Crear Nuevo Licor</a>
                                </li>    
                                <li><a href="page-ver-licores.php">Ver Licores</a>
                                </li> 
                                <!--                                <li><a href="page-crear-producto.php">Crear Nuevo Producto</a>
                                                                </li>  
                                                                 
                                                                <li><a href="page-ver-productos.php">Ver Productos</a>
                                                                </li>-->


                            </ul>
                        </div>
                    </li>
                    <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-action-account-balance-wallet"></i> Gestion de Gastos</a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="page-crear-ingresoEconomico.php">Registrar Ingreso</a>
                                </li>
                                <li><a href="page-crear-gasto.php">Registrar Gasto</a>
                                </li>
                                <li><a href="page-gastos-vs-ingresos.php">Gastos Vs Ingresos</a>
                                </li>
                                <li class="divider"></li>
                                <!--                                <li><a href="page-filtrar-gastos.php">Ver Gastos Detallado</a>
                                                                </li>-->
                                <li><a href="page-filtrar-gastosDia.php">Ver Gastos Diarios</a>
                                </li>
                                <li><a href="page-filtrar-gastosMes.php">Ver Gastos Mensuales</a>
                                </li>
                                <li><a href="page-ver-ingresosEconomicos.php">Ver Ingresos</a>
                                </li>
                                <li><a href="page-ver-gastos.php">Ver Gastos</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="page-crear-proveedor.php">Registrar Proveedores</a>
                                </li>  
                                <li><a href="page-ver-proveedores.php">Ver Proveedores</a>
                                </li>
                                <li><a href="page-ver-factura.php">Facturas</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-action-assignment"></i> Kardex</a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="page-ver-kardexGenerales.php">Kardex Generales</a>
                                </li>
                                <li><a href="page-ver-kardexDiario.php">Kardex Diarios</a>
                                </li>
                                <li><a href="page-verfecha-kardexDiario.php">Ver Kardex por Fecha</a>
                                </li>
                                <li><a href="page-verMes-kardexDiario.php">Ver Kardex por Mes</a>
                                </li>
                                <li><a href="page-ver-cartas.php">Cartas</a>
                                </li>
                                <li class="divider"></li>

                                <li><a href="page-crear-discoteca.php">Registrar Discotecas</a>
                                </li>
                                <li><a href="page-crear-barra.php">Registrar Barras</a>
                                </li>
                                <li><a href="page-ver-discotecas.php">Ver Discotecas</a>
                                </li>

                                <li><a href="page-ver-barras.php">Ver Barras</a>
                                </li>


                            </ul>
                        </div>
                    </li>
    <!--                    <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-action-credit-card"></i> Gestion de Entradas</a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="page-404.html">Crear Cliente</a>
                                </li>
                                <li><a href="page-404.html">Ver Clientes</a>
                                </li>
                                <li><a href="page-404.html">Asistencias</a>
                                </li>
                            </ul>
                        </div>
                    </li>-->
                </ul>
            </li>
            <li class="li-hover"><div class="divider"></div></li>
            <li class="li-hover"><p class="ultra-small margin more-text">MAS</p></li>

            <li><a href="page-mi-cuenta.php"><i class="mdi-action-perm-identity"></i> Mi Cuenta</a>
            </li>

            <li><a href="logout.php"><i class="mdi-hardware-keyboard-tab"></i> Salir</a>
            </li>
        </ul>
        <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only darken-2"><i class="mdi-navigation-menu" ></i></a>
    </aside>
    <?php
} else {
    ?>

    <aside id="left-sidebar-nav">
        <ul id="slide-out" class="side-nav fixed leftside-navigation">
            <li class="user-details cyan darken-2">
                <div class="row">
                    <div class="col col s4 m4 l4">
                        <img src="images/user.png" alt="" class="circle responsive-img valign profile-image">
                    </div>
                    <div class="col col s8 m8 l8">

                        <a class="btn-flat waves-effect waves-light white-text profile-btn" href="#!"><?php echo $_SESSION['usuarioNombres']; ?></a>
                        <p class="user-roal"></p>
                    </div>
                </div>
            </li>
            <li class="bold"><a href="index.php" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i>Inicio</a>
            </li>
            <li class="no-padding">
                <ul class="collapsible collapsible-accordion">
                    <?php if (in_array('1', $_SESSION['permisos'])) { ?>
                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-shopping-cart"></i>Gestion de Deposito</a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="page-ingreso-mercaderia.php">Ingreso de Licores</a>
                                    </li>
                                    <li><a href="page-salida-mercaderia-notap.php">Salida de Licores</a>
                                    </li>
                                    <li><a href="page-inventario.php">Inventario</a>
                                    </li>
                                    <li><a href="page-consumo.php">Hacer Consumo</a>
                                    </li>

                                    <li><a href="page-ver-consumo.php">Ver Consumo</a>
                                    </li>



                                    <li class="divider"></li><li><a href="pedido-mes.php">Pedido Mensual</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li><a href="page-ver-ingresoMercaderia.php">Ver Ingreso Licores</a>
                                    </li>
                                    <li><a href="page-ver-salidaMercaderia.php">Ver Salidas Licores </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li><a href="page-crear-licor.php">Crear Nuevo Licor</a>
                                    </li>    
                                    <li><a href="page-ver-licores.php">Ver Licores</a>
                                    </li> 
                                    <!--                                <li><a href="page-crear-producto.php">Crear Nuevo Producto</a>
                                                                    </li>  
                                                                     
                                                                    <li><a href="page-ver-productos.php">Ver Productos</a>
                                                                    </li>-->


                                </ul>
                            </div>
                        </li>
                    <?php } ?>
                    <?php if (in_array('3', $_SESSION['permisos'])) { ?>
                        <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-action-account-balance-wallet"></i> Gestion de Gastos</a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="page-crear-ingresoEconomico.php">Registrar Ingreso</a>
                                    </li>
                                    <li><a href="page-crear-gasto.php">Registrar Gasto</a>
                                    </li>
                                    <li><a href="page-gastos-vs-ingresos.php">Gastos Vs Ingresos</a>
                                    </li>
                                    <li class="divider"></li>
                                    <!--                                <li><a href="page-filtrar-gastos.php">Ver Gastos Detallado</a>
                                                                    </li>-->
                                    <li><a href="page-filtrar-gastosDia.php">Ver Gastos Diarios</a>
                                    </li>
                                    <li><a href="page-filtrar-gastosMes.php">Ver Gastos Mensuales</a>
                                    </li>
                                    <li><a href="page-ver-ingresosEconomicos.php">Ver Ingresos</a>
                                    </li>
                                    <li><a href="page-ver-gastos.php">Ver Gastos</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li><a href="page-crear-proveedor.php">Registrar Proveedores</a>
                                    </li>  
                                    <li><a href="page-ver-proveedores.php">Ver Proveedores</a>
                                    </li>
                                    <li><a href="page-ver-factura.php">Facturas</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php } ?>
                    <?php if (in_array('4', $_SESSION['permisos'])) { ?>
                        <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-action-assignment"></i> Kardex</a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="page-ver-kardexGenerales.php">Kardex Generales</a>
                                    </li>
                                    <li><a href="page-ver-kardexDiario.php">Kardex Diarios</a>
                                    </li>
                                    <li><a href="page-verfecha-kardexDiario.php">Ver Kardex por Fecha</a>
                                    </li>
                                    <li><a href="page-verMes-kardexDiario.php">Ver Kardex por Mes</a>
                                    </li>
                                    <li><a href="page-ver-cartas.php">Cartas</a>
                                    </li>
                                    <li class="divider"></li>

                                    <li><a href="page-crear-discoteca.php">Registrar Discotecas</a>
                                    </li>
                                    <li><a href="page-crear-barra.php">Registrar Barras</a>
                                    </li>
                                    <li><a href="page-ver-discotecas.php">Ver Discotecas</a>
                                    </li>

                                    <li><a href="page-ver-barras.php">Ver Barras</a>
                                    </li>

                                    </li>
                                </ul>
                            </div>
                        </li>

                    <?php } ?>
                    <?php if (in_array('2', $_SESSION['permisos'])) { ?>
        <!--                        <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-action-credit-card"></i> Gestion de Entradas</a>
                                    <div class="collapsible-body">
                                        <ul>
                                            <li><a href="form-elements.html">Crear Cliente</a>
                                            </li>
                                            <li><a href="form-layouts.html">Ver Clientes</a>
                                            </li>
                                            <li><a href="form-layouts.html">Asistencias</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>-->

                    <?php } ?>

                </ul>
            </li>
            <li class="li-hover"><div class="divider"></div></li>
            <li class="li-hover"><p class="ultra-small margin more-text">MAS</p></li>

            <li><a href="page-mi-cuenta.php"><i class="mdi-action-perm-identity"></i> Mi Cuenta</a>
            </li>

            <li><a href="logout.php"><i class="mdi-hardware-keyboard-tab"></i> Salir</a>
            </li>
        </ul>
        <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only darken-2"><i class="mdi-navigation-menu" ></i></a>
    </aside>
    <?php
}
?>
<div class="fixed-action-btn l0" id="fijo-arriba">
    <a class="btn-floating btn-large waves-effect waves-light red sideMenu" href="#!" data-activates="slide-out">
        <i class="mdi-navigation-menu">menu</i>
    </a>
</div>
