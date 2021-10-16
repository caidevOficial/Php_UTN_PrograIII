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

require_once 'Helado.php';
require_once 'Venta.php';
require_once 'DataAccess.php';
require_once 'UploadManager.php';
    
    $body = json_decode(file_get_contents("php://input"), true);
    //--- Instance of the DataAccess class. ---//
    $daoManager = DataAccess::GetDAO();
    $oldDirectory = 'ImagenesDeLaVenta/';
    $newDirectory = './BACKUPVENTAS/';
    
    try {
        if(isset($body['NroPedido'])){
            //--- Searches a Sale in the DB by its ID. ---//
            $salesToDelete = Venta::getVentaByID($daoManager, intval($body['NroPedido']));
            echo '<h2>Venta a Eliminar:</h2>';
            echo '<h3> Venta ID: ['.$body['NroPedido'].']</h3>';
            echo '<h3>Detalle Venta:</h3>';
            Venta::printSingleSaleAsTable($salesToDelete[0]);
            if(isset($salesToDelete)){

                //--- Tryes to delete the Venta from the DB. ---//
                if(Venta::deleteVentaByID($daoManager, intval($body['NroPedido']))>0){
                    echo '<h3>Venta Eliminada, se procede a mover la imagen de la venta.</h2>';
                    $imageName = UploadManager::getSalesImageName($salesToDelete[0]);
                    echo '<h3>'.'Image to be moved: '.$oldDirectory.$imageName.'</h3>';

                    //--- Tryes to move the image from the old directory to the new one. ---//
                    if(UploadManager::moveImageFromTo($oldDirectory, $newDirectory, $imageName)){
                        echo '<h3>Imagen fue movida a: '.$newDirectory.$imageName.'</h3><br>';
                    }else{
                        echo '<h2>Error al mover la imagen.</h2><br>';
                    }
                }else{
                    echo '<h3>Ningun registro afectado.</h3><br>';
                }
                
            }
        }else{
            echo '<h2>La Venta a Borrar no existe.</h2><br>';
        }
    } catch (\Throwable $th) {
        echo '<h2>Error al intentar borrar la venta.</h2><br>';
        echo '<h3>'.$th->getMessage().'</h3><br>';
    }
?>