<?php
include 'class/ManejoDatos.php';

$command = new ManejoDatos();


$lugar = $_GET['country'];


$query = "SELECT * "
        . "FROM personas AS p1, matriculas AS m1, novedades_reg AS n1 "
        . "WHERE p1.per_id = " . $_GET['per_id'] . " "
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
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.js" type="text/javascript"></script>
        <noscript>
        <link rel="stylesheet" href="css/skel-noscript.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/style-wide.css" />
        </noscript>

        <script src="js/jquery.min.js"></script>
 
        <script type="text/javascript">
            $(document).on('ready', function () {
                //alert("document ready");
                
                $.ajax({
                    type: "POST",
                    url: "formulario.php",
                    data: {"opcion": "buscar"},
                    success: function (data)
                    {
                        //alert(data);
                      
                    }
                });
            });
            function buscar() {
                //alert("buscar desde javascript");
                //alert("id: " + $('#id').val());
//                alert($('#per_id').val());
//                alert($('#per_nombre').val());
//                alert($('#per_apellido1').val());
//                alert($('#per_apellido2').val());
//                alert($('#per_estrato').val());
//                alert($('#mat_programa').val());
//                alert($('#nov_codigo').val());
//                alert($('#nov_detalle').val());
                
                lugar = '<?php echo trim($lugar); ?>';
                //alert(lugar);
                $.ajax({
                    type: "POST",
                    url: "formulario.php",
                    data: {
                        opcion: "buscar", per_id: $('#per_id').val(), per_nombre: $('#per_nombre').val(),
                        per_apellido1: $('#per_apellido1').val(), per_apellido2: $('#per_apellido2').val(),
                        per_estrato: $('#per_estrato').val(), mat_programa: $('#mat_programa').val(),
                        nov_codigo: $('#nov_codigo').val(), nov_detalle: $('#nov_detalle').val(),
                        country: lugar
                    },
                    success: function (data)
                    {
                        
                        alert(data);
                    }
                });
            }

        </script>
    </head>
    <body >
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
                    <form method="post" name="formSearch">
                        <div class="11u">
                            <label for="per_id" id="lala" class="label">Identificación: </label>
                            <input  type="text" class="text" id="per_id" value="<?php echo $_GET['per_id']; ?>" disabled="disable" placeholder="Identificación" />
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
                            <label for="nov_codigo" class="label">Tipo Novedad </label>
                            <select class="text" id="nov_codigo">
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
                            <input type="button" onclick="buscar();" class="button sumit" value="Actualizar" name="Actualizar" />
                        </div>
                    </form>
                   
                </div>
            </div>


    </body>
</html>


