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

require_once 'Venta.php';
require_once 'Pizza.php';

class Coupon{

    //--- Attributes ---//
    public $_idCoupon;
    public $_user;
    public $_isUsed;
    public $_discount;
    public $_priceFinal;

    //--- Constructor ---//

    /**
     * Coupon constructor.
     */
    public function __construct(){}

    //--- Getters ---//

    /**
     * Gets the id of the coupon.
     * @return int The id of the coupon.
     */
    public function getIdCoupon(){
        return $this->_idCoupon;
    }

    /**
     * Gets the user of the coupon.
     * @return User The user of the coupon.
     */
    public function getUser(){
        return $this->_user;
    }

    /**
     * Gets the status of the coupon.
     * @return bool The status of the coupon.
     */
    public function getIsUsed(){
        return $this->_isUsed;
    }

    /**
     * Gets the discount of the coupon.
     * @return int The discount of the coupon.
     */
    public function getDiscount(){
        return $this->_discount;
    }

    /**
     * Gets the price final of the coupon.
     * @return int The price final of the coupon.
     */
    public function getPriceFinal(){
        return $this->_priceFinal;
    }

    //--- Setters ---//

    /**
     * Sets the id of the coupon.
     * @param int $idCoupon The id of the coupon.
     */
    public function setIdCoupon($idCoupon){
        if (is_int($idCoupon)) {
            $this->_idCoupon = $idCoupon;
        }
    }

    /**
     * Sets the user of the coupon.
     * @param User $user The user of the coupon.
     */
    public function setUser($user){
        if (is_string($user)) {
            $this->_user = $user;
        }
    }

    /**
     * Sets the status of the coupon.
     * @param bool $isUsed The status of the coupon.
     */
    public function setIsUsed($isUsed){
        if (is_bool($isUsed)) {
            $this->_isUsed = $isUsed;
        }
    }

    /**
     * Sets the discount of the coupon.
     * @param int $discount The discount of the coupon.
     */
    public function setDiscount($discount){
        if (is_int($discount)) {
            $this->_discount = $discount;
        }
    }

    /**
     * Sets the price final of the coupon.
     * @param int $priceFinal The price final of the coupon.
     */
    public function setPriceFinal($priceFinal){
        if (is_numeric($priceFinal)) {
            $this->_priceFinal = $priceFinal;
        }
    }

    //--- Methods ---//

    /**
     * Creates a coupon like a builder.
     * @param int $id The id of the coupon.
     * @param string $user The user of the coupon.
     * @param int $discount The discount of the coupon.
     * @param bool $isUsed The status of the coupon.
     * @param float $priceFinal The price final of the coupon.
     * @return Coupon The coupon created.
     */
    public static function CreateCoupon($id, $user, $discount, $isUsed, $priceFinal){
        $return = new Coupon();
        $return->setIdCoupon(intval($id));
        $return->setUser($user);
        $return->setDiscount(intval($discount));
        $return->setIsUsed(boolval($isUsed));
        $return->setPriceFinal(floatval($priceFinal));

        return $return;
    }

    /**
     * Searchs if the coupon is unused and updates the coupon to used
     *
     * @param [type] $newSale
     * @return boolean
     */
    public static function SearchCouponForNewSale($newSale):bool{
        $coupons = Coupon::readJson("Cupones.json");
        $pizzas = Pizza::readJson("Pizza.json");
        foreach($coupons as $coupon){
            if($coupon->getUser() == $newSale->getUserEmail() && !$coupon->getisUsed()){
                $coupon->setIsUsed(true);
                $coupon->searchAndUpdateFinalPrice($pizzas, $newSale);
                // Actualizar archivo
                return Coupon::writeJson($coupons, "Update");
            }

        }

        return false;
    }

    /**
     * Searchs if the coupon is unused and updates the price of the sale.
     * @param array $arrayObjects Array of pizzas to iterate and search it price.
     * @param Venta $newSale Sale to check the amount of pizzas and update the price of the coupon if exist.
     * @return bool True if the coupon was updated, false if not.
     */
    private function searchAndUpdateFinalPrice($arrayObjects, $newSale){
        foreach($arrayObjects as $pizza){
            if($pizza->getFlavor() == $newSale->getFlavor() 
            && $pizza->getType() == $newSale->getType()){
                $this->updateFinalPrice($pizza, $newSale);
                return self::updateFile($this, 'Update');
            }
        }
    }

