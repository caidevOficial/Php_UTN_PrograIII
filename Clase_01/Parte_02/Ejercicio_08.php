<?php
    /**
     * Aplicación Nº 8 (Carga aleatoria)
     * Imprima los valores del vector asociativo siguiente 
     * usando la estructura de control foreach :
     * $v[1]=90; $v[30]=7; $v['e']=99; $v['hola']= 'mundo';
     * 
     * @author Facundo Falcone
     */

     function cargaAleatoria($vector) {
        $vector = array(
            1 => 90,
            30 => 7,
            '"e"' => 99,
            '"hola"' => '"mundo"'
        );

        return $vector;
    }

    function printVector($vector) {
        foreach ($vector as $key => $value) {
            echo "El valor de la clave $key es $value <br>";
        }
    }

    $vector = cargaAleatoria(array());
    printVector($vector);
?>