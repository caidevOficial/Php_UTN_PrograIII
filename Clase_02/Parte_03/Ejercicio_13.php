<?php
/**
 * Ejercicio 13
 * Aplicación Nº 13 (Invertir palabra)
 * Crear una función que reciba como parámetro un 
 * string ($palabra) y un entero ($max). La función validará que la 
 * cantidad de caracteres que tiene $palabra no supere a $max y además
 * deberá determinar si ese valor se encuentra dentro del siguiente 
 * listado de palabras válidas:
 * “Recuperatorio”, “Parcial” y “Programacion”. Los valores de retorno serán:
 * 1 si la palabra pertenece a algún elemento del listado.
 * 0 en caso contrario.
 * 
 * @author Facundo Falcone.
 */

 /**
  * Function that receives a string ($palabra) and an integer ($max).
  * The function validates that the number of characters that have $palabra
  * does not exceed $max and also determines if that value is within the
  * following list of valid words:
  * “Recuperatorio”, “Parcial” and “Programacion”. The values of return will be:
  * 1 if the word belongs to any element of the list.
  * 0 otherwise.
  *
  * @param string $palabra string to validate.
  * @param int $max
  * @return void
  */
 function wordValidator($palabra, $max){
    $palabra = strtolower($palabra);
    $palabrasValidas = array("recuperatorio", "parcial", "programacion");
    if(strlen($palabra) <= $max){
        if(in_array($palabra, $palabrasValidas)){
            return 1;
        }
    }
    return 0;
 }
 
 $palabra = "Recuperatorio";
 $max = 10;

 echo wordValidator($palabra, $max);

?>