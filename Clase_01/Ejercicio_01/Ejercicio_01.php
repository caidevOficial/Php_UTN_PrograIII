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

    /* 
    * Aplicación No 1 (Sumar números)
    * Confeccionar un programa que sume todos los números enteros desde 1 mientras la suma no
    * supere a 1000. Mostrar los números sumados y al finalizar el proceso indicar cuantos números
    * se sumaron.
    * Falcone, Facundo
    */

    $contador = 1;
    $suma = 0;
    while(($suma + $contador) < 1000){
        $suma += $contador;
        $contador++;
    }
    
    printf("<br>La suma es:".$suma);
    printf("<br>La cantidad de numeros sumados es: ".$contador);
?>