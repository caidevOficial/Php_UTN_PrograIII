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
     * Aplicación Nº 3 (Obtener el valor del medio)
     * Dadas tres variables numéricas de tipo entero
     * $ a , $ b y $ c realizar una aplicación que muestre el contenido
     * de aquella variable que contenga el valor que se encuentre en
     * el medio de las tres variables. De no existir dicho valor,
     * mostrar un mensaje que indique lo sucedido.
     * Ejemplo 1: $a = 6; $b = 9; $c = 8; => se muestra 8.
     * Ejemplo 2: $a = 5; $b = 1; $c = 5; => se muestra un mensaje “No hay valor del medio”.
     *
     * Facundo Falcone
     */

    $firstValue = 5;
    $secondValue = 1;
    $thirdValue = 5;
    $midValue = "There isn't a mid value.";

    if ($firstValue > $secondValue && $firstValue < $thirdValue ||
        $firstValue < $secondValue && $firstValue > $thirdValue) {
        $midValue = $firstValue;
    } else if ($secondValue > $firstValue && $secondValue < $thirdValue ||
        $secondValue < $firstValue && $secondValue > $thirdValue) {
        $midValue = $secondValue;
    } else if ($thirdValue > $firstValue && $thirdValue < $secondValue ||
        $thirdValue < $firstValue && $thirdValue > $secondValue) {
        $midValue = $thirdValue;
    }

    printf("<h2># Mid Value: ".$midValue."</h2>");
