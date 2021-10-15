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

require_once 'Pizza.php';

    if(isset($_POST['Sabor']) && isset($_POST['Tipo'])){
        $pSabor = $_POST['Sabor'];
        $pTipo = $_POST['Tipo'];
        var_dump(key($_POST));

        //--- Gets the old array of pizzas from the file. ---//
        $myArray = Pizza::ReadJSON();

        echo '<h1>Pizzas a Buscar</h1><br>';
        echo '<h2> Sabor: '.$pSabor.' Tipo: '.$pTipo.'</h2><br>';

        //--- Adds or update the new Pizza to the array. ---//
        $myArray = Pizza::ReadJSON();
        echo '<h3>'.Pizza::SearchFor($myArray, $pSabor, $pTipo).'</h3> <br>';
    } 
?>