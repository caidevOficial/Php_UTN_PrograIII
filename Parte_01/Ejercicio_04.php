<?php
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