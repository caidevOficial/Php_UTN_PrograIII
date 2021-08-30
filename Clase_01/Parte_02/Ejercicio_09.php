<?php
    /**
     * Aplicación Nº 9 (Arrays asociativos)
     * Realizar las líneas de código necesarias 
     * para generar un Array asociativo $lapicera, que
     * contenga como elementos: ‘color’ , ‘marca’ , ‘trazo’ y 
     * ‘precio’ . Crear, cargar y mostrar tres lapiceras.
     * 
     * @author Facundo Falcone
     */

     $arrayColor = array(
         "Rojo",
         "Azul",
         "Verde"
     );

     $arrayMarca = array(
         "Bic",
         "Faber Castell",
         "Parker"
     );

     $arrayTrazo = array(
         "Fino",
         "Grueso",
         "Medio"
     );

     $arrayPrecio = array(
         "10",
         "15",
         "20"
     );

     function LoadRandomLapicera($array, &$arrayColor, &$arrayMarca, &$arrayTrazo, &$arrayPrecio){
        $array = array(
            'color' => $arrayColor[array_rand($arrayColor, 1)],
            'marca' => $arrayMarca[array_rand($arrayMarca, 1)],
            'trazo' => $arrayTrazo[array_rand($arrayTrazo, 1)],
            'precio' => $arrayPrecio[array_rand($arrayPrecio, 1)]
        );

        return $array;
    }
    
function ShowLapicera($lapicera){
    foreach ($lapicera as $key => $value) {
        echo $key . ": " . $value . "<br>";
    }
    echo "<br>";
}

    $lapicera1 = LoadRandomLapicera(array(), $arrayColor, $arrayMarca, $arrayTrazo, $arrayPrecio);
    $lapicera2 = LoadRandomLapicera(array(), $arrayColor, $arrayMarca, $arrayTrazo, $arrayPrecio);
    $lapicera3 = LoadRandomLapicera(array(), $arrayColor, $arrayMarca, $arrayTrazo, $arrayPrecio);
    ShowLapicera($lapicera1);
    ShowLapicera($lapicera2);
    ShowLapicera($lapicera3);
?>