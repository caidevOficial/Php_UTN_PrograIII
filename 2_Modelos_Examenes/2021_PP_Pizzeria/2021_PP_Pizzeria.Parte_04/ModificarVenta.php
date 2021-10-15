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

require_once 'Venta.php';
require 'DataAccess.php';
require_once 'UploadManager.php';
    
    //--- Sets the timezone to use. ---//
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    
    $body = json_decode(file_get_contents("php://input"), true);

    //--- Instance of the DataAccess class. ---//
    $daoManager = DataAccess::GetDAO();
    var_dump($body);
    if(isset($body['Sabor']) && isset($body['Email']) && 
    isset($body['Tipo']) && isset($body['Cantidad']) && 
    isset($body['NroPedido'])){
        //Searches a Venta in the DB.
        $salesToModify = Venta::getVentaByID($daoManager, intval($body['NroPedido']));
        echo "Venta encontrada: <br>";
        //var_dump($salesToModify);
        Venta::printDataAsTable($salesToModify);
        if(isset($salesToModify[0])){
            $salesToModify[0]->setUserEmail($body['Email']);
            $salesToModify[0]->setPizzaFlavor($body['Sabor']);
            $salesToModify[0]->setPizzaType($body['Tipo']);
            $salesToModify[0]->setPizzaAmount(intval($body['Cantidad']));
            Venta::updateVentaByID($daoManager, intval($body['NroPedido']), $salesToModify[0]);
        }
    }else{
        echo 'La Venta a modificar no existe.<br>';
    }
?>