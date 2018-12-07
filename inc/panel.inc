<?php
if (in_array('5', $_SESSION['permisos'])) {
    ?>
    <p class="caption">Accesos Directos</p>

    <div class="divider"></div>
    <div id="basic-card" class="section">
        <div class="row">
            <div class="col s6 m4 l4">
                <div class="card  light-blue">
                    <div class="card-content white-text">
                        <span class="card-title">Usuarios</span>
                        <p>Crea u observa los usuarios que van a usar el sistema</p>
                    </div>
                    <div class="card-action">
                        <a href="page-crear-usuario.php" class="lime-text text-accent-1">Crear Usuario</a>
                        <a href="page-ver-usuarios.php" class="lime-text text-accent-1">Ver Usuarios</a>
                    </div>
                </div>
            </div>
            <div class="col s6 m4 l4">
                <div class="card  light-green">
                    <div class="card-content white-text">
                        <span class="card-title">Licores</span>
                        <p>Registra un Ingreso o Salida de Licores del Deposito</p>
                        </divs>
                        <div class="card-action">
                            <a href="page-ingreso-mercaderia.php" class="lime-text text-accent-1">Ingreso</a>
                            <a href="page-salida-mercaderia.php" class="lime-text text-accent-1">Salida</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s6 m4 l4">
                <div class="card  light-green">
                    <div class="card-content white-text">
                        <span class="card-title">Inventario</span>
                        <p>Observa la cantidad total de Licores en el deposito</p>
                    </div>
                    <div class="card-action">
                        <a href="page-inventario.php" class="lime-text text-accent-1">Ver Inventario</a>
                    </div>
                </div>
            </div>
            <div class="col s6 m4 l4">
                <div class="card  light-green">
                    <div class="card-content white-text">
                        <span class="card-title">Pedido Mensual de Productos</span>
                        <p>El sistema te dira cuanto se vendio de cada producto en el mes para que pueda hacer su pedido respectivo</p>
                    </div>
                    <div class="card-action">
                        <a href="pedido-mes.php" class="lime-text text-accent-1">Consultar Pedido</a>

                    </div>

                </div>
            </div>
            <div class="col s6 m4 l4">
                <div class="card  red ">
                    <div class="card-content white-text">
                        <span class="card-title">Registros Economicos</span>
                        <p>Registra un ingreso o gasto de dinero </p>
                    </div>
                    <div class="card-action">
                        <a href="page-crear-ingresoEconomico.php" class="lime-text text-accent-1">Ingreso </a>
                        <a href="page-crear-gasto.php" class="lime-text text-accent-1">Gasto </a>
                    </div>
                </div>
            </div>

            <div class="col s6 m4 l4">
                <div class="card  red">
                    <div class="card-content white-text">
                        <span class="card-title">Gastos vs Ingresos</span>
                        <p>Vea la grafica de Gastos contra Ingresos hasta el momento</p>
                    </div>
                    <div class="card-action">
                        <a href="page-gastos-vs-ingresos.php class="lime-text text-accent-1">Ver Grafica</a>

                    </div>
                </div>
            </div>

            <div class="col s6 m4 l4">
                <div class="card  red">
                    <div class="card-content white-text">
                        <span class="card-title">Ver Movimientos de Dinero</span>
                        <p>Observa la cantidad de dinero que ingresa y se gasta</p>
                    </div>
                    <div class="card-action">
                        <a href="page-ver-ingresosEconomicos.php" class="lime-text text-accent-1">Ver Ingresos</a>
                        <a href="page-ver-gastos.php" class="lime-text text-accent-1">Ver Gastos</a>
                    </div>
                </div>

            </div>
            <div class="col s6 m4 l4">
                <div class="card  red">
                    <div class="card-content white-text">
                        <span class="card-title">Ver Gastos de Dinero</span>
                        <p>Observa la cantidad de dinero que se gasta diaramente y por mes, escogiendo en que se gasta y el monto total</p>
                    </div>
                    <div class="card-action">
                        <a href="page-filtrar-gastosDia.php" class="lime-text text-accent-1">Gasto Diario</a>
                        <a href="page-filtrar-gastosMes.php" class="lime-text text-accent-1">Gasto Mensual</a>
                    </div>
                </div>
            </div>
            <div class="col s6 m4 l4">
                <div class="card  blue-grey">
                    <div class="card-content white-text">
                        <span class="card-title">Kardex Diarios</span>
                        <p>Crea y gestiona los kardex con los que se trabaja en las noches.</p>
                    </div>
                    <div class="card-action">
                        <a href="page-ver-kardexDiario.php" class="lime-text text-accent-1">Gestionar Kardex Diarios</a>
                    </div>
                </div>
            </div>
            <div class="col s6 m4 l4">
                <div class="card  blue-grey">
                    <div class="card-content white-text">
                        <span class="card-title">Ver Kardex</span>
                        <p>Busca y ve los Kardex por una fecha especifica u observa los kardex de todo el mes</p>
                    </div>
                    <div class="card-action">
                        <a href="page-verfecha-kardexDiario.php" class="lime-text text-accent-1">Ver por Fecha</a>
                        <a href="page-verMes-kardexDiario.php" class="lime-text text-accent-1">Ver por Mes</a>

                    </div>

                </div>
            </div>

            <div class="col s6 m4 l4">
                <div class="card  blue-grey">
                    <div class="card-content white-text">
                        <span class="card-title">Carta</span>
                        <p>Ve y configura los precios respectivos de cada carta por Discoteca</p>
                    </div>
                    <div class="card-action">
                        <a href="page-ver-cartas.php" class="lime-text text-accent-1">Ver Cartas</a>

                    </div>

                </div>
            </div>
        </div>
        <?php
    } else {
        ?>
        <p class="caption">Accesos Directos</p>

        <div class="divider"></div>
        <div id="basic-card" class="section">
            <div class="row">

                <?php if (in_array('1', $_SESSION['permisos'])) { ?>


                    <div class="col s6 m4 l4">
                        <div class="card  light-green">
                            <div class="card-content white-text">
                                <span class="card-title">Licores</span>
                                <p>Registra un Ingreso o Salida de Licores del Deposito</p>
                                </divs>
                                <div class="card-action">
                                    <a href="page-ingreso-mercaderia.php" class="lime-text text-accent-1">Ingreso</a>
                                    <a href="page-salida-mercaderia.php" class="lime-text text-accent-1">Salida</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col s6 m4 l4">
                        <div class="card  light-green">
                            <div class="card-content white-text">
                                <span class="card-title">Inventario</span>
                                <p>Observa la cantidad total de Licores en el deposito</p>
                            </div>
                            <div class="card-action">
                                <a href="page-inventario.php" class="lime-text text-accent-1">Ver Inventario</a>
                            </div>
                        </div>
                    </div>
                    <div class="col s6 m4 l4">
                        <div class="card  light-green">
                            <div class="card-content white-text">
                                <span class="card-title">Pedido Mensual de Productos</span>
                                <p>El sistema te dira cuanto se vendio de cada producto en el mes para que pueda hacer su pedido respectivo</p>
                            </div>
                            <div class="card-action">
                                <a href="pedido-mes.php" class="lime-text text-accent-1">Consultar Pedido</a>

                            </div>

                        </div>
                    </div>

                <?php } ?>
                <?php if (in_array('3', $_SESSION['permisos'])) { ?>


                    <div class="col s6 m4 l4">
                        <div class="card  red ">
                            <div class="card-content white-text">
                                <span class="card-title">Registros Economicos</span>
                                <p>Registra un ingreso o gasto de dinero </p>
                            </div>
                            <div class="card-action">
                                <a href="page-crear-ingresoEconomico.php" class="lime-text text-accent-1">Ingreso </a>
                                <a href="page-crear-gasto.php" class="lime-text text-accent-1">Gasto </a>
                            </div>
                        </div>
                    </div>

                    <div class="col s6 m4 l4">
                        <div class="card  red">
                            <div class="card-content white-text">
                                <span class="card-title">Gastos vs Ingresos</span>
                                <p>Vea la grafica de Gastos contra Ingresos hasta el momento</p>
                            </div>
                            <div class="card-action">
                                <a href="page-gastos-vs-ingresos.php class="lime-text text-accent-1">Ver Grafica</a>

                            </div>
                        </div>
                    </div>

                    <div class="col s6 m4 l4">
                        <div class="card  red">
                            <div class="card-content white-text">
                                <span class="card-title">Ver Movimientos de Dinero</span>
                                <p>Observa la cantidad de dinero que ingresa y se gasta</p>
                            </div>
                            <div class="card-action">
                                <a href="page-ver-ingresosEconomicos.php" class="lime-text text-accent-1">Ver Ingresos</a>
                                <a href="page-ver-gastos.php" class="lime-text text-accent-1">Ver Gastos</a>
                            </div>
                        </div>

                    </div>
                    <div class="col s6 m4 l4">
                        <div class="card  red">
                            <div class="card-content white-text">
                                <span class="card-title">Ver Gastos de Dinero</span>
                                <p>Observa la cantidad de dinero que se gasta diaramente y por mes, escogiendo en que se gasta y el monto total</p>
                            </div>
                            <div class="card-action">
                                <a href="page-filtrar-gastosDia.php" class="lime-text text-accent-1">Gasto Diario</a>
                                <a href="page-filtrar-gastosMes.php" class="lime-text text-accent-1">Gasto Mensual</a>
                            </div>
                        </div>
                    </div>

                <?php } ?>
                <?php if (in_array('4', $_SESSION['permisos'])) { ?>



                    <div class="col s6 m4 l4">
                        <div class="card  blue-grey">
                            <div class="card-content white-text">
                                <span class="card-title">Kardex Diarios</span>
                                <p>Crea y gestiona los kardex con los que se trabaja en las noches.</p>
                            </div>
                            <div class="card-action">
                                <a href="page-ver-kardexDiario.php" class="lime-text text-accent-1">Gestionar Kardex Diarios</a>
                            </div>
                        </div>
                    </div>
                    <div class="col s6 m4 l4">
                        <div class="card  blue-grey">
                            <div class="card-content white-text">
                                <span class="card-title">Ver Kardex</span>
                                <p>Busca y ve los Kardex por una fecha especifica u observa los kardex de todo el mes</p>
                            </div>
                            <div class="card-action">
                                <a href="page-verfecha-kardexDiario.php" class="lime-text text-accent-1">Ver por Fecha</a>
                                <a href="page-verMes-kardexDiario.php" class="lime-text text-accent-1">Ver por Mes</a>

                            </div>

                        </div>
                    </div>

                    <div class="col s6 m4 l4">
                        <div class="card  blue-grey">
                            <div class="card-content white-text">
                                <span class="card-title">Carta</span>
                                <p>Ve y configura los precios respectivos de cada carta por Discoteca</p>
                            </div>
                            <div class="card-action">
                                <a href="page-ver-cartas.php" class="lime-text text-accent-1">Ver Cartas</a>

                            </div>

                        </div>
                    </div>

                <?php } ?>
                <?php if (in_array('2', $_SESSION['permisos'])) { ?>


                <?php } ?>

            </div>
            <?php
        }
        ?>
