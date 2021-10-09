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

class Product{

    //--- ATTRIBUTES ---//
     public $_id;
     public $_code;
     public $_name;
     public $_type;
     public $_stock;
     public $_price;
 
     //--- CONSTRUCTOR ---//
    public function __construct($id, $code, $stock, $name="None", $type="None", $price="10"){
        $this->setId($id);
        $this->setCode($code);
        $this->setName($name);
        $this->setType($type);
        $this->setStock($stock);
        $this->setPrice($price);
    }

     //--- GETTERS ---//

    /**
     * Gets the value of id of the product.
    *
    * @return int the id of the product.
    */
    public function getId(){
        return $this->_id;
    }

     /**
      * Gets the barCode of the product.
      *
      * @return string The barCode of the product.
      */
     public function getCode(){
         return $this->_code;
     }

     /**
      * Gets the name of the product.
      *
      * @return string The name of the product.
      */
     public function getName(){
         return $this->_name;
     }

     /**
      * Gets the type of the product.
      *
      * @return string The type of the product.
      */
    public function getType(){
        return $this->_type;
    }

    /**
     * Gets the stock of the product.
     *
     * @return int The stock of the product.
     */
    public function getStock(){
        return $this->_stock;
    }

    /**
     * Gets the price of the product.
     *
     * @return double The price of the product.
     */
    public function getPrice(){
        return $this->_price;
    }

    //--- SETTERS ---//

    /**
     * Sets the value of id of the product.
     *
     * @param int $id the id of the product.
     */
    public function setId($id){
        if (is_numeric($id)) {
            $this->_id = $id;
        }
    }

    /**
     * Sets the barCode of the product.
     *
     * @param string $code The barCode of the product.
     */
    public function setCode($code){
        if (!empty($code) && is_string($code) && strlen($code) < 7){
            $this->_code = $code;
        }
    }

    /**
     * Sets the name of the product.
     *
     * @param string $name The name of the product.
     */
    public function setName($name){
        if (!empty($name)) {
            $this->_name = $name;
        }
    }

    /**
     * Sets the type of the product.
     *
     * @param string $type The type of the product.
     */
    public function setType($type){
        if (!empty($type)) {
            $this->_type = $type;
        }
    }

    /**
     * Sets the stock of the product.
     *
     * @param int $stock The stock of the product.
     */
    public function setStock($stock){
        if (!empty($stock) && is_numeric($stock)) {
            $this->_stock = $stock;
        }
    }

    /**
     * Sets the price of the product.
     *
     * @param double $price The price of the product.
     */
    public function setPrice($price){
        if (!empty($price) && is_numeric($price)) {
            $this->_price = $price;
        }
    }

    //--- METHODS ---//
    
    /**
     * Gets the boolean state that indicates if the product have the 
     * same id, and code.
     *
     * @param Product $obj The product to compare.
     * @return boolean True if the product have the same id and code, false otherwise.
     */
    public function __Equals($obj):bool{
        if (get_class($obj) == "Product" &&
            $obj->getId() == $this->getId() &&
            $obj->getCode() == $this->getCode()) {
            return true;
        }
        return false;
    }

    /**
     * Gets the boolean state that indicates if the product exist in the
     * array of products.
     *
     * @param array $arrayProducts The array of products.
     * @return boolean True if the product exist in the array, false otherwise.
     */
    public function ProductInArray($arrayProducts):bool{
        foreach ($arrayProducts as $product) {
            if ($this->__Equals($product)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Updates the product in the array of products if exist.
     * If not exist, it will be added.
     *
     * @param array $arrayOfProducts The array of products.
     * @param Product $product The product to update or add.
     * @return array The array of products with the product updated or added.
     */
    public static function UpdateArray($arrayOfProducts, $product, $action):array{
        
        if (!$product->ProductInArray($arrayOfProducts)) {
            if ($action == "add") {
                array_push($arrayOfProducts, $product);
                echo "Product not in existence, added.";
            }else if ($action == "sub") {
                echo "Product not sold";
            }
        }else{
            foreach ($arrayOfProducts as $aProduct) {
                if ($aProduct->__Equals($product)) {
                    if($action == "add"){
                        $aProduct->setStock("".$aProduct->getStock() + $product->getStock()."");
                        echo "Product updated.";
                    }else if($action == "sub"){
                        if($aProduct->getStock() >= $product->getStock()){
                            $aProduct->setStock("".$aProduct->getStock() - $product->getStock()."");
                        echo "Product Sold";
                        }else{
                            echo "Product not enough stock";
                        }
                    }
                    break;
                }
            }
        }
        return $arrayOfProducts;
    }

    /**
     * Reads a file with information of the products.
     *
     * @param string $filename The name of the file to read.
     * @return array The array with the information of the products.
     */
    public static function ReadJSON($filename="Products.json"):array{
        $products = array();
        try {
            if (file_exists($filename)) {                  
                $file = fopen($filename, "r");
                if ($file) {
                    $json = fread($file, filesize($filename));
                    $productsFromJson = json_decode($json, true);
                    foreach ($productsFromJson as $product) {
                        array_push($products, new Product($product["_id"], $product["_code"], $product["_stock"], $product["_name"], $product["_type"], $product["_price"]));
                    }
                }
                fclose($file);
            } 
        }catch (\Throwable $th) {
            echo "Error while reading the file";
        } 
        finally {
            return $products;
        }
    }

    public static function SaveToJSON($productsArray, $filename="Products.json"):bool{
        $success = false;
        try {
            $file = fopen($filename, "w");
            if ($file) {
                //var_dump($productsArray);
                $json = json_encode($productsArray, JSON_PRETTY_PRINT);
                //echo $json . '<br>';
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