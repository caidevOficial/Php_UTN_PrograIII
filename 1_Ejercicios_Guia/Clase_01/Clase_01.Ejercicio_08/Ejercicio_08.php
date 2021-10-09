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