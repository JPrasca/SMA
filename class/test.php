<?php
include 'ManejoDatos.php';
$a = new ManejoDatos();
$arreglo = $a->extraerListas(1);


for($i = 0; $i < count($arreglo); $i++){
    echo $arreglo[$i]["nombre"]."</br>";
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

