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
        $myNewObject = Helado::createIceCream(0, $pSabor, $pTipo, 0, $pCantidad);
        echo '<h2>Helado a Buscar para vender</h2><br>';
        Helado::printSingleProductAsTable($myNewObject);
        //var_dump($myNewObject);

        //--- Adds or update the new Pizza to the array. ---//
        if(Helado::UpdateFile($myNewObject, "sub")){
            // Agrego a BBDD la venta
            $newSale = Venta::CreateVenta($vEmail, $myNewObject);
            echo '<h1>Venta a agregar a BBDD</h1><br>';
            Venta::printSingleSaleAsTable($newSale);
            //var_dump($newSale);
            echo '<br>ID Venta insertada: ['.$newSale->insertIntoDB($daoManager).']<br>';
            
            //--- Instance of the class UploadManager. ---//
            $imagesDirectory = "./ImagenesDeLaVenta/";
            $UpManager = new UploadManager($imagesDirectory, $newSale, $_FILES);
            echo '<br>Venta Cargada con exito.<br>';
        }else{
            echo '<br>No hay stock del producto seleccionado<br>';
        }
        
    }else{
        echo '<br>Falta al menos un dato<br>';
    }
?>