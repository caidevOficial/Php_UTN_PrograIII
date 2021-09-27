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
     * Aplicación Nº 4 (Calculadora)
     * Escribir un programa que use la variable $operador
     * que pueda almacenar los símbolos matemáticos:
     * ‘ + ’, ‘ - ’, ‘ / ’ y ‘ * ’; y definir dos variables enteras
     * $op1 y $op2 . De acuerdo al símbolo que tenga la variable $operador,
     * deberá realizarse la operación indicada y mostrarse el resultado por pantalla.
     *
     * Facundo Falcone
     */

    $op1 = 25;
    $op2 = 0;
    $result = "ZeroDivisionError";
    $operador = '/';

    switch ($operador) {
        case '+':
            $result =  $op1 + $op2;
            break;
        case '-':
            $result =  $op1 - $op2;
            break;
        case '/':
            if ($op2 != 0) {
                $result = $op1 / $op2;
            }
            break;
        case '*':
            $result =  $op1 * $op2;
            break;
    }

    print("Result: ".$result);

?>