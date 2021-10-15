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
    
    if(isset($_GET['Sabor']) && isset($_GET['Precio']) && 
        isset($_GET['Tipo']) && isset($_GET['Cantidad'])){
        $pSabor = $_GET['Sabor'];
        $pPrecio = floatval($_GET['Precio']);
        $pTipo = $_GET['Tipo'];
        $pCantidad = intval($_GET['Cantidad']);

        //--- Creates a new instance of the Pizza class. ---//
        $pID = rand(1, 9);
        $myPizza = new Pizza($pID, $pSabor, $pPrecio, $pTipo, $pCantidad);
        
        echo '<h1>Pizza a Buscar</h1>';
        var_dump($myPizza);

        //--- Adds or update the new Pizza to the array. ---//
        echo Pizza::UpdateArray($myPizza, "add");
        
    }else{
        echo 'Falta al menos un dato';
    }
?>