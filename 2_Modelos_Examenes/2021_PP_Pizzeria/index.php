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

$_DELETE = array();
$method = $_SERVER['REQUEST_METHOD'];

//--- Sets the timezone to use. ---//
date_default_timezone_set('America/Argentina/Buenos_Aires');

switch ($method) {
    case 'GET':
        switch (key($_GET)) {
            case 'Cargar':
                include '2021_PP_Pizzeria.Parte_01/PizzaCarga.php';
                break;
            }
        break;
    case 'POST':
        switch (key($_GET)) {
            case 'Consultas':
                include '2021_PP_Pizzeria.Parte_01/PizzaConsultar.php';
                break;
            case 'Venta':
                include '2021_PP_Pizzeria.Parte_02/AltaVenta.php';
                break;
            case 'ConsultasVentas':
                include '2021_PP_Pizzeria.Parte_03/ConsultasVentas.php';
                break;
            case 'Cargar':
                include '2021_PP_Pizzeria.Parte_04/PizzaCarga.php';
                break;
            }
        break;
    case 'PUT':
        include '2021_PP_Pizzeria.Parte_04/ModificarVenta.php';
        break;
    case 'DELETE':
        include '2021_PP_Pizzeria.Parte_04/BorrarVenta.php';
        break;
}
    
?>