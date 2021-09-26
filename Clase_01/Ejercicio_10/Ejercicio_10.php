<?php
/* 
 * MIT License
 *
 * Copyright (C) 2021 <FacuFalcone - CaidevOficial>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Facundo Falcone <CaidevOficial> 
 */

/**
 * Aplicación Nº 10 (Arrays de Arrays)
 * Realizar las líneas de código necesarias para 
 * generar un Array asociativo y otro indexado que
 * contengan como elementos tres Arrays del punto anterior 
 * cada uno. Crear, cargar y mostrar los
 * Arrays de Arrays.
 * 
 * @author Facundo Falcone.
 */

function printArray($array) {
    echo '<pre>';
    foreach ($array as $key => $value) {
        echo '[' . $key . '] => ';
        if (is_array($value)) {
            printArray($value);
        } else {
            echo $value . '<br>';
        }
    }
    echo '</pre>';
    echo '</br>';
}

 function App10(){
     $arrayAsociativo = array(
         "Lapicera1" => array("color"=>"Rojo", "marca"=>"Bic", "trazo"=>"Fino", "precio"=>"10"),
         "Lapicera2" => array("color"=>"Azul", "marca"=>"Faber", "trazo"=>"Grueso", "precio"=>"15"),
         "Lapicera3" => array("color"=>"Verde", "marca"=>"Faber Castell", "trazo"=>"Fino", "precio"=>"20")
     );
     $arrayIndexado = array(
         array("color"=>"Rojo", "marca"=>"Bic", "trazo"=>"Fino", "precio"=>"10"),
         array("color"=>"Azul", "marca"=>"Faber", "trazo"=>"Grueso", "precio"=>"15"),
         array("color"=>"Verde", "marca"=>"Faber Castell", "trazo"=>"Fino", "precio"=>"20")
     );

     echo "<pre>";
     echo "<h1>Array Asociativo</h1>";
     printArray($arrayAsociativo);
     echo "<h1>Array Indexado</h1>";
     printArray($arrayIndexado);
     echo "</pre>";

 }

 App10();
?>