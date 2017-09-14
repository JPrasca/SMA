<?php
include 'class/ManejoDatos.php';

$command = new ManejoDatos();


$query = "SELECT * "
        . "FROM personas AS p1, matriculas AS m1, novedades_reg AS n1 "
        . "WHERE p1.per_id = " . $_GET['ID']." "
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
    </head>
    <body>
        <div class="main">
            <div class="row" style="align-content: center;">
                <div class="container">
                    <header>
                        <h2>Actualizar condiciones y promover matrícula</h2>
                    </header>
                    <form action="update_registro.php?llave=2" method="post" name="formSearch" enctype="multipart/form-data">
                        <div class="11u">
                            <label for="per_id" class="label">Identificación: </label>
                            <input id="per_id" type="text" class="text" name="per_id" value="<?php echo $_GET['ID']?>" disabled="disable" placeholder="Identificación" />
                        </div>
                        <div class="11u">
                             <label for="per_nombre" class="label">Nombres: </label>
                            <input id="per_nombre" type="text" class="text" name="per_nombre"  value="<?php echo $nombre; ?>" disabled="disable" placeholder="Nombre" />
                        </div>
                        <div class="11u">
                            <label for="per_apellido1" class="label">Primer apellido: </label>
                            <input id="per_apellido1" type="text" class="text" name="per_apellido1" value="<?php echo $apellido1; ?>" disabled="disable" placeholder="Primer apellido" />
                        </div>
                        <div class="11u">
                             <label for="per_apellido2" class="label">Segundo apellido: </label>
                            <input id="per_apellido2" type="text" class="text" name="per_apellido2" value="<?php echo $apellido2; ?>" disabled="disable" placeholder="Segundo apellido" />
                        </div>
                        <div class="11u">
                            <label for="per_estrato" class="label">Estrato: </label>
                            <input id="per_estrato" type="text" class="text" name="per_estrato" value="<?php echo $estrato; ?>" disabled="disable"/></div>
                        <div class="11u">
                         <label for="mat_programa" class="label">Programa: </label>
                        <select id="mat_programa" class="text" name="mat_programa" disabled="disable">
                            <?php 
                                                         
                            $list = $command->extraerListas(1);
                            $i = 0;
                            while ($i < count($list)){
                                $selected = ($list[$i]["id"] == $programa)? " selected":" ";
                                echo "<option value='".$list[$i]["id"]."' ".$selected.">".$list[$i]["nombre"]."</option>";
                                $i++;
                            }
                            ?>
                            
                        </select>
                        </div>
                        <div class="11u">
                         <label for="novr_codigo" class="label">Tipo Novedad </label>
                        <select id="novr_codigo" class="text" name="novr_codigo">
                            <?php 
                                                         
                            $list = $command->extraerListas(2);
                            $i = 0;
                            while ($i < count($list)){
                                $selected = ($list[$i]["id"] == $codigo_novedad)? " selected":" ";
                                echo "<option value='".$list[$i]["id"]."' ".$selected.">".$list[$i]["nombre"]."</option>";
                                $i++;
                            }
                            ?>
                            
                        </select>
                        </div>
                        <div class="11u">
                            <label for="nov_detalle" class="label">Detalle novedad: </label>
                            <textarea id="nov_detalle" name="nov_detalle" placeholder=""><?php echo $detalle_novedad; ?></textarea>
                        </div>
                        <div class="u10">
                            <input type="submit" class="submit" value="Actualizar datos"/>
                        </div>
                    </form>
                </div>
             </div>
        
            
    </body>
</html>