    /**
     * Updates the price of the coupon.
     * @param Pizza $pizza Pizza to get the price.
     */
    private function updateFinalPrice($pizza, $newSale){
        $fullPrice = $pizza->getPrice() * $newSale->getAmount();
        $onlyDiscount = ($fullPrice * $this->getDiscount()) / 100;
        $this->_priceFinal = floatval($fullPrice - $onlyDiscount);
    }

    /**
     * Reads the json file and gets the next free id.
     * @return int Next free id.
     */
    private static function getNextId(){
        $coupons = Coupon::readJson("Cupones.json");
        $maxId = 0;
        foreach($coupons as $coupon){
            if($coupon->getIdCoupon() > $maxId){
                $maxId = $coupon->getIdCoupon();
            }
        }
        return $maxId + 1;
    }

    /**
     * Reads the json file and gets an array of 'Cupones'.
     * @param string $fileName Name of the json file.
     * @return array Array of 'Cupones'.
     */
    public static function readJson($filename = 'Cupones.json'){
        $arrayObjects = array();
        if (file_exists($filename)) {
            $file = fopen($filename, 'r');
            try{
                $json = fread($file, filesize($filename));
                $array = json_decode($json, true);
                foreach ($array as $newObject) {
                        $myObject = Coupon::CreateCoupon(
                            $newObject['_idCoupon'],
                            $newObject['_user'],
                            $newObject['_discount'],
                            $newObject['_isUsed'],
                            $newObject['_priceFinal']
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
     * Writes the json file with the array of 'Cupones'.
     * @param array $arrayObjects Array of 'Cupones'.
     * @param string $fileName Name of the json file.
     * @return bool True if the file was written, false if not.
     */
    public static function writeJson($arrayObjects, $filename = 'Cupones.json'):bool{
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
     * Updates the json file with the array of 'Cupones' updating 
     * the price and boolean state that indicates if was used or not.
     * @param Coupon $newObject Coupon to update.
     * @param string $action Action to do [Add or Update].
     * @return boolean True if the file was updated, false if not.
     */
    public static function updateFile($newObject, $action):bool{
        $filename = 'Cupones.json';
        $arrayObjects = self::readJson($filename);
        if (!$newObject->isInArray($arrayObjects)) {
            if ($action == 'Add') {
                echo '<h3>Nuevo Cupon Cargado.</h3><br>';
                array_push($arrayObjects, $newObject);
                return self::writeJson($arrayObjects, $filename);
            }
        }else{
            foreach ($arrayObjects as $fileObject) {
                if ($action == 'Update') {
                    if ($newObject->__Equals($fileObject)) {
                        echo '<h3>Cupon encontrado, Se actualizara.</h3><br>';
                        $fileObject->setPriceFinal($newObject->getPriceFinal());
                        $fileObject->setIsUsed($newObject->getIsUsed());
                        return self::writeJson($arrayObjects, $filename);
                    }
                }
            }
        }

        return false;
    }

    /**
     * Checks if the actual object if equal to the passed by parameter, bassed in its id.
     * @param Coupon $object Object to compare.
     * @return boolean True if the objects are equal, false if not.
     */
    private function __Equals($object){
        return $this->getIdCoupon() == $object->getIdCoupon();
    }

    /**
     * Checks if the actual object is in the array of objects.
     * @param array $array Array of objects to search.
     * @return boolean True if the object is in the array, false if not.
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
     * Gets a coupon by its id.
     * @param int $idCoupon Id of the coupon to get.
     * @return Coupon Coupon to get.
     */
    public static function getCouponByID($id, $arrayCoupons){
        foreach($arrayCoupons as $coupon){
            if($coupon->getIdCoupon() == $id){
                return $coupon;
            }
        }
    }

    public function printCouponAsATableContent(){
        echo "<td>[".$this->_idCoupon."]</td>";
            if($this->getIsUsed()){
                echo "<td>[Usado]</td>";
            }else{
                echo "<td>[No Usado]</td>";
            }
    }

    /**
     * Prints an array of coupons as a table.
     * @param array $arrayCoupons arrayCoupons of coupons to print.
     */
    public static function printCouponsAsTable($arrayCoupons){
        echo "<table>";
        echo "<th>[ID_Coupon]</th><th>[Used Status]</th>";
        foreach($arrayCoupons as $coupon){
            echo "<tr align='center'>";
            $coupon->printCouponAsATableContent();
            echo "</tr>";
        }
        echo "</table>" ;
    }
}
?>