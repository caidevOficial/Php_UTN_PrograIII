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
    
    //--- Instance of the DataAccess class. ---//
    $daoManager = DataAccess::GetDAO();

    //--- 4 - Query 01 ---//
    Venta::getSoldAmount($daoManager);
    echo '<br>';

    //--- 4 - Query 02 ---//
    if(isset($_POST['Fecha1'] ) && isset($_POST['Fecha2'])){
        Venta::PrintsAllSalesBetweenDates($daoManager, $_POST['Fecha1'], $_POST['Fecha2']);
        echo '<br>';
    }

    //--- 4 - Query 03 ---//
    if(isset($_POST['Usuario'])){
        Venta::PrintsAllSalesByUser($daoManager, $_POST['Usuario']);
        echo '<br>';
    }

    //--- 4 - Query 04 ---//
    if(isset($_POST['Sabor'])){
        Venta::PrintsAllSalesByType($daoManager, $_POST['Sabor']);
        echo '<br>';
    }
    
?>