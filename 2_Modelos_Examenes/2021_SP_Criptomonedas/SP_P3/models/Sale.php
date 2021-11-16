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

require_once './db/DataAccess.php';

class Sale {

    public $id;
    public $date;
    public $crypto_name;
    public $amount;
    public $customer;
    public $user;
    public $image;

    public function __construct() {}

     public static function createEntity($date, $crypto_name, $amount, $customer, $user) {
        $sale = new Sale();
        $sale->setDate($date);
        $sale->setCryptoName($crypto_name);
        $sale->setAmount($amount);
        $sale->setCustomer($customer);
        $sale->setUser($user);

        return $sale;
     }

    //--- Getters ---//

    /**
     * Gets the id of the Entity.
     *
     * @return int The id of the Entity.
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Gets the date of the Entity.
     *
     * @return date The date of the Entity.
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Gets the name of the Crypto of the Entity.
     *
     * @return string The name of the Crypto of the Entity.
     */
    public function getCryptoName() {
        return $this->crypto_name;
    }

    /**
     * Gets the amount of the Entity.
     *
     * @return float The amount of the Entity.
     */
    public function getAmount() {
        return $this->amount;
    }

    /**
     * Gets the customer of the Entity.
     *
     * @return string The customer of the Entity.
     */
    public function getCustomer() {
        return $this->customer;
    }

    /**
     * Gets the user of the Entity.
     *
     * @return string The user of the Entity.
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * Gets the image of the Entity.
     *
     * @return string The image of the Entity.
     */
    public function getImage() {
        return $this->image;
    }

    //--- Setters ---//

    /**
     * Sets the id of the Entity.
     *
     * @param int $id The id of the Entity.
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * Sets the date of the Entity.
     *
     * @param date $date The date of the Entity.
     */
    public function setDate($date) {
        $this->date = $date;
    }

    /**
     * Sets the name of the Crypto of the Entity.
     *
     * @param string $crypto_name The name of the Crypto of the Entity.
     */
    public function setCryptoName($crypto_name) {
        $this->crypto_name = $crypto_name;
    }

    /**
     * Sets the amount of the Entity.
     *
     * @param float $amount The amount of the Entity.
     */
    public function setAmount($amount) {
        $this->amount = $amount;
    }

    /**
     * Sets the customer of the Entity.
     *
     * @param string $customer The customer of the Entity.
     */
    public function setCustomer($customer) {
        $this->customer = $customer;
    }

    /**
     * Sets the user of the Entity.
     *
     * @param string $user The user of the Entity.
     */
    public function setUser($user) {
        $this->user = $user;
    }

    /**
     * Sets the image of the Entity.
     *
     * @param string $image The image of the Entity.
     */
    public function setImage($image) {
        $this->image = $image;
    }

    public function replaceDate(){
        $date = str_replace(" ", "__", (string)$this->getDate());
        $date = str_replace(":", "_", $date);
        return $date;
    }

    /**
     * Prints the info of the query as a table.
     * @param array $listObjects Array of the objects.
     */
    public static function printDataAsTable($listObjects){
        echo "<table border='2'>";
        echo '<caption>Sales List</caption>';
        echo "<th>[ID]</th><th>[DATE]</th><th>[CRYPTO]</th><th>[AMOUNT]</th><th>[CUSTOMER]</th><th>[USER]</th><th>[IMAGE]</th>";
        foreach($listObjects as $object){
            echo "<tr align='center'>";
            echo "<td>[".$object->getId()."]</td>";
            echo "<td>[".$object->getDate()."]</td>";
            echo "<td>[".$object->getCryptoName()."]</td>";
            echo "<td>[".$object->getAmount()."]</td>";
            echo "<td>[".$object->getCustomer()."]</td>";
            echo "<td>[".$object->getUser()."]</td>";
            echo "<td>[".$object->getImage()."]</td>";
            echo "</tr>";
        }
        echo "</table>" ;
    }

