<?php
include 'class/ManejoDatos.php';

$command = new ManejoDatos();


$lugar = $_GET['country'];


$query = "SELECT * "
        . "FROM personas AS p1, matriculas AS m1, novedades_reg AS n1 "
        . "WHERE p1.per_id = " . $_GET['ID'] . " "
        . "AND p1.per_codigo = m1.mat_estudiante "
        . "AND m1.mat_estudiante = n1.novr_est ";
$registro = $command->ejecutarConsultaX($query);

while ($row = $command->comprobarContenido($registro)) {
    $nombre = $row['per_nombres'];
    $apellido1 = $row['per_apellido1'];
    $apellido2 = $row['per_apellido2'];
    $estrato = $row['per_estrato'];
    $programa = $row['mat_programa'];
    $detalle_novedad = $row['novr_detalle'];
    $codigo_novedad = $row['novr_codigo'];
    //$municipio = $row['loc_mun'];
}
?>

<!DOCTYPE HTML>
<html>

    <head>
        <title></title>


        <script src="js/skel.min.js"></script>
        <script src="js/skel-panels.min.js"></script>
        <script src="js/init.js"></script>

        <noscript>
        <link rel="stylesheet" href="css/skel-noscript.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/style-wide.css" />
        </noscript>

        <script src="js/jquery.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACJapLIVhm-uVWitwICh24232jYdkP1SQ">
        </script>

        <script type="text/javascript">


            function popup()
            {
                window.location.href = "http://localhost/SMA/update_registro.php?llave=2&per_id=" + document.getElementById('per_id').value +
                        "&per_nombre=" + document.getElementById('per_nombre').value +
                        "&per_apellido1=" + document.getElementById('per_apellido1').value +
                        "&per_apellido2=" + document.getElementById('per_apellido2').value +
                        "&per_estrato= " + document.getElementById('per_estrato').value +
                        "&mat_programa=" + document.getElementById('mat_programa').value +
                        "&nov_detalle=" + document.getElementById('nov_detalle').value +
                        "&novr_codigo=" + document.getElementById('novr_codigo').value +
                        "&country='" + <?php echo $lugar ?> + "'";

                console.log(<?php echo $lugar ?>);
            }

        </script>
    </head>
    <body onload="popup();">
        <input type="text" id="latitude" style="display: none;" />
        <input type ="text" id="longitude" style="display: none;"/>
        <label class="byline" type="text" id="country" name="country" style="display: none;" value=""></label>
        <div id="map" style="display: none;"></div>

        <div id="status" style="display: none;"> </div><br />
        <div class="main">
            <div class="row" style="align-content: center;">
                <div class="container">
                    <header>
                        <h2>Actualizar condiciones y promover matrícula</h2>
                    </header>
                    <form action="update_registro.php" method="post" name="formSearch">
                        <div class="11u">
                            <label for="per_id" id="lala" class="label">Identificación: </label>
                            <input  type="text" class="text" id="per_id" value="<?php echo $_GET['ID']; ?>" disabled="disable" placeholder="Identificación" />
                        </div>
                        <div class="11u">
                            <label for="per_nombre" class="label">Nombres: </label>
                            <input  type="text" class="text" id="per_nombre"  value="<?php echo $nombre; ?>" disabled="disable" placeholder="Nombre" />
                        </div>
                        <div class="11u">
                            <label for="per_apellido1" class="label">Primer apellido: </label>
                            <input type="text" class="text" id="per_apellido1" value="<?php echo $apellido1; ?>" disabled="disable" placeholder="Primer apellido" />
                        </div>
                        <div class="11u">
                            <label for="per_apellido2" class="label">Segundo apellido: </label>
                            <input  type="text" class="text" id="per_apellido2" value="<?php echo $apellido2; ?>" disabled="disable" placeholder="Segundo apellido" />
                        </div>
                        <div class="11u">
                            <label for="per_estrato" class="label">Estrato: </label>
                            <input  type="text" class="text" id="per_estrato" value="<?php echo $estrato; ?>" disabled="disable"/></div>
                        <div class="11u">
                            <label for="mat_programa" class="label">Programa: </label>
                            <select class="text" id="mat_programa" disabled="disable">
                                <?php
                                $list = $command->extraerListas(1);
                                $i = 0;
                                while ($i < count($list)) {
                                    $selected = ($list[$i]["id"] == $programa) ? " selected" : " ";
                                    echo "<option value='" . $list[$i]["id"] . "' " . $selected . ">" . $list[$i]["nombre"] . "</option>";
                                    $i++;
                                }
                                ?>

                            </select>
                        </div>
                        <div class="11u">
                            <label for="novr_codigo" class="label">Tipo Novedad </label>
                            <select class="text" id="novr_codigo">
                                <?php
                                $list = $command->extraerListas(2);
                                $i = 0;
                                while ($i < count($list)) {
                                    $selected = ($list[$i]["id"] == $codigo_novedad) ? " selected" : " ";
                                    echo "<option value='" . $list[$i]["id"] . "' " . $selected . ">" . $list[$i]["nombre"] . "</option>";
                                    $i++;
                                }
                                ?>

                            </select>
                        </div>
                        <div class="11u">
                            <label for="nov_detalle" class="label">Detalle novedad: </label>
                            <textarea  id="nov_detalle" placeholder=""><?php echo $detalle_novedad; ?></textarea>
                        </div>
                        <div class="u10">
                            <a href='#' class="submit" id="bt_submit" onclick="popup();" >Enviar</a>
                            <input type="submit" onclick="popup();" value="enviar" name="Enviar" />

                            <script type="text/javascript">


            function popup()
            {
                window.location.href = "http://localhost/SMA/update_registro.php?llave=2&per_id=" + document.getElementById('per_id').value +
                        "&per_nombre=" + document.getElementById('per_nombre').value +
                        "&per_apellido1=" + document.getElementById('per_apellido1').value +
                        "&per_apellido2=" + document.getElementById('per_apellido2').value +
                        "&per_estrato= " + document.getElementById('per_estrato').value +
                        "&mat_programa=" + document.getElementById('mat_programa').value +
                        "&nov_detalle=" + document.getElementById('nov_detalle').value +
                        "&novr_codigo=" + document.getElementById('novr_codigo').value +
                        "&country='" + <?php echo $lugar ?> + "'";

                console.log(<?php echo $lugar ?>);
            }

        </script>
                        </div>
                    </form>
                    <div class="u10">
                        <a href='#' class="submit" id="bt_submit" onclick="popup();" >Enviar</a>

                    </div>
                </div>
            </div>


    </body>
</html>


