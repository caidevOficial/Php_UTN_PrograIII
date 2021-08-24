<?php
    /*
    Aplicación Nº 2 (Mostrar fecha y estación)
    Obtenga la fecha actual del servidor (función date ) y 
    luego imprímala dentro de la página con
    distintos formatos (seleccione los formatos que más le guste). 
    Además indicar que estación del
    año es. Utilizar una estructura selectiva múltiple.
    
    * Falcone, Facundo
    */
    
     $dayOfYear = date("z");
     $date = date("d/m");
     $season = "Primavera";
     
     if($dayOfYear < 79){
         $season = "Verano";
     }else if($dayOfYear < 172){
         $season = "Otoño";
     }else if($dayOfYear < 265){
        $season = "Invierno";
    }

     printf("<h2># La fecha es: ".$date."</h2>");
     printf("<h3># La fecha es: ".$date."</h3>");
     printf("<br># La estación es: ".$season);

?>
