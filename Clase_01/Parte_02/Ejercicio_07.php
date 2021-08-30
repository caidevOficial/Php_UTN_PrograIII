<?php
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