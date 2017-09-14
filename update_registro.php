<?php

include 'class/ManejoDatos.php';


$command = new ManejoDatos();

$Muni = filter_input(INPUT_POST, 'country');


$ID = filter_input(INPUT_POST, 'per_id');

$llave =  filter_input(INPUT_POST,'llave');
$Nombres = filter_input(INPUT_POST, "per_nombre");



$Ape1 =  filter_input(INPUT_POST,"per_apellido1");


$Ape2 = filter_input(INPUT_POST,"per_apellido2");
$Estrato =  filter_input(INPUT_POST,"per_estrato");

$Programa =  filter_input(INPUT_POST,"mat_programa");
    

$DetalleNov = filter_input(INPUT_POST, "nov_detalle");
$CodNov =  filter_input(INPUT_POST,"novr_codigo");


$query = "CALL insertar_persona(".$llave.", ".$ID.", '".$Nombres."', '".$Ape1."', '".$Ape2.
               "', ".$Estrato.", ".$Programa.",  '".$DetalleNov."', ".$CodNov.", ".
                $Muni.");";
                    
try{
    $command->ejecutarConsultaX($query);
    //echo $query;
   

}  catch (Exception $ex){
    //echo '<script> aler('.$ex->getMessage().');</script>';
}

?>

