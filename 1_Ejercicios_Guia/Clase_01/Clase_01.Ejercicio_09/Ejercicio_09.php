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