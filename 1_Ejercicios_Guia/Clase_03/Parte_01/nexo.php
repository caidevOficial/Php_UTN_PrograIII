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

    require_once 'usuario.php';
    $opcion = $_GET['tarea'];
    $nombre = $_POST['nombre'];
    var_dump($opcion);
    
    switch ($opcion) {
        case 'mostrar':
            Usuario::MostrarUsuario($nombre);
            break;
        case 'crear':
            $user = new Usuario($nombre);
            Usuario::MostrarUsuario($user->getNombre());
            break;
    }
?>