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
require_once 'UploadManager.php';
    
    if(isset($_POST['Sabor']) && isset($_POST['Precio']) && 
        isset($_POST['Tipo']) && isset($_POST['Cantidad'])){
        
        //--- Gets the input of the user. ---//
        $pSabor = $_POST['Sabor'];
        $pPrecio = floatval($_POST['Precio']);
        $pTipo = $_POST['Tipo'];
        $pCantidad = intval($_POST['Cantidad']);

        //--- Creates a new instance of the Object. ---//
        $pID = rand(1, 25000);
        $myNewObject = Helado::createIceCream($pID, $pSabor, $pTipo, $pPrecio, $pCantidad);
        
        //--- Prints the information of the new product. ---//
        echo '<h3>Producto a Buscar:</h3>'.'<br>';
        Helado::printSingleProductAsTable($myNewObject);

        //--- Adds or update the new Pizza to the array. ---//
        if(Helado::UpdateFile($myNewObject, "add")){
            //--- Instance of the class UploadManager. ---//
            $imagesDirectory = "./ImagenesDeHelados/";
            $UpManager = new UploadManager($imagesDirectory, $myNewObject, $_FILES);
            echo '<h2>Producto Agregado</h2><br>';
        }else{
            echo '<h2>Producto No Agregado</h2>';
        }
        
    }else{
        echo '<h2>Falta al menos un dato</h2><br>';
    }
?>