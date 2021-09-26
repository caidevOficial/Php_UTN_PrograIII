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

include_once 'File.php';

class Usuario{
    
    private $nombre;

    /**
     * Creates an object of type Usuario.
     * @param string $nombre The name of the user.
     */
    public function __construct($nombre="Sin Nombre"){
        $this->nombre = $nombre;
    }

    /**
     * Returns the name of the user.
     * @return string The name of the user.
     */
    public static function MostrarUsuario(String $usuario){
        echo "El usuario es: ".$Usuario->usuario;
    }

    /**
     * Returns the name of the user.
     * @return string The name of the user.
     */
    public function getNombre(){
        return $this->nombre;
    }

    /**
     * Writes a file with the name of the user.
     */
    public function GuardarCSV(){
        $archivo = fopen("usuarios.csv", "a+");
        if ($archivo) {
            fwrite($archivo, $this->nombre."\n");
            fclose($archivo);
        }
    }

}
?>