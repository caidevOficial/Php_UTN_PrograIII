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
    
    if(isset($_GET['Sabor']) && isset($_GET['PrecioBruto']) && 
        isset($_GET['Tipo']) && isset($_GET['Cantidad'])){
        $pSabor = $_GET['Sabor'];
        $pPrecio = floatval($_GET['PrecioBruto']);
        $pTipo = $_GET['Tipo'];
        $pCantidad = intval($_GET['Cantidad']);

        //--- Creates a new instance of the Object. ---//
        $pID = rand(1, 25000);
        $myNewObject = Helado::createIceCream($pID, $pSabor, $pTipo, $pPrecio, $pCantidad);
        echo '<h3>Producto a Buscar:</h3>'.'<br>';
        Helado::printSingleProductAsTable($myNewObject);

        //--- Adds or update the new product to the array. ---//
        echo Helado::UpdateFile($myNewObject, "add");
        
    }else{
        echo 'Falta al menos un dato';
    }
?>