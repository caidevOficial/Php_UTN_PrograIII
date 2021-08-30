<?php
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