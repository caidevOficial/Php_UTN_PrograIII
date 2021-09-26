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
     * Aplicación Nº 6 (Carga aleatoria)
     * Definir un Array de 5 elementos enteros y asignar 
     * a cada uno de ellos un número (utilizar la función rand ). 
     * Mediante una estructura condicional, determinar si el promedio de los números
     * son mayores, menores o iguales que 6. Mostrar un mensaje por pantalla 
     * informando el resultado.
     * 
     * @author Facundo Falcone
     */

     function LoadArray($array, $size) {
        for ($i = 0; $i < $size; $i++) {
            $array[$i] = rand(0, 12);
        } 
     }

     function ShowAverage($array) {
         $average = 0;
         $averageMessage = "";
         for ($i = 0; $i<count($array); $i++) {
             $average += $array[$i];
         }
         if($average / count($array)<6) {
             $averageMessage = " menor que 6";
         }
         else if($average / count($array)>6) {
             $averageMessage = " mayor que 6";
         }
         else {
             $averageMessage = " igual a 6";
         }

         printf("<br>El promedio es".$averageMessage);
     }

     $array = array();
	 $array = LoadArray($array, 5);
	 var_dump($array);
     ShowAverage($array);
?>