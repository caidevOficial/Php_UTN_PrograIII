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
 * Generar una aplicación que permita 
 * cargar los primeros 10 números impares en un Array.
 * Luego imprimir (utilizando la estructura for ) 
 * cada uno en una línea distinta (recordar que el
 * salto de línea en HTML es la etiqueta < br/> ). 
 * Repetir la impresión de los números utilizando 
 * las estructuras while y foreach .
 */
function MakeArray($array, $size){
    for ($i = 0; $i < $size; $i++) {
        $array[$i] = $i * 2 + 1;
    }
    return $array;
}

function printOdds($array){
    for ($i = 0; $i < count($array); $i++) {
        echo $array[$i] . "<br/>";
    }
    echo "################<br/>";
}

function printOddsWhile($array){
    $i = 0;
    while ($i < count($array)) {
        echo $array[$i] . "<br/>";
        $i++;
    }
    echo "################<br/>";
}

function printOddsForeach($array){
    foreach ($array as $value) {
        echo $value . "<br/>";
    }
    echo "################<br/>";
}

$array = MakeArray(array(), 10);
printOdds($array);
printOddsWhile($array);
printOddsForeach($array);
?>