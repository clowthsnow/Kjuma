<?php

SESSION_START();

if (!isset($_SESSION['usuario'])) {
    //si no hay sesion activa 
    ?>

    <?php header("location:page-login.php") ?>

    <?php

} else {
    //si hay sesion activa

    header("location:panel.php");
    //header("location:index.php");
}
?>
