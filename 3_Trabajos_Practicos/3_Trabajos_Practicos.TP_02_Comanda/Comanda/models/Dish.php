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
require_once './models/Area.php';

 class Dish{

        public $dish_id;
        public $dish_area;
        public $dish_order_associated;
        public $dish_status;
        public $dish_description;
        public $dish_cost;
        public $time_init;
        public $time_finish;
        public $time_to_finish;

        public function __construct(){}

        /**
         * Creates a dish.
         *
         * @param string $dish_area Area where the dish will be prepared.
         * @param string $dish_status Status of the dish.
         * @param string $dish_description Description of the dish.
         * @param date $time_init Time when the dish start preparing.
         * @return Dish $dish The created dish.
         */
        public static function createDish($dish_area, $dish_order_associated, $dish_status, $dish_description, $dish_cost, $time_init){
            $dish = new Dish();
            $dish->setDishArea($dish_area);
            $dish->setDishOrderAssociated($dish_order_associated);
            $dish->setDishStatus($dish_status);
            $dish->setDishDescription($dish_description);
            $dish->setDishCost($dish_cost);
            $dish->setTimeInit($time_init);
            $dish->setTimeFinish(null);
            $dish->setTimeToFinish(null);
            
            return $dish;
        }


     //--- Getters ---//
        /**
         * Gets the id of the dish
         *
         * @return int The id of the dish
         */
        public function getDishId(){
            return $this->dish_id;
        }

        /**
         * Gets the area of the dish
         *
         * @return string The area of the dish
         */
        public function getDishArea(){
            return $this->dish_area;
        }

        /**
         * Gets the order associated to the dish
         *
         * @return int The order associated to the dish
         */
        public function getDishOrderAssociated(){
            return $this->dish_order_associated;
        }

        /**
         * Gets the status of the dish
         *
         * @return string The status of the dish
         */
        public function getDishStatus(){
            return $this->dish_status;
        }

        /**
         * Gets the description of the dish
         *
         * @return string The description of the dish
         */
        public function getDishDescription(){
            return $this->dish_description;
        }

        /**
         * Gets the cost of the dish
         *
         * @return float The cost of the dish
         */
        public function getDishCost(){
            return $this->dish_cost;
        }

        /**
         * Gets the time of the dish
         *
         * @return string The time of the dish
         */
        public function getTimeInit(){
            return $this->time_init;
        }

        /**
         * Gets the time of the dish
         *
         * @return datetime The time of the dish
         */
        public function getTimeFinish(){
            return $this->time_finish;
        }

        /**
         * Gets the time to finish of the dish
         *
         * @return int The time to finish of the dish
         */
        public function getTimeToFinish(){
            return $this->time_to_finish;
        }

        //--- Setters ---//

        /**
         * Sets the id of the dish
         *
         * @param int $dish_id The id of the dish
         */
        public function setDishId($dish_id){
            $this->dish_id = $dish_id;
        }

        /**
         * Sets the area of the dish
         *
         * @param string $dish_area The area of the dish
         */
        public function setDishArea($dish_area){
            $this->dish_area = $dish_area;
        }

        /**
         * Sets the order associated to the dish
         *
         * @param int $dish_order_associated The order associated to the dish
         */
        public function setDishOrderAssociated($dish_order_associated){
            $this->dish_order_associated = $dish_order_associated;
        }

        /**
         * Sets the status of the dish
         *
         * @param string $dish_status The status of the dish
         */
        public function setDishStatus($dish_status){
            $this->dish_status = $dish_status;
        }

        /**
         * Sets the description of the dish
         *
         * @param string $dish_description The description of the dish
         */
        public function setDishDescription($dish_description){
            $this->dish_description = $dish_description;
        }

        /**
         * Sets the cost of the dish
         *
         * @param float $dish_cost The cost of the dish
         */
        public function setDishCost($dish_cost){
            $this->dish_cost = $dish_cost;
        }

        /**
         * Sets the time of the dish
         *
         * @param datetime $time_init The time of the dish
         */
        public function setTimeInit($time_init){
            $this->time_init = $time_init;
        }

        /**
         * Sets the time of the dish
         *
         * @param datetime $time_finish The time of the dish
         */
        public function setTimeFinish($time_finish){
            $this->time_finish = $time_finish;
        }

        /**
         * Sets the time to finish of the dish
         *
         * @param string $time_to_finish The time to finish of the dish
         */
        public function setTimeToFinish($time_to_finish){
            $this->time_to_finish = $time_to_finish;
        }

        /**
         * Calculates the estimated time to finish of the dish, bassed in the time_to_finish seted.
         */
        public function calculateTimeFinished(){
            $newDate = new DateTime($this->getTimeInit());
            $newDate = $newDate->modify('+'.$this->getTimeToFinish().' minutes');
            $this->setTimeFinish($newDate->format('Y-m-d H:i:s'));
        }

        //--- Methods ---//

    /**
     * Prints the info of the query as a table.
     */
    public function printSingleEntityAsTable(){
        echo "<table border='2'>";
        echo '<caption>Dish Data</caption>';
        echo "<th>[AREA_ID]</th><th>[ORDER_ASSOC]</th><th>[STATUS]</th>
        <th>[DESCRIPTION]</th><th>[COST]</th><th>[TIME_INIT]</th><th>[TIME_TO_FINISH]</th><th>[TIME_FINISHED]</th>";
        echo "<tr align='center'>";
        echo "<td>[".$this->getDishArea()."]</td>";
        echo "<td>[".$this->getDishOrderAssociated()."]</td>";
        echo "<td>[".$this->getDishStatus()."]</td>";
        echo "<td>[".$this->getDishDescription()."]</td>";
        echo "<td>[$".$this->getDishCost()."]</td>";
        echo "<td>[".$this->getTimeInit()."]</td>";
        echo "<td>[".$this->getTimeToFinish()."]</td>";
        echo "<td>[".$this->getTimeFinish()."]</td>";
        echo "</tr>";
        echo "</table>" ;
    }

    /**
     * Prints the info of the query as a table.
     * @param array $entitiesList Array of the Employees objects.
     */
    public static function printEntitiesAsTable($entitiesList){
        echo "<table border='2'>";
        echo '<caption>Dishes List</caption>';
        echo "<th>[DISH_ID]</th><th>[AREA_ID]</th><th>[ORDER_ASSOC]</th><th>[STATUS]</th>
        <th>[DESCRIPTION]</th><th>[COST]</th><th>[TIME_INIT]</th><th>[TIME_TO_FINISH]</th><th>[TIME_FINISHED]</th>";
        foreach($entitiesList as $entity){
            echo "<tr align='center'>";
            echo "<td>[".$entity->getDishId()."]</td>";
            echo "<td>[".$entity->getDishArea()."]</td>";
            echo "<td>[".$entity->getDishOrderAssociated()."]</td>";
            echo "<td>[".$entity->getDishStatus()."]</td>";
            echo "<td>[".$entity->getDishDescription()."]</td>";
            echo "<td>[$".$entity->getDishCost()."]</td>";
            echo "<td>[".$entity->getTimeInit()."]</td>";
            echo "<td>[".$entity->getTimeToFinish()."]</td>";
            echo "<td>[".$entity->getTimeFinish()."]</td>";
            echo "</tr>";
        }
        echo "</table><br>" ;
    }

    /**
     * Filters a list of dishes and returns a list of dishes that match the filter.
     *
     * @param array $entitiesList Array of the dishes objects to filter.
     * @param string $status The status of the dish to filter.
     * @return array Array of the dishes objects that match the filter.
     */
    public static function filterFinishedDishes($entitiesList, $status){
        $filteredList = array();
        foreach($entitiesList as $entity){
            if(strcmp($entity->getDishStatus(), $status) == 0){
                array_push($filteredList, $entity);
            }
        }
        return $filteredList;
    }

        /**
         * Inserts a new dish into the database
         *
         * @param Dish $dish The dish to insert
         */
        public static function insertDish($dish){
            $objDataAccess = DataAccess::getInstance();
            $query = $objDataAccess->prepareQuery("INSERT INTO `dish` (`dish_area`, `dish_order_associated`, `dish_status`, `dish_description`, `dish_cost`, `time_init`) 
            VALUES (:dish_area, :dish_order_associated, :dish_status, :dish_description, :dish_cost, :time_init)");
            $query->bindValue(':dish_area', $dish->getDishArea());
            $query->bindValue(':dish_order_associated', $dish->getDishOrderAssociated());
            $query->bindValue(':dish_status', $dish->getDishStatus());
            $query->bindValue(':dish_description', $dish->getDishDescription());
            $query->bindValue(':dish_cost', $dish->getDishCost());
            $query->bindValue(':time_init', $dish->getTimeInit());
            $query->execute();

            return $objDataAccess->getLastInsertedID();
        }

        /**
         * Updates a dish into the database
         *
         * @param Dish $dish The dish to update
         */
        public static function updateDish($dish){
            $objDataAccess = DataAccess::getInstance();
            $query = $objDataAccess->prepareQuery("UPDATE `dish` 
            SET `dish_status` = :status, `time_finish` = :time_finish, `time_to_finish` = :time_to_finish 
            WHERE `dish_id` = :dish_id");
            $query->bindValue(':status', $dish->getDishStatus());
            $query->bindValue(':time_finish', $dish->getTimeFinish());
            $query->bindValue(':time_to_finish', $dish->getTimeToFinish());
            $query->bindValue(':dish_id', $dish->getDishId());
            $query->execute();

            return $query->rowCount();
        }

        /**
         * Gets all the dishes from the database
         *
         * @return array An array with all the dishes
         */
        public static function getAllDishes(){
            $objDataAccess = DataAccess::getInstance();
            $query = $objDataAccess->prepareQuery("SELECT * FROM `dish`");
            $query->execute();

            return $query->fetchAll(PDO::FETCH_CLASS, "Dish");
        }

        /**
         * Get a Dish from the database
         * 
         * @param int $dish_id The id of the dish
         * @return Dish The dish
         */
        public static function getDishById($dish_id){
            $objDataAccess = DataAccess::getInstance();
            $query = $objDataAccess->prepareQuery("SELECT * FROM `dish` WHERE `dish_id` = :dish_id");
            $query->bindParam(':dish_id', $dish_id);
            $query->execute();

            return $query->fetchObject("Dish");
        }

        /**
         * Gets all the dishes from the database that are associated with an order
         * and a table, and an employee and a user that its usert type is '$usertType'.
         * @param string $usertType The type of the user that is logged in.
         * @return array An array with all the dishes that are bassically associated with the user_type.
         */
        public static function getDishesByUserType($userType){
            $objDataAccess = DataAccess::getInstance();
            $query = $objDataAccess->prepareQuery(
                "SELECT 
                d.dish_id AS dish_id,
                d.dish_area AS dish_area,
                d.dish_order_associated AS dish_order_associated,
                d.dish_status AS dish_status,
                d.dish_description AS dish_description,
                d.dish_cost AS dish_cost,
                d.time_init AS time_init,
                d.time_finish AS time_finish,
                d.time_to_finish AS time_to_finish
                FROM dish AS d
                WHERE d.dish_area = :user_type;");
            $query->bindParam(':user_type', $userType);
            $query->execute();

            return $query->fetchAll(PDO::FETCH_CLASS, "Dish");
        }

        /**
         * Get all dishes bassed on the '$orderId'.
         * @param int $orderId The id of the order.
         * @return array An array with all the dishes that are associated with the order.
         */
        public static function getDishesByOrderId($orderId){
            $objDataAccess = DataAccess::getInstance();
            $query = $objDataAccess->prepareQuery(
                "SELECT 
                d.dish_id AS dish_id,
                d.dish_area AS dish_area,
                d.dish_order_associated AS dish_order_associated,
                d.dish_status AS dish_status,
                d.dish_description AS dish_description,
                d.dish_cost AS dish_cost,
                d.time_init AS time_init,
                d.time_finish AS time_finish,
                d.time_to_finish AS time_to_finish
                FROM dish AS d
                WHERE d.dish_order_associated = :order_id;"
            );
            $query->bindParam(':order_id', $orderId);
            $query->execute();

            return $query->fetchAll(PDO::FETCH_CLASS, "Dish");
        }

        /**
         * Deletes a dish from the database
         *
         * @param Dish $dish The dish to delete
         */
        public static function deleteDish($dish){
            $objDataAccess = DataAccess::getInstance();
            $query = $objDataAccess->prepareQuery("DELETE FROM `dish` WHERE `dish_id` = :dish_id");
            $query->bindValue(':dish_id', $dish->getDishId());
            $query->execute();

            return $query->rowCount();
        }

        /**
         * Gets the total sum of prices of dishes that are associated with an order.
         * 
         * @param int $order_id The id of the order that the dishes are associated with.
         * @return int The total price of dishes of the order associated with the id.
         */
        public static function getSumOfDishesByOrder($order_id){
            $objDataAccess = DataAccess::getInstance();
            $query = $objDataAccess->prepareQuery("SELECT SUM(d.dish_cost) AS total FROM `dish` AS d WHERE `dish_order_associated` = :order_id");
            $query->bindParam(':order_id', $order_id);
            $query->execute();

            return $query->fetchObject()->total;
        }
}
?>