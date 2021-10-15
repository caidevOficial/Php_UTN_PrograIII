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
require_once 'UploadManager.php';
    
    //--- Sets the timezone to use. ---//
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    
    //--- Check if the data is correct. ---//
    if(isset($_POST['Sabor']) && isset($_POST['Email']) && 
        isset($_POST['Tipo']) && isset($_POST['Cantidad'])){
        $pSabor = $_POST['Sabor'];
        $vEmail = $_POST['Email'];
        $pTipo = $_POST['Tipo'];
        $pCantidad = intval($_POST['Cantidad']);

        //--- Instance of the DataAccess class. ---//
        $daoManager = DataAccess::GetDAO();
        
        

        //--- Creates a new instance of the Pizza class. ---//
        $myPizza = new Pizza(null, $pSabor, null, $pTipo, $pCantidad);
        //$actualDateTime = date('Y-m-d__H_i_s');
        echo '<h1>Pizza a Buscar para vender</h1>';
        var_dump($myPizza);

        //--- Adds or update the new Pizza to the array. ---//
        if(Pizza::UpdateArray($myPizza, "sub")){
            // Agrego a BBDD la venta
            $venta = Venta::CreateVenta($vEmail, $myPizza);
            echo '<h1>Venta a agregar a BBDD</h1><br>';
            var_dump($venta);
            echo 'Venta a insertar: '.$venta->insertIntoDB($daoManager).'<br>';
            
            //--- Instance of the class UploadManager. ---//
            $imagesDirectory = "./ImagenesDeLaVenta/";
            $UpManager = new UploadManager($imagesDirectory, $venta, $_FILES);
            echo 'Venta Cargada con exito.<br>';
        }else{
            echo 'No hay stock de la pizza seleccionada<br>';
        }
        
    }else{
        echo 'Falta al menos un dato<br>';
    }
?>