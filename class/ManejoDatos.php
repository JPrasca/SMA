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

    public function ManejoDatos() {
        $this->DB = "matriculas_ai";
        $this->adminDB = new ConectorBD();
    }

    public function insertarDatosMatricula($nuevo, $per_id_, $per_nombres_, $per_ape1_, $per_ape2_, $per_estrato_, $mat_programa_, $nov_detalle_, $nov_cod_, $loc_mun_) {
        $query = "CALL insertar_persona(" . $nuevo . ", " . $per_id_ . ", '" . $this->quitar_tildes($per_nombres_) . "', '" . $this->quitar_tildes($per_ape1_) . "', '" . $this->quitar_tildes($per_ape2_) .
                "', " . $per_estrato_ . ", " . $mat_programa_ . ",  '" . $this->quitar_tildes($nov_detalle_) . "', " . $nov_cod_ . ", '" . $this->quitar_tildes($loc_mun_) . "');";

        $this->adminDB->realizar_consulta($query, $this->DB);
        $this->adminDB->cerrar_conexion();
    }

    public function ejecutarConsultaX($query) {
        //$this->abrirConexion();
        $resultset = $this->adminDB->realizar_consulta($query, $this->DB);

        $this->cerrarConexion();

        return $resultset;
    }

    public function extraerListas($lista) {
        $query = "";
        switch ($lista) {
            case 1:
                $query = "SELECT * FROM programas;";
                break;
            case 2:
                $query = "SELECT * FROM novedades_tipo;";
                break;
            case 3:
                $query = "SELECT * FROM municipios;";
                break;
            
        }
        $resulSet = $this->adminDB->realizar_consulta($query, $this->DB);
        $arreglo = null;
        $i = 0;
        while ($row = $this->comprobarContenido($resulSet)) {
            switch ($lista) {
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

            }
            $i++;
        }
        $this->adminDB->cerrar_conexion();
        return $arreglo;
    }

    public function comprobarContenido($resulset) {
        $this->adminDB->conectar_servidor($this->DB);
        return $this->adminDB->revisar_contenido($resulset);
    }

    public function contarRegistros($resulset) {
        return $this->adminDB->contar_registros($resulset);
    }

    public function abrirConexion() {
        $this->adminDB->conectar_servidor($this->DB);
    }

    public function cerrarConexion() {
        $this->adminDB->cerrar_conexion();
    }

    private function quitar_tildes($cadena) {
        $no_permitidas = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "ñ", "À", "Ã", "Ì", "Ò", "Ù", "Ã™", "Ã ", "Ã¨", "Ã¬", "Ã²", "Ã¹", "ç", "Ç", "Ã¢", "ê", "Ã®", "Ã´", "Ã»", "Ã‚", "ÃŠ", "ÃŽ", "Ã”", "Ã›", "ü", "Ã¶", "Ã–", "Ã¯", "Ã¤", "«", "Ò", "Ã", "Ã„", "Ã‹");
        $permitidas = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "n", "N", "A", "E", "I", "O", "U", "a", "e", "i", "o", "u", "c", "C", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "u", "o", "O", "i", "a", "e", "U", "I", "A", "E");
        $texto = str_replace($no_permitidas, $permitidas, $cadena);
        return $texto;
    }

}
