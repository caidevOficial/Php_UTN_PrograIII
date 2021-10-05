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

    public function setID($id){
        if (isset($id) && is_numeric($id)){
            $this->_id = $id;
        }
    }

    public function setSabor($sabor){
        if (isset($sabor)){
            $this->_sabor = $sabor;
        }
    }

    public function setPrecio($precio){
        if (!empty($precio) && is_numeric($precio)){
            $this->_precio = $precio;
        }
    }

    public function setTipo($tipo){
        if (isset($tipo)){
            $this->_tipo = $tipo;
        }
    }

    public function setCantidad($cantidad){
        if (!empty($cantidad) && is_numeric($cantidad)){
            $this->_cantidad = $cantidad;
        }
    }

    //--- Getters ---//

    public function getID(){
        return $this->_id;
    }

    public function getSabor(){
        return $this->_sabor;
    }

    public function getPrecio(){
        return $this->_precio;
    }

    public function getTipo(){
        return $this->_tipo;
    }

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

    /**
     * Gets the boolean state that indicates if the product exist in the
     * array of pizzas.
     *
     * @param array $arraypizzas The array of pizzas.
     * @return boolean True if the product exist in the array, false otherwise.
     */
    public function pizzaInArray($arraypizzas):bool{
        if(!empty($arraypizzas)){
            echo 'No esta vacio';
            foreach ($arraypizzas as $pizza) {
                if ($this->__Equals($pizza)) {
                    return true;
                }
            }
        }else{
            echo 'Esta vacio';
        }
        return false;
    }

    /**
     * Updates the pizza in the array of pizzas if exist.
     * If not exist, it will be added.
     *
     * @param array $arrayOfpizzas The array of pizzas.
     * @param Pizza $product The product to update or add.
     * @return array The array of pizzas with the product updated or added.
     */
    public static function UpdateArray($pizza, $action):string{
        $message = '';
        $arrayOfpizzas = Pizza::ReadJSON();
        
        // if not exist in the array, add it
        if (!$pizza->pizzaInArray($arrayOfpizzas)) {
            if ($action == "add") {
                array_push($arrayOfpizzas, $pizza);
                echo "pizza not in existence, added.";
            }
        }else{
            foreach ($arrayOfpizzas as $aPizza) {
                // if exist in the array, update it
                if ($aPizza->__Equals($pizza)) {
                    if($action == "add"){
                        $aPizza->setCantidad($aPizza->getCantidad() + $pizza->getCantidad());
                        $aPizza->setPrecio($pizza->getPrecio());
                        $message =  "pizza updated.";
                        // if exist and the action is sub, substract it
                    }else if($action == "sub"){
                        if($aPizza->getCantidad() >= $pizza->getCantidad()){
                            $aPizza->setCantidad($aPizza->getCantidad() - $pizza->getCantidad());
                            $message =  "pizza Sold";
                        }else{
                            $message =  "pizza not enough stock";
                        }
                    }
                    break;
                }
            }
        }

        Pizza::SaveToJSON($arrayOfpizzas);

        return $message;
    }

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
        }else{
            echo 'Solo hay de sabor: '.$sabor;
        }
    }

    /**
     * Reads a file with information of the pizzas.
     *
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