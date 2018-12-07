<?php
require_once './conexion.php';
$barraP = $_GET['barra'];
ob_start();
?>
<page>
    <?php
    //buscar Barra ok
    $consultaBarra = "SELECT barra.barraNombre, discoteca.discotecaNombre FROM barra  "
            . "RIGHT JOIN discoteca ON barra.barraDiscoteca=discoteca.discotecaId "
            . "WHERE barra.barraId='$barraP'";
    $resultadoBarra = $conexion->query($consultaBarra) or die($conexion->error);
    $barra = $resultadoBarra->fetch_assoc();
//    print_r($barra);
    //buscamos el kardex si esta activo ok
    $consultaKardex = "SELECT * FROM kardex WHERE kardexBarra='" . $barraP . "' AND kardexEstado='0'";
    $resultadoKardex = $conexion->query($consultaKardex);
    if ($resultadoKardex->num_rows === 0) {
        header("location:page-ver-kardexDiario.php");
    }
    $kardex = $resultadoKardex->fetch_array();

//    echo $kardex['kardexId'];
    //buscamos el dia de la semana de la fecha dada ok
    $fecha = $kardex['kardexDia'] . "-" . $kardex['kardexMes'] . "-" . $kardex['kardexAnio'];
    $dias = array('', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo');
    $dia = $dias[date('N', strtotime($fecha))];
    ?>
    <div class="row">
        <div class="col s12">
            <p><?php
                echo (strtoupper("kardex " . $barra['discotecaNombre'] . " barra " . $barra['barraNombre'] . " en cargo :   "));
                echo $kardex['kardexEncargado'];
                ?>
            </p>
            <p><?php echo strtoupper("Fecha: " . $dia . " $fecha caja chica: S/. 400.00"); ?></p>

        </div>

    </div>

    <?php
    //solo selladas consulta categorias
    if (!$kardex['kardexSellada'] == NULL) {
        $kardexSellada = $kardex['kardexSellada'];
        $consultaCategorias = "SELECT "
                . " categorialicor.* FROM kardexsellada "
                . "LEFT JOIN licor ON  kardexsellada.KardexSelladaLicor=licor.licorId "
                . "LEFT JOIN categorialicor ON licor.licorCategoria=categorialicor.categoriaLicorId "
                . "WHERE kardexsellada.KardexSelladaId='$kardexSellada'"
                . "GROUP BY categoriaLicorId";
        $resultadoCategorias = $conexion->query($consultaCategorias) or die($conexion->error);
        ?>

        <h5>Selladas</h5>
        <table style="width: 100%;
               display: table;" >
            <thead>
                <tr>
                    <th></th>
                    <th>Aumento</th>
                    <th>Inicio</th>
                    <th>Final</th>
                    <th>Vendido</th>
                </tr>
            </thead>   
            <tbody>
                <tr>
                    <td style="  padding: 10px 5px;
                        display: table-cell;
                        text-align: left;
                        vertical-align: middle;
                        border-radius: 2px;
                        border: 1px solid #e0e0e0 !important;">oli</td>
                </tr>

            </tbody>
        </table>



        <?php
    }
    ?>



</page>

<?php
$content = ob_get_clean();
require_once ('./html2pdf-4.03/html2pdf.class.php');
$pdf = new HTML2PDF('P', 'A4', 'fr', 'UTF-8');
$pdf->writeHTML($content);
$pdf->pdf->IncludeJS('print(TRUE)');
$pdf->Output('prueba.pdf')
?>