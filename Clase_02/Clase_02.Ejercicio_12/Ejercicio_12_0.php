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

/**
 * Ejercicio 12.0
 * Aplicación Nº 12.0 (Saludar)
 * Realizar el desarrollo de una función que 
 * reciba un Nombre y te salude
 * Ejemplo: Se recibe la palabra "Facu" y luego queda “Hola Facu, mi rey”.
 * 
 * @author Facundo Falcone.
 */

 /**
  * Function that greets the user.
  *
  * @param string $nombre The name of the user.
  * @return void
  */
 function saludar($nombre){
    echo "Hola $nombre, mi rey";
}

echo saludar("Facu");

?>