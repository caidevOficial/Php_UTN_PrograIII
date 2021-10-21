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

/**
 * Class Pizza
 * 
 * @author Facundo Falcone <CaidevOficial>
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/ GNU GPLv3
 */
class Pizza{

    //--- ATTRIBUTES ---//
    public $_id;
    public $_flavor;
    public $_type;
    public $_price;
    public $_amount;

    //--- CONSTRUCTOR ---//
    public function __construct(){}

    //--- GETTERS ---//
    
    /**
     * Get the id of the product.
     * @return int The id of the product.
     */
    public function getId(){
        return $this->_id;
    }

    /**
     * Get the flavor of the Pizza.
     * @return string The flavor of the Pizza.
     */
    public function getFlavor(){
        return $this->_flavor;
    }

    /**
     * Get the type of the Pizza.
     * @return string The type of the Pizza ['Piedra' or 'Molde'].
     */
    public function getType(){
        return $this->_type;
    }

    /**
     * Get the gross price of the Pizza.
     * @return float The gross price of the Pizza.
     */
    public function getPrice(){
        return $this->_price;
    }

    /**
     * Get the amount of Pizza.
     * @return int The amount of Pizza.
     */
    public function getAmount(){
        return $this->_amount;
    }

    //--- SETTERS ---//

    /**
     * Set the id of the product.
     * @param int $id The id of the product.
     */
    public function setId($id){
        if (is_int($id)) {
            $this->_id = $id;
        }
    }

    /**
     * Set the flavor of the Pizza.
     * @param string $flavor The flavor of the Pizza to set.
     */
    public function setFlavor($flavor){
        if(isset($flavor) && is_string($flavor)){
            $this->_flavor = $flavor;
        }
    }

    /**
     * Set the type of the Pizza.
     * @param string $type The type of the object to set ['Piedra' or 'Molde']. Default is 'Piedra'.
     */
    public function setType($type='Piedra'){
        if(isset($type) && is_string($type) && ($type == 'Piedra' || $type == 'Molde')){
            $this->_type = $type;
        }
    }

    /**
     * Set the gross price of the object.
     * @param float $grossPrice The price of the Pizza to set.
     */
    public function setPrice($price){
        if(isset($price) && is_numeric($price)){
            $this->_price = abs($price);
        }
    }

    /**
     * Set the amount of Pizza.
     * @param int $amount The amount of Pizza to set.
     */
    public function setAmount($amount){
        if(isset($amount) && is_numeric($amount)){
            $this->_amount = $amount;
        }
    }

    //--- METHODS ---//

    /**
     * Creates a instance of the Pizza class and sets the attributes.
     *
     * @param string $flavor The flavor of the Pizza.
     * @param string $type The type of the Pizza [Piedra or Molde].
     * @param float $grossPrice The gross price of the Pizza.
     * @param int $amount The amount of Pizza.
     * @return Pizza The instance of the Pizza class.
     */
    public static function createPizza($id, $flavor, $type, $grossPrice, $amount){
        $newObject = new Pizza();
        $newObject->setId(intval($id));
        $newObject->setFlavor($flavor);
        $newObject->setType($type);
        $newObject->setPrice(floatval($grossPrice));
        $newObject->setAmount(intval($amount));
        return $newObject;
    }

    //--- VALIDATE METHODS ---//

    /** 
     * Checks if the Pizza's flavor & type are the same.
     * @param Pizza $obj The Pizza to compare.
     * @return bool True if the Pizza is of type 'Pizza' and if the flavor & type are the same.
    */
    public function __Equals($obj){
        if(isset($obj) && is_a($obj, 'Pizza')){
            if($this->getFlavor() == $obj->getFlavor() && $this->getType() == $obj->getType()){
                return true;
            }
        }
        return false;
    }

    /**
     * Checks if the object is in the array or not.
     * @param array $array The array to check.
     * @return bool True if the object is in the array, false otherwise.
    */
    public function isInArray($array){
        if(isset($array) && is_array($array)){
            foreach($array as $newObject){
                if($this->__Equals($newObject)){
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Checks if the array have an object of type '$type' and flavor '$flavor'.
     * @param array $array The array to check.
     * @param string $flavor The flavor of the Pizza.
     * @param string $type The type of the Pizza.
     * @return string The message with the result of the check.
     */
    public static function SearchFor($array, $flavor, $type){
        $message =  '';
        $both = false;
        $sType = false;
        $sFlavor = false;
        foreach ($array as $object){
            if($object->getFlavor() == $flavor && $object->getType() == $type){
                $both = true;
            }
            else if($object->getType() == $type){
                $sType = true;
            }else if($object->getFlavor() == $flavor){
                $sFlavor = true;
            }
        }

        if($both){
            $message =  '<h3>Si Hay</h3><br>';
        }else if($sType || $sFlavor){
            $message =  '<h3>No Hay Esa Combinacion.</h3><br>';
            if ($sType) {
                $message .=  '<h3>Hay de tipo: '.$type.'</h3><br>';
            }
            if ($sFlavor) {
                $message .=  '<h3>Hay de sabor: '.$flavor.'</h3><br>';
            }
        }else{
            $message =  '<h3>No hay de tipo '.$type.' ni de sabor '.$flavor.'</h3><br>';
        }

        return $message;
    }

    /**
     * Prints the info of the query as a table.
     * @param Pizza $product Product to show as a table..
     */
    public static function printSingleProductAsTable($product){
        echo "<table>";
        echo "<th>[ID]</th><th>[Sabor]</th><th>[Tipo]</th><th>[Precio]</th><th>[Cantidad]</th>";
        echo "<tr align='center'>";
        echo "<td>[".$product->getId()."]</td>";
        echo "<td>[".$product->getFlavor()."]</td>";
        echo "<td>[".$product->getType()."]</td>";
        echo "<td>[".$product->getPrice()."]</td>";
        echo "<td>[".$product->getAmount()."]</td>";
        echo "</tr>";
        echo "</table>" ;
    }

    //--- FILE HANDLE METHODS ---//

    /**
     * Opens a JSON file and returns the array of Pizzas or 
     * an empty array if the file doesn't exist.
     * @param string $filename The name of the file to open.
     * @return array The array of Pizzas.
     */
    public static function readJson($filename = 'Pizza.json'){
        $arrayObjects = array();
        if (file_exists($filename)) {
            $file = fopen($filename, 'r');
            try{
                $json = fread($file, filesize($filename));
                $array = json_decode($json, true);
                foreach ($array as $newObject) {
                    $myObject = Pizza::createPizza(
                        intval($newObject['_id']),
                        $newObject['_flavor'],
                        $newObject['_type'],
                        floatval($newObject['_price']),
                        intval($newObject['_amount'])
                    );
                    array_push($arrayObjects, $myObject);
                }
            }catch(\Throwable $e){
                echo $e->getMessage();
            }finally{
                fclose($file);
            }
        }

        return $arrayObjects;
    }

    /**
     * Writes the Pizza to a JSON file.
     * @param string $filename The name of the file to write.
     * @param array $arrayObjects The array of Pizzas to write.
     * @return bool True if the file was written, false otherwise.
     */
    public static function writeJson($arrayObjects, $filename = 'Pizza.json'):bool{
        $success = false;
        try{
            $file = fopen($filename, 'w');
            $json = json_encode($arrayObjects, JSON_PRETTY_PRINT);
            fwrite($file, $json);
            
            $success = true;
        }catch(\Throwable $e){
            echo $e->getMessage();
        }finally{
            fclose($file);
            return $success;
        }
    }

    /**
     * Updates the Json File with the new Object, if exist it will replace it price and amount.
     * @param Pizza $newObject The new Pizza to update.
     * @param string $action The action to do [add, sub].
     * @return bool True if the file was updated, false otherwise.
     */
    public static function updateFile($newObject, $action):bool{
        $arrayObjects = self::readJson();
        if (!$newObject->isInArray($arrayObjects)) {
            if ($action == 'add') {
                echo '<h3>El objeto aun no existe, Agregado.</h3><br>';
                array_push($arrayObjects, $newObject);
                return self::writeJson($arrayObjects);
            }
        }else{
            foreach ($arrayObjects as $fileObject) {
                if ($action == 'add') {
                    if ($newObject->__Equals($fileObject)) {
                        echo '<h3>El objeto ya existe en el archivo, Se actualizara.</h3><br>';
                        $fileObject->setAmount($fileObject->getAmount() + $newObject->getAmount());
                        $fileObject->setGrossPrice($newObject->getPrice());
                        $fileObject->calculateFinalPrice();
                        return self::writeJson($arrayObjects);
                    }
                } elseif ($action == 'sub') {
                    if ($newObject->__Equals($fileObject) &&
                        $newObject->getAmount() <= $fileObject->getAmount()) {
                        echo '<h3>Aun hay stock, Se descontaran '.$newObject->getAmount().' unidades</h3><br>';
                        $fileObject->setAmount($fileObject->getAmount() - $newObject->getAmount());
                        return self::writeJson($arrayObjects);
                    }
                }
            }
        }
    }
}

?>