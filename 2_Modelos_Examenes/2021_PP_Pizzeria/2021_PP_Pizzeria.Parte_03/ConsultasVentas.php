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
require_once 'Venta.php';
require 'DataAccess.php';
    
    //--- Sets the timezone to use. ---//
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    //--- Instance of the DataAccess class. ---//
    $daoManager = DataAccess::GetDAO();
    
    //--- 4 - Query 01 ---//
    Venta::getPizzasSoldAmount($daoManager);
    echo '<br>';

    //--- 4 - Query 02 ---//
    if(isset($_POST['Fecha1'] ) && isset($_POST['Fecha2'])){
        Venta::PrintsAllVentasBetweenDates($daoManager, $_POST['Fecha1'], $_POST['Fecha2']);
        echo '<br>';
    }

    //--- 4 - Query 03 ---//
    if(isset($_POST['Usuario'])){
        Venta::PrintsAllVentasByUser($daoManager, $_POST['Usuario']);
        echo '<br>';
    }

    //--- 4 - Query 04 ---//
    if(isset($_POST['Sabor'])){
        Venta::PrintsAllVentasByFlavor($daoManager, $_POST['Sabor']);
        echo '<br>';
    }
    
?>