    /**
     * Prints the info of the query as a table.
     */
    public function printSingleEntityAsTable(){
        echo "<table border='2'>";
        echo '<caption>Sales List</caption>';
        echo "<th>[ID]</th><th>[DATE]</th><th>[CRYPTO]</th><th>[AMOUNT]</th><th>[CUSTOMER]</th><th>[USER]</th><th>[IMAGE]</th>";
        echo "<tr align='center'>";
        echo "<td>[".$this->getId()."]</td>";
        echo "<td>[".$this->getDate()."]</td>";
        echo "<td>[".$this->getCryptoName()."]</td>";
        echo "<td>[".$this->getAmount()."]</td>";
        echo "<td>[".$this->getCustomer()."]</td>";
        echo "<td>[".$this->getUser()."]</td>";
        echo "<td>[".$this->getImage()."]</td>";
        echo "</tr>";
        echo "</table>" ;
    }

    //--- PDO Methods ---//

    /**
     * Inserts an entity.
     * @return int The id of the inserted entity.
     */
    public static function insertEntity($entity){
        $objDataAccess = DataAccess::getInstance();
        $sql = "INSERT INTO `sales` (date, crypto_name, amount, customer, user, image) 
        VALUES (:date, :crypto_name, :amount, :customer, :user, :image)";
        $query = $objDataAccess->prepareQuery($sql);
        $query->bindParam(':date', $entity->getDate());
        $query->bindParam(':crypto_name', $entity->getCryptoName());
        $query->bindParam(':amount', $entity->getAmount());
        $query->bindParam(':customer', $entity->getCustomer());
        $query->bindParam(':user', $entity->getUser());
        $query->bindParam(':image', $entity->getImage());
        $query->execute();

        return $objDataAccess->getLastInsertedId();
    }

    /**
     * Updates an entity.
     * @return int The number of rows affected.
     */
    public static function updateEntity($entity){
        $objDataAccess = DataAccess::getInstance();
        $sql = "UPDATE `sales` 
        SET date = :date, crypto_name = :crypto_name, amount = :amount, customer = :customer, user = :user, image = :image 
        WHERE id = :id";
        $query = $objDataAccess->prepareQuery($sql);
        $query->bindParam(':id', $entity->getId());
        $query->bindParam(':date', $entity->getDate());
        $query->bindParam(':crypto_name', $entity->getCryptoName());
        $query->bindParam(':amount', $entity->getAmount());
        $query->bindParam(':customer', $entity->getCustomer());
        $query->bindParam(':user', $entity->getUser());
        $query->bindParam(':image', $entity->getImage());
        $query->execute();

        return $query->rowCount();
    }

    /**
     * Deletes an entity.
     * @return int The number of rows affected.
     */
    public static function deleteEntity($entity){
        $objDataAccess = DataAccess::getInstance();
        $sql = "DELETE FROM `sales` WHERE id = :id";
        $query = $objDataAccess->prepareQuery($sql);
        $query->bindParam(':id', $entity->getId());
        $query->execute();

        return $query->rowCount();
    }

    /**
     * Gets an entity by id.
     * @return Sale The entity.
     */
    public static function getEntityById($id){
        $objDataAccess = DataAccess::getInstance();
        $sql = "SELECT * FROM `sales` WHERE id = :id";
        $query = $objDataAccess->prepareQuery($sql);
        $query->bindParam(':id', $id);
        $query->execute();

        $entity = $query->fetchObject('Sale');
        if(is_null($entity)){
            throw new Exception("The entity doesn't exist.");
        }
        
        return $entity;
    }

    public static function getAllEntities(){
        $objDataAccess = DataAccess::getInstance();
        $sql = "SELECT * FROM `sales`";
        $query = $objDataAccess->prepareQuery($sql);
        $query->execute();

        $entities = $query->fetchAll(PDO::FETCH_CLASS, 'Sale');
        return $entities;
    }

    public static function getEntitiesByCountryBetween($country, $start, $end){
        $objDataAccess = DataAccess::getInstance();
        $sql = "SELECT s.id, s.date, s.crypto_name, s.amount, s.customer, s.user, s.image FROM `sales` AS s
        INNER JOIN `currencies` AS c
        ON c.origin = :country AND s.crypto_name = c.name
        WHERE s.date BETWEEN :dateFrom AND :dateTo;";
        $query = $objDataAccess->prepareQuery($sql);
        $query->bindParam(':country', $country);
        $query->bindParam(':dateFrom', $start);
        $query->bindParam(':dateTo', $end);
        $query->execute();

        $entities = $query->fetchAll(PDO::FETCH_CLASS, 'Sale');
        return $entities;
    }

}