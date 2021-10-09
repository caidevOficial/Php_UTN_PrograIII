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

class Pizza{
    public $_id;
    public $_sabor;
    public $_precio;
    public $_tipo;
    public $_cantidad;

    public function __construct($id, $sabor, $precio, $tipo, $cantidad){
        $this->setID($id);
        $this->setSabor($sabor);
        $this->setPrecio($precio);
        $this->setTipo($tipo);
        $this->setCantidad($cantidad);
    }

    /**
     * Sets the id of the pizza.
     * @param int $id The id of the pizza.
     */
    public function setID($id){
        if (isset($id) && is_numeric($id)){
            $this->_id = $id;
        }
    }

    /**
     * Sets the flavor of the pizza.
     * @param string $sabor The flavor of the pizza.
     */
    public function setSabor($sabor){
        if (isset($sabor)){
            $this->_sabor = $sabor;
        }
    }

    /**
     * Sets the price of the pizza.
     * @param float $precio The price of the pizza.
     */
    public function setPrecio($precio){
        if (!empty($precio) && is_numeric($precio)){
            $this->_precio = $precio;
        }
    }

    /**
     * Sets the type of the pizza.
     * @param string $tipo The type of the pizza.
     */
    public function setTipo($tipo){
        if (isset($tipo)){
            $this->_tipo = $tipo;
        }
    }

    /**
     * Sets the quantity of the pizza.
     * @param int $cantidad The quantity of the pizza.
     */
    public function setCantidad($cantidad){
        if (!empty($cantidad) && is_numeric($cantidad)){
            $this->_cantidad = $cantidad;
        }
    }

    //--- Getters ---//

    /**
     * Gets the id of the pizza.
     * @return int The id of the pizza.
     */
    public function getID(){
        return $this->_id;
    }

    /**
     * Gets the flavor of the pizza.
     * @return string The flavor of the pizza.
     */
    public function getSabor(){
        return $this->_sabor;
    }

    /**
     * Gets the price of the pizza.
     * @return float The price of the pizza.
     */
    public function getPrecio(){
        return $this->_precio;
    }

    /**
     * Gets the type of the pizza.
     * @return string The type of the pizza.
     */
    public function getTipo(){
        return $this->_tipo;
    }

    /**
     * Gets the quantity of the pizza.
     * @return int The quantity of the pizza.
     */
    public function getCantidad(){
        return $this->_cantidad;
    }

    /**
     * Gets the boolean state that indicates if the pizza have the 
     * same id, and code.
     *
     * @param Pizza $obj The product to compare.
     * @return boolean True if the product have the same id and code, false otherwise.
     */
    public function __Equals($obj):bool{
        if (get_class($obj) == "Pizza" &&
            $obj->getSabor() == $this->getSabor() &&
            $obj->getTipo() == $this->getTipo()) {
            return true;
        }
        return false;
    }

    //--- Methods ---//
    //--- Search Methods ---//

    /**
     * Gets the boolean state that indicates if the product exist in the
     * array of pizzas.
     *
     * @param array $arraypizzas The array of pizzas.
     * @return boolean True if the product exist in the array, false otherwise.
     */
    public function pizzaInArray($arraypizzas):bool{
        if(!empty($arraypizzas)){
            echo "The array isn't empty<br>";
            foreach ($arraypizzas as $pizza) {
                if ($this->__Equals($pizza)) {
                    return true;
                }
            }
        }else{
            echo 'Array Empty<br>';
        }
        return false;
    }

    /**
     * Searchs the pizza in the array of pizzas and prints the result.
     *
     * @param array $array The array of pizzas.
     * @param string $sabor The flavor of the pizza.
     * @param string $tipo The type of the pizza.
     */
    public static function SearchFor($array, $sabor, $tipo){
        $sTipo = false;
        $sSabor = false;
        foreach ($array as $pizza){
            if($pizza->getSabor() == $sabor){
                $sSabor = true;
            }
            if($pizza->getTipo() == $tipo){
                $sTipo = true;
            }
        }

        if($sTipo && $sSabor){
            echo 'Si Hay';
        }else if($sTipo){
            echo 'Solo hay de tipo: '.$tipo;
        }else if($sSabor){
            echo 'Solo hay de sabor: '.$sabor;
        }else{
            echo 'No hay Pizzas '.$tipo.' ni de sabor '.$sabor.'<br>';
        }
    }

    //--- File Handler Methods ---//

    /**
     * Updates the pizza in the array of pizzas if exist.
     * @param Pizza $product The product to update or add.
     * @param string $action The action to do.
     */
    public static function UpdateArray($pizza, $action):bool{
        $filePath = 'Pizza.json';
        $arrayOfpizzas = Pizza::ReadJSON($filePath);
        Pizza::SearchFor($arrayOfpizzas, $pizza->getSabor(), $pizza->getTipo());

        // if not exist in the array, add it
        if ($pizza->pizzaInArray($arrayOfpizzas)) {
            foreach ($arrayOfpizzas as $aPizza) {

                if ($aPizza->__Equals($pizza)) {
                    if($action == "sub"){
                        if($aPizza->getCantidad() >= $pizza->getCantidad()){
                            $aPizza->setCantidad($aPizza->getCantidad() - $pizza->getCantidad());
                            echo  "pizza Sold<br>";
                            return Pizza::SaveToJSON($arrayOfpizzas, $filePath);
                            //return true;
                        }else{
                            echo  "pizza not enough stock<br>";
                        }
                    }
                    break;
                }
            }
        }

        return false;
    }

    /**
     * Reads a file with information of the pizzas.
     * @param string $filename The name of the file to read.
     * @return array The array with the information of the pizzas.
     */
    public static function ReadJSON($filename="Pizza.json"):array{
        $pizzas = array();
        try {
            if (file_exists($filename)) {                  
                $file = fopen($filename, "r");
                if ($file) {
                    $json = fread($file, filesize($filename));
                    $pizzasFromJson = json_decode($json, true);
                    foreach ($pizzasFromJson as $pizza) {
                        array_push($pizzas, new Pizza($pizza["_id"], 
                        $pizza["_sabor"], 
                        $pizza["_precio"], 
                        $pizza["_tipo"], 
                        $pizza["_cantidad"]));
                    }
                }
                fclose($file);
            } 
        }catch (\Throwable $th) {
            echo "Error while reading the file";
        } 
        finally {
            return $pizzas;
        }
    }

    /**
     * Saves the information of the pizzas in a file.
     * @param array $pizzasArray The array of pizzas.
     * @param string $filename The name of the file to save.
     * @return boolean True if the information was saved, false otherwise.
     */
    public static function SaveToJSON($pizzasArray, $filename="Pizza.json"):bool{
        $success = false;
        try {
            $file = fopen($filename, "w");
            if ($file) {
                $json = json_encode($pizzasArray, JSON_PRETTY_PRINT);
                fwrite($file, $json);
                $success = true;
            }
        } catch (\Throwable $th) {
            echo "Error al guardar el archivo";
        } finally {
            fclose($file);
            return $success;
        }
    }
}

?>