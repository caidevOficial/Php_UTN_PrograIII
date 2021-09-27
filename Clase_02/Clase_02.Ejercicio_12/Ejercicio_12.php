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