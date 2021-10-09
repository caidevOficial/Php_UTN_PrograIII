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
