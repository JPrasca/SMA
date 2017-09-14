<?php

include 'class/ManejoDatos.php';

$command = new ManejoDatos();
$llave = $_GET['llave'];
$registro["ID"] = $_POST["per_id"];
$registro["Nombres"] = $_POST["per_nombre"];
$registro["Ape1"] = $_POST["per_apellido1"];
$registro["Ape2"] = $_POST["per_apellido2"];
$registro["Estrato"] = "";
$registro["Programa"] = $_POST["mat_programa"];
$registro["DetalleNov"] = $_POST["nov_detalle"];
$registro["CodNov"] = $_POST["novr_codigo"];
$registro["Muni"] = "";

$query = "CALL insertar_persona(".$llave.", ".$registro["ID"].", '".$registro["Nombres"]."', '".$registro["Ape1"]."', '".$registro["Ape2"].
               "', ".$registro["Estrato"].", ".$registro["Programa"].",  '".$registro["DetalleNov"]."', ".$registro["CodNov"].", ".
                $registro["Muni"].");";
                    
try{
    $command->ejecutarConsultaX($query);

}  catch (Exception $ex){
    echo '<script> aler('.$ex->getMessage().');</script>';
}

?>

