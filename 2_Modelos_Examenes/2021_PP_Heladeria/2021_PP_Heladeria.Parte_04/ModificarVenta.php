<?php
/**
 * MIT License
 *
 * Copyright (C) 2021 <FacuFalcone - CaidevOficial>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 * You should have received a copy of the MIT license
 * along with this program.  If not, see <https://opensource.org/licenses/MIT>.
 *
 * @author Facundo Falcone <CaidevOficial> 
 */

require_once 'Venta.php';
require_once 'DataAccess.php';
require_once 'UploadManager.php';
    
    $body = json_decode(file_get_contents("php://input"), true);

    //--- Instance of the DataAccess class. ---//
    $daoManager = DataAccess::GetDAO();
    $imagesDirectory = "./ImagenesDeLaVenta/";

    if(isset($body['Sabor']) && isset($body['Email']) && 
    isset($body['Tipo']) && isset($body['Cantidad']) && 
    isset($body['NroPedido'])){
        //Searches a Venta in the DB.
        $salesToModify = Venta::getVentaByID($daoManager, intval($body['NroPedido']));
        echo "<h3>Venta a modificar: </h3>";
        Venta::printSingleSaleAsTable($salesToModify[0]);
        //--- Original image name ---//
        $originalImageName = $imagesDirectory.UploadManager::getSalesImageName($salesToModify[0]);

        if(isset($salesToModify[0])){
            
            //--- Sets new values on the Venta object. ---//
            $salesToModify[0]->setUserEmail($body['Email']);
            $salesToModify[0]->setFlavor($body['Sabor']);
            $salesToModify[0]->setType($body['Tipo']);
            $salesToModify[0]->setAmount(intval($body['Cantidad']));
            
            //--- Updates the Venta in the DB. ---//
            if(Venta::updateVentaByID($daoManager, intval($body['NroPedido']), $salesToModify[0])>0){
                echo "<h3>Venta modificada: </h3>";
                $saleModified = Venta::getVentaByID($daoManager, intval($body['NroPedido']));
                Venta::printSingleSaleAsTable($saleModified[0]);
                //--- Rename the image according the new data of the sale modified ---//
                $newImageName = $imagesDirectory.UploadManager::getSalesImageName($saleModified[0]);
                rename($originalImageName, $newImageName);
            }else{
                echo "<h3>Error al modificar la venta, chequea bien los datos.</h3>";
            }
        }
    }else{
        echo '<h2>La Venta con ID: ['.$body['NroPedido'].'] no existe.</h2><br>';
    }
?>