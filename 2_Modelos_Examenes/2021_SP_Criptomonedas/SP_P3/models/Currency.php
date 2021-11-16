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

class Currency{

    public $id;
    public $name;
    public $image;
    public $origin;
    public $price;

    public function __construct(){}

    /**
     * Creates a entity.
     *
     * @param string $name Name of the currency.
     * @param string $image Image of the currency.
     * @param string $origin Origin of the currency.
     * @param float $price Price of the currency.
     * @return Currency The created entity.
     */
    public static function createEntity($name, $image, $origin, $price){
        $currency = new Currency();
        $currency->setName($name);
        $currency->setImage($image);
        $currency->setOrigin($origin);
        $currency->setPrice($price);
        return $currency;
    }

    //--- Getters ---//

    /**
     * Gets the id of the entity.
     *
     * @return int The id of the entity.
     */
    public function getId(){
        return $this->id;
    }

    /**
     * Gets the name of the entity.
     *
     * @return string The name of the entity.
     */
    public function getName(){
        return $this->name;
    }

    /**
     * Gets the image of the entity.
     *
     * @return string The image of the entity.
     */
    public function getImage(){
        return $this->image;
    }

    /**
     * Gets the origin of the entity.
     *
     * @return string The origin of the entity.
     */
    public function getOrigin(){
        return $this->origin;
    }

    /**
     * Gets the price of the entity.
     *
     * @return float The price of the entity.
     */
    public function getPrice(){
        return $this->price;
    }

    //--- Setters ---//

    /**
     * Sets the id of the entity.
     *
     * @param int $id The id of the entity.
     */
    public function setId($id){
        $this->id = $id;
    }

    /**
     * Sets the name of the entity.
     *
     * @param string $name The name of the entity.
     */
    public function setName($name){
        $this->name = $name;
    }

    /**
     * Sets the image of the entity.
     *
     * @param string $image The image of the entity.
     */
    public function setImage($image){
        $this->image = $image;
    }

    /**
     * Sets the origin of the entity.
     *
     * @param string $origin The origin of the entity.
     */
    public function setOrigin($origin){
        $this->origin = $origin;
    }

    /**
     * Sets the price of the entity.
     *
     * @param float $price The price of the entity.
     */
    public function setPrice($price){
        $this->price = $price;
    }

    //--- Methods ---//

    /**
     * Prints the info of the query as a table.
     * @param array $listObjects Array of the objects.
     */
    public static function printDataAsTable($listObjects){
        echo "<table border='2'>";
        echo '<caption>Cryptocurrencies List</caption>';
        echo "<th>[ID]</th><th>[NAME]</th><th>[IMAGE]</th><th>[ORIGIN]</th><th>[PRICE]</th>";
        foreach($listObjects as $object){
            echo "<tr align='center'>";
            echo "<td>[".$object->getId()."]</td>";
            echo "<td>[".$object->getName()."]</td>";
            echo "<td>[".$object->getImage()."]</td>";
            echo "<td>[".$object->getOrigin()."]</td>";
            echo "<td>[".$object->getPrice()."]</td>";
            echo "</tr>";
        }
        echo "</table>" ;
    }

    /**
     * Prints the info of the query as a table.
     */
    public function printSingleEntityAsTable(){
        echo "<table border='2'>";
        echo '<caption>Cryptocurrencies List</caption>';
        echo "<th>[ID]</th><th>[NAME]</th><th>[IMAGE]</th><th>[ORIGIN]</th><th>[PRICE]</th>";
        echo "<tr align='center'>";
        echo "<td>[".$this->getId()."]</td>";
        echo "<td>[".$this->getName()."]</td>";
        echo "<td>[".$this->getImage()."]</td>";
        echo "<td>[".$this->getOrigin()."]</td>";
        echo "<td>[".$this->getPrice()."]</td>";
        echo "</tr>";
        echo "</table>" ;
    }

    /**
     * Inserts an entity.
     * @return int The id of the inserted entity.
     */
    public static function insertEntity($entity){
        $objDataAccess = DataAccess::getInstance();
        $sql = "INSERT INTO `currencies` (`name`, `image`, `origin`, `price`) VALUES (:name, :image, :origin, :price)";
        $query = $objDataAccess->prepareQuery($sql);
        $query->bindParam(':name', $entity->getName());
        $query->bindParam(':image', $entity->getImage());
        $query->bindParam(':origin', $entity->getOrigin());
        $query->bindParam(':price', $entity->getPrice());
        $query->execute();

        return $objDataAccess->getLastInsertedId();
    }

    /**
     * Updates an entity.
     * @return int The number of rows affected.
     */
    public static function updateEntity($entity){
        $objDataAccess = DataAccess::getInstance();
        $sql = "UPDATE `currencies` 
        SET `name` = :name, `image` = :image, `origin` = :origin, `price` = :price 
        WHERE `id` = :id";
        $query = $objDataAccess->prepareQuery($sql);
        $query->bindParam(':id', $entity->getId());
        $query->bindParam(':name', $entity->getName());
        $query->bindParam(':image', $entity->getImage());
        $query->bindParam(':origin', $entity->getOrigin());
        $query->bindParam(':price', $entity->getPrice());
        $query->execute();

        return $query->rowCount();
    }

    /**
     * Deletes an entity.
     * @return int The number of rows affected.
     */
    public static function deleteEntity($entity){
        $objDataAccess = DataAccess::getInstance();
        $sql = "DELETE FROM `currencies` WHERE `id` = :id";
        $query = $objDataAccess->prepareQuery($sql);
        $query->bindParam(':id', $entity->getId());
        $query->execute();

        return $query->rowCount();
    }

    /**
     * Gets an entity by id.
     * @return Currency The entity.
     */
    public static function getEntityById($id){
        $objDataAccess = DataAccess::getInstance();
        $sql = "SELECT * FROM `currencies` WHERE id = :id";
        $query = $objDataAccess->prepareQuery($sql);
        $query->bindParam(':id', $id);
        $query->execute();

        $entity = $query->fetchObject('Currency');
        if(is_null($entity)){
            throw new Exception("The entity doesn't exist.");
        }
        
        return $entity;
    }

    /**
     * Gets an entity by picture.
     * @param string $path The picture.
     * @return Currency The entity.
     */
    public static function getEntiyByImage($path){
        $objDataAccess = DataAccess::getInstance();
        $sql = "SELECT * FROM `currencies` WHERE image = :image";
        $query = $objDataAccess->prepareQuery($sql);
        $query->bindParam(':image', $path, PDO::PARAM_STR);
        $query->execute();

        $entity = $query->fetchObject('Currency');
        if (is_null($entity)) {
            throw new Exception("The entity doesn't exist.");
        }

        return $entity;
    }

    public static function getAllEntities(){
        $objDataAccess = DataAccess::getInstance();
        $sql = "SELECT * FROM `currencies`";
        $query = $objDataAccess->prepareQuery($sql);
        $query->execute();

        $entities = $query->fetchAll(PDO::FETCH_CLASS, 'Currency');
        return $entities;
    }

    public static function getEntitiesByCountry($country){
        $objDataAccess = DataAccess::getInstance();
        $sql = "SELECT * FROM `currencies` WHERE origin = :origin";
        $query = $objDataAccess->prepareQuery($sql);
        $query->bindParam(':origin', $country);
        $query->execute();

        $entities = $query->fetchAll(PDO::FETCH_CLASS, 'Currency');
        return $entities;
    }

    /**
     * Gets all entities by origin.
     *
     * @param string $origin The origin of the entity.
     * @return array The entities by origin.
     */
    public static function getEntitiesByOrigin($origin){
        $objDataAccess = DataAccess::getInstance();
        $sql = "SELECT * FROM `currencies` WHERE origin = :origin";
        $query = $objDataAccess->prepareQuery($sql);
        $query->bindParam(':origin', $origin);
        $query->execute();

        $entities = $query->fetchAll(PDO::FETCH_CLASS, 'Currency');
        return $entities;
    }
}