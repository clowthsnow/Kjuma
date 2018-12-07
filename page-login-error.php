<?php
SESSION_START();

if (isset($_SESSION['usuario'])) {
    //si hay sesion activa 
    header("location:index.php");
} else {
    ?>
    <!DOCTYPE html>
    <html lang="es">

        <head>
            <title>Inicio de Sesion</title>
            <!--Let browser know website is optimized for mobile-->
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            <!-- Favicons-->
            <link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">

            <!-- CORE CSS-->

            <link href="css/materialize.css" type="text/css" rel="stylesheet" >
            <link href="css/style.css" type="text/css" rel="stylesheet" >
            <link href="css/page-center.css" type="text/css" rel="stylesheet">

            <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->

            <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet">

        </head>

        <body class="cyan">
            <!-- Start Page Loading -->
            <div id="loader-wrapper">
                <div id="loader"></div>        
                <div class="loader-section section-left"></div>
                <div class="loader-section section-right"></div>
            </div>
            <!-- End Page Loading -->



            <div id="login-page" class="row">
                <div class="col s12 z-depth-4 card-panel">
                    <form class="login-form" action="control/validacionLogin.php" method="POST">
                        <div class="row">
                            <div id="site-layout-example-top" class="col s12">
                                <p class="flat-text-logo center white-text caption-uppercase">Error, intente de nuevo</p>
                            </div>
                            <div class="input-field col s12 center">
                                <p class="center login-form-text">Inicio de Sesión</p>
                            </div>
                        </div>
                        <div class="row margin">
                            <div class="input-field col s12">
                                <i class="mdi-social-person-outline prefix"></i>
                                <input id="username" type="text" name="usuario">
                                <label for="username" class="center-align">Usuario</label>
                            </div>
                        </div>
                        <div class="row margin">
                            <div class="input-field col s12">
                                <i class="mdi-action-lock-outline prefix"></i>
                                <input id="password" type="password" name="contra">
                                <label for="password">Contraseña</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <button class="btn waves-effect waves-light col s12" type="submit" name="action">Ingresar</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>



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

        </body>

    </html>
    <?php
}
?>
