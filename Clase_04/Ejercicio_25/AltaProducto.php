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

    require_once 'Producto.php';
    
    $option = $_GET['task'];
    $pBarcode = $_POST['barcode'];
    $pName = $_POST['name'];
    $pType = $_POST['type'];
    $pStock = $_POST['stock'];
    $pPrice = $_POST['price'];

    //--- Sets the timezone to use. ---//
    date_default_timezone_set('America/Argentina/Buenos_Aires');

    switch ($option) {
        case 'register':
            //--- Creates a new instance of the Producto class. ---//
            $myProduct = new Product(rand(1,5), $pBarcode, $pName, $pType, $pStock, $pPrice);
            
            //--- Gets the old array of users from the file. ---//
            $myArray = Product::ReadJSON();

            echo '<h1>Producto Creado</h1>';
            var_dump($myProduct);

            //--- Adds or update the new product to the array. ---//
            $myArray = Product::UpdateArray($myArray, $myProduct);
            
            //--- Writes the new array of users to the file. ---//
            Product::SaveToJSON($myArray);

            break;
    }
?>