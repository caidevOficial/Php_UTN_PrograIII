<?php
/**
 * Aplicación Nº 10 (Arrays de Arrays)
 * Realizar las líneas de código necesarias para 
 * generar un Array asociativo y otro indexado que
 * contengan como elementos tres Arrays del punto anterior 
 * cada uno. Crear, cargar y mostrar los
 * Arrays de Arrays.
 * 
 * @author Facundo Falcone.
 */

function printArray($array) {
    echo '<pre>';
    foreach ($array as $key => $value) {
        echo '[' . $key . '] => ';
        if (is_array($value)) {
            printArray($value);
        } else {
            echo $value . '<br>';
        }
    }
    echo '</pre>';
    echo '</br>';
}

 function App10(){
     $arrayAsociativo = array(
         "Lapicera1" => array("color"=>"Rojo", "marca"=>"Bic", "trazo"=>"Fino", "precio"=>"10"),
         "Lapicera2" => array("color"=>"Azul", "marca"=>"Faber", "trazo"=>"Grueso", "precio"=>"15"),
         "Lapicera3" => array("color"=>"Verde", "marca"=>"Faber Castell", "trazo"=>"Fino", "precio"=>"20")
     );
     $arrayIndexado = array(
         array("color"=>"Rojo", "marca"=>"Bic", "trazo"=>"Fino", "precio"=>"10"),
         array("color"=>"Azul", "marca"=>"Faber", "trazo"=>"Grueso", "precio"=>"15"),
         array("color"=>"Verde", "marca"=>"Faber Castell", "trazo"=>"Fino", "precio"=>"20")
     );

     echo "<pre>";
     echo "<h1>Array Asociativo</h1>";
     printArray($arrayAsociativo);
     echo "<h1>Array Indexado</h1>";
     printArray($arrayIndexado);
     echo "</pre>";

 }

 App10();
?>