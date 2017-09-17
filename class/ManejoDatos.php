<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ManejolDatos
 *
 * @author jdpra
 */

require('ConectorBD.php');

class ManejoDatos {
    //put your code here
    private $adminDB;
    private $DB;


    public function ManejoDatos(){
        $this->DB = "matriculas_ai";
        $this->adminDB = new ConectorBD();
    }
    
    public function insertarDatosMatricula($nuevo, $per_id_, $per_nombres_, $per_ape1_, $per_ape2_, $per_estrato_, $mat_programa_, $nov_detalle_, $nov_cod_, $loc_mun_){
        $query = "CALL insertar_persona(".$nuevo.", ".$per_id_.", '".$per_nombres_."', '".$per_ape1_."', '".$per_ape2_.
               "', ".$per_estrato_.", ".$mat_programa_.",  '"."$nov_detalle_"."', ".$nov_cod_.", ".$loc_mun_.");";
        
        $this->adminDB->realizar_consulta($query, $this->DB);
        $this->adminDB->cerrar_conexion();
        
        
    }
    
    public function ejecutarConsultaX($query){
        //$this->abrirConexion();
        $resultset = $this->adminDB->realizar_consulta($query, $this->DB);
        
        $this->cerrarConexion();
        
        return $resultset;
    }

        public function extraerListas($lista){        
        $query = "";
        switch ($lista){
            case 1:
                $query = "SELECT * FROM programas;";
                break;
            case 2:
                $query = "SELECT * FROM novedades_tipo;";
                break;
            case 3:
                $query = "SELECT * FROM municipios;";
                break;
            default:
                $query = "SELECT * FROM abrir_o_cerrar;";
        }        
        $resulSet = $this->adminDB->realizar_consulta($query, $this->DB);
        $arreglo = null;
        $i = 0;
        while ($row = $this->comprobarContenido($resulSet)){
            switch ($lista){
                case 1:
                    //echo $i;
                    $arreglo[$i]["id"] = $row["prog_codigo"];
                    $arreglo[$i]["nombre"] = $row["prog_nombre"];
                    break;
                case 2:
                    $arreglo[$i]["id"] = $row["nov_codigo"];
                    $arreglo[$i]["nombre"] = $row["nov_tipo"];                    
                    break;
                case 3:
                    $arreglo[$i]["id"] = $row["mun_codigo"];
                    $arreglo[$i]["nombre"] = $row["mun_nombre"];
                    break;
                default:
                    $arreglo[$i]["id"] = $row["llave"];
                    break;
            }
            $i++;
        }
        $this->adminDB->cerrar_conexion();
        return $arreglo;
    }
    
    public function comprobarContenido($resulset){
        $this->adminDB->conectar_servidor($this->DB);
        return $this->adminDB->revisar_contenido($resulset);
        
    }
    
    public function contarRegistros($resulset){
        return $this->adminDB->contar_registros($resulset);
    }
    
    public function abrirConexion(){
        $this->adminDB->conectar_servidor($this->DB);
    }
    
    public function cerrarConexion(){
        $this->adminDB->cerrar_conexion();
    }
}
