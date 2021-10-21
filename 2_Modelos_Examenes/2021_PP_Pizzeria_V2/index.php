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

$_DELETE = array();
$method = $_SERVER['REQUEST_METHOD'];

//--- Sets the timezone to use. ---//
date_default_timezone_set('America/Argentina/Buenos_Aires');

switch ($method) {
    case 'POST':
        switch (key($_GET)) {
            case 'Cargar':
                include '2021_PP_Pizzeria_V2.Parte_01/PizzaCarga.php';
                break;
            case 'Consultas':
                include '2021_PP_Pizzeria_V2.Parte_01/PizzaConsultar.php';
                break;
            case 'Venta':
                include '2021_PP_Pizzeria_V2.Parte_01/AltaVenta.php';
                break;
            case 'ConsultasVentas':
                include '2021_PP_Pizzeria_V2.Parte_02/ConsultasVentas.php';
                break;
            case 'Devolucion':
                include '2021_PP_Pizzeria_V2.Parte_03/DevolverPizza.php';
                break;
            case 'VentaCupon':
                include '2021_PP_Pizzeria_V2.Parte_04/AltaVenta.php';
                break;
            case 'ConsultasDevoluciones':
                include '2021_PP_Pizzeria_V2.Parte_04/ConsultasDevoluciones.php';
                break;
            }
        break;
    case 'PUT':
        include '2021_PP_Pizzeria_V2.Parte_02/ModificarVenta.php';
        break;
    case 'DELETE':
        include '2021_PP_Pizzeria_V2.Parte_03/BorrarVenta.php';
        break;
}
    
?>