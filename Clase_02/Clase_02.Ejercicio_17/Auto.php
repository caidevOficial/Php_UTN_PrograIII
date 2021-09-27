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
 * Aplicación Nº 17 (Auto)
 * Realizar una clase llamada “Auto” que posea los siguientes atributos privados:
 * _color (String)
 * _precio (Double)
 * _marca (String).
 * _fecha (DateTime)
 * Realizar un constructor capaz de poder instanciar objetos pasándole como parámetros:
 * i. La marca y el color.
 * ii. La marca, color y el precio.
 * iii. La marca, color, precio y fecha.
 * Realizar un método de instancia llamado “AgregarImpuestos”, que recibirá un doble por
 * parámetro y que se sumará al precio del objeto.
 * Realizar un método de clase llamado “MostrarAuto”, que recibirá un objeto de tipo “Auto”
 * por parámetro y que mostrará todos los atributos de dicho objeto.
 * Crear el método de instancia “Equals” que permita comparar dos objetos de tipo “Auto”. Sólo
 * devolverá TRUE si ambos “Autos” son de la misma marca.
 * Crear un método de clase, llamado “Add” que permita sumar dos objetos “Auto” (sólo si son
 * de la misma marca, y del mismo color, de lo contrario informarlo) y que retorne un Double con
 * la suma de los precios o cero si no se pudo realizar la operación.
 * Ejemplo: $importeDouble = Auto::Add($autoUno, $autoDos);
 * @author Facundo Falcone.
 */

/**
 * Class Auto
 */
class Auto{
    private $_color;
    private $_precio;
    private $_marca;
    private $_fecha;

    /**
     * Auto constructor.
     *
     * @param string $color Color of the car (red, blue, black, etc.).
     * @param string $marca Brand of the car (Ford, Honda, etc.).
     * @param float $precio Price of the car.
     * @param string $fecha Date of the car.
     */
    public function __construct($color, $precio=10000, $marca, $fecha=25/02/2021){
        $this->_color = $color;
        $this->_marca = $marca;
        $this->_precio = $precio;
        $this->_fecha = $fecha;
    }

    /**
     * It adds a tax to the price of the car.
     *
     * @param double $impuesto Tax to be added.
     * @return void
     */
    public function AgregarImpuesto($impuesto){
        $this->_precio += $impuesto;
    }

    /**
     * It prints the information of the car.
     * 
     * @param AUTO $auto Car to be printed.
     */
    public static function MostrarAuto(Auto $auto){
        echo "<br>Color: " . $auto->_color;
        echo "<br>Marca: " . $auto->_marca;
        echo "<br>Precio: " . $auto->_precio;
        echo "<br>Fecha: " . $auto->_fecha;
    }

    /**
     * Compares if the car by parameter have the same brand.
     *
     * @param Auto $auto Car to be compared.
     * @return bool True if the cars have the same brand, false otherwise.
     */
    public function Equals($auto){
        return $this->_marca == $auto->_marca;
    }

    /**
     * It sums the price of the car by parameter and the price of the car.
     *
     * @param Auto $auto1 First car to be summed.
     * @param Auto $auto2 Second car to be summed.
     * @return double Sum of the prices of the cars if they have the same 
     * brand and color, 0 otherwise.
     */
    public static function Add($auto1, $auto2){
        if($auto1->Equals($auto2) && $auto1->_color == $auto2->_color){
            return $auto1->_precio + $auto2->_precio;
        }else{
            return 0;
        }
    }
}
?>