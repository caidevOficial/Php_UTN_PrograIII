<?php
/**
 * Ejercicio 12
 * Aplicación Nº 12 (Invertir palabra)
 * Realizar el desarrollo de una función que 
 * reciba un Array de caracteres y que invierta el orden
 * de las letras del Array.
 * Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”.
 * 
 * @author Facundo Falcone.
 */

 /**
  * Function that inverts the order of the letters of an array.
  *
  * @param string $palabra Word to be inverted.
  * @return void
  */
 function invertirPalabra($palabra) {
     $palabraInvertida = "";
     for ($i = strlen($palabra) - 1; $i >= 0; $i--) {
         $palabraInvertida .= $palabra[$i];
     }
     return $palabraInvertida;
 }

 $palabra = "HOLA";
 echo "Palabra original: " . $palabra . "<br>";
 echo "Palabra invertida: " . invertirPalabra($palabra);
?>