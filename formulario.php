<?php 
include 'class/ManejoDatos.php';
 $command = new ManejoDatos();
 
try{
   
    if(isset($_POST["per_id"])){
        $per_id = $_POST["per_id"];
    }

    $opcion = $_POST['opcion'];

    if($opcion == "registrar"){
        $per_nombre = $_POST["per_nombre"];
        $per_apellido1 = $_POST["per_apellido1"];
        $per_apellido2 = $_POST["per_apellido2"];
        $per_estrato = $_POST["per_estrato"];
        $mat_programa = $_POST["mat_programa"];
        $nov_codigo = $_POST["nov_codigo"];
        $nov_detalle = $_POST["nov_detalle"];
        $country = trim($_POST["country"]);
       
        try{
            $query = "SELECT * FROM personas WHERE personas.per_id = '".$per_id."';";
            $enlace = $command->ejecutarConsultaX($query);
            if(mysqli_num_rows($enlace) == 0){
                

                $query = "CALL insertar_persona(1, '".$per_id."', '".strtoupper($per_nombre)."', '".strtoupper($per_apellido1)."', '".strtoupper($per_apellido2).
                    "', ".$per_estrato.", ".$mat_programa.",  '".strtoupper($nov_detalle)."', ".$nov_codigo.", '".strtoupper($country)."');";

                $enlace = $command->ejecutarConsultaX($query) or die;
                //echo "Registro exitoso";

            }
            else{
                echo "Ya existe un registro con este número de identificación";
            }

        }  catch (mysqli_sql_exception $ex){
            echo "No se pudo completar la operación. ".$ex->getMessage();
        }
    }
    else if($opcion == "buscar"){
        $per_nombre = $_POST["per_nombre"];
        $per_apellido1 = $_POST["per_apellido1"];
        $per_apellido2 = $_POST["per_apellido2"];
        $per_estrato = $_POST["per_estrato"];
        $mat_programa = $_POST["mat_programa"];
        $nov_codigo = $_POST["nov_codigo"];
        $nov_detalle = $_POST["nov_detalle"];
        $country = trim($_POST["country"]);
        
        try{
        

            $query = "CALL insertar_persona(2, '".$per_id."', '".strtoupper($per_nombre)."', '".strtoupper($per_apellido1)."', '".strtoupper($per_apellido2).
                "', ".$per_estrato.", ".$mat_programa.",  '".strtoupper($nov_detalle)."', ".$nov_codigo.", '".strtoupper($country)."');";

            $enlace = $command->ejecutarConsultaX($query);
            //echo $per_nombre." ".$per_apellido1." ".$per_apellido2."</br>".$per_estrato." ".$mat_programa." ".$nov_codigo." ".$nov_detalle."</br>".$country;
            echo "Actualización exitosa";

        }  catch (mysqli_sql_exception $ex){
            echo "No se pudo completar la operación. ".$ex->getMessage();
        }
    }
    else if($opcion == "reiniciar"){
        try{
        

            $query = "UPDATE estados_reg SET estados_reg.estr_tipo = 2;";

            $enlace = $command->ejecutarConsultaX($query);
            //echo $per_nombre." ".$per_apellido1." ".$per_apellido2."</br>".$per_estrato." ".$mat_programa." ".$nov_codigo." ".$nov_detalle."</br>".$country;
            echo "Ahora todos los estudiantes deben matricularse";

        }  catch (mysqli_sql_exception $ex){
            echo "No se pudo completar la operación. ".$ex->getMessage();
        }
    }

}  catch (Exception $ex){
        echo "No se pudo completar la operación. ".$ex->getMessage();
}
?>