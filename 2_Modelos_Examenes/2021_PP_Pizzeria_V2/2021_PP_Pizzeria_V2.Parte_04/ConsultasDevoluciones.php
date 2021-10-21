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

 require_once 'Cupon.php';
 require_once 'Devolucion.php';

    $arrayCoupons = Coupon::readJson();
    $arrayDevoluciones = Devolucion::readJson();
    
    //--- Query 01 ---//
    if(isset($_POST['Devoluciones'])){
        echo "<h2>Devoluciones Hechas</h2><br>";
        Devolucion::printDevolutionsAsTable($arrayDevoluciones);
    }

    //--- Query 02 ---//
    if(isset($_POST['Cupones'])){
        echo "<h2>Cupones Generados</h2><br>";
        Coupon::printCouponsAsTable($arrayCoupons);
    }

    //--- Query 03 ---//
    if(isset($_POST['Devolucion_con_Cupones'])){
        echo "<h2>Devoluciones con Cupones - Status</h2><br>";
        Devolucion::printDevolutionsAndCouponsAsTable($arrayDevoluciones, $arrayCoupons);
    }

?>