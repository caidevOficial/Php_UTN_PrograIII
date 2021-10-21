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
require_once 'Cupon.php';
require_once 'Devolucion.php';

if (isset($_POST['NroPedido']) && isset($_POST['Causa'])) {

    $cause = $_POST['Causa'];
    $discount = 10;
    $daoManager = DataAccess::GetDAO();

    try {
        $sale = Venta::ReturnSale($daoManager, $_POST['NroPedido']);
        var_dump($sale);
 
        if(!is_null($sale)){
            $idCoupon = $_POST['NroPedido'];

            //--- Creates a 'Coupon' & a 'Devolucion', then saves them in the json files ---//
            if(Coupon::updateFile(Coupon::CreateCoupon($idCoupon, $sale->getUserEmail(), $discount, false, 0), 'Add') 
            && Devolucion::updateFile(Devolucion::CreateDevolucion($idCoupon, $cause), 'Devoluciones.json')){
                echo '<h2>Cupones y devoluciones generadas</h2>';
            }else{
                echo '<h2>Error al generar cupones y devoluciones</h2>';
            }
        }
    } catch (\Throwable $th) {
        echo '<h2>La venta posiblemente no existe</h2>';
        echo $th->getMessage();
    }
    
}

?>