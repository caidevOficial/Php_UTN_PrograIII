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
    
    $body = json_decode(file_get_contents("php://input"), true);
    var_dump($body['NroPedido']);
    //--- Instance of the DataAccess class. ---//
    $daoManager = DataAccess::GetDAO();
    $oldDirectory = 'ImagenesDeLaVenta/';
    $newDirectory = './BACKUPVENTAS/';
    if(isset($body['NroPedido'])){
        //Searches a Venta in the DB.
        $salesToDelete = Venta::getVentaByID($daoManager, intval($body['NroPedido']));
        if(isset($salesToDelete)){
            if(Venta::deleteVentaByID($daoManager, intval($body['NroPedido']))>0){
                echo 'Venta Eliminada, se procede a mover la imagen de la venta.<br>';
                
                $imageName = UploadManager::getSalesImageName($salesToDelete[0]);
                echo '<br>'.'Image to be moved: '.$oldDirectory.$imageName.'<br>';
                
                
                if(UploadManager::moveImageFromTo($oldDirectory, $newDirectory, $imageName)){
                    echo '<br>Imagen fue movida a: '.$newDirectory.$imageName.'<br>';
                }else{
                    echo '<br>Error al mover la imagen.<br>';
                }
            }else{
                echo '<br>Ningun registro afectado.<br>';
            }
            
        }
    }else{
        echo '<br>La Venta a Borrar no existe.<br>';
    }
?>