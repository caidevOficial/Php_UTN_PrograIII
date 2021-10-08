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

//$_DELETE = array();
$method = $_SERVER['REQUEST_METHOD'];

//--- Sets the timezone to use. ---//
date_default_timezone_set('America/Argentina/Buenos_Aires');

switch ($method) {
    case 'GET':
        switch (key($_GET)) {
            case 'Cargar':
                include 'Clase_06.PP_Simulacro.Parte_01/PizzaCarga.php';
                break;
            }
        break;
    case 'POST':
        switch (key($_GET)) {
            case 'Consultas':
                include 'Clase_06.PP_Simulacro.Parte_01/PizzaConsultar.php';
                break;
            case 'Venta':
                include 'Clase_06.PP_Simulacro.Parte_02/AltaVenta.php';
                break;
            }
        break;
}
    
?>