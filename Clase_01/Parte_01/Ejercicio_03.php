<?php
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
