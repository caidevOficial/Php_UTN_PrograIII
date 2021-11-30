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
require_once './models/Employee.php';
require_once './models/Table.php';

class Order{

    public $id;
    public $table_id;
    public $order_status;
    public $customer_name;
    public $order_picture;
    public $order_cost;

    public function __construct(){}

    public static function createOrder($table_id, $order_status, $customer_name, $order_picture, $order_cost = 0){
        $newOrder = new Order();
        $newOrder->setTableId($table_id);
        $newOrder->setOrderStatus($order_status);
        $newOrder->setCustomerName($customer_name);
        $newOrder->setOrderPicture($order_picture);
        $newOrder->setOrderCost($order_cost);

        return $newOrder;
    }

    //--- Getters ---//

    /**
     * Gets The order ID.
     *
     * @return int The order ID.
     */
    public function getId(){
        return $this->id;
    }

    /**
     * Gets The table ID.
     *
     * @return int The table ID.
     */
    public function getTableId(){
        return $this->table_id;
    }

    /**
     * Gets The order status.
     *
     * @return string The order status.
     */
    public function getOrderStatus(){
        return $this->order_status;
    }

    /**
     * Gets The customer name.
     *
     * @return string The customer name.
     */
    public function getCustomerName(){
        return $this->customer_name;
    }

    /**
     * Gets The order picture.
     *
     * @return string The order picture.
     */
    public function getOrderPicture(){
        return $this->order_picture;
    }

    /**
     * Gets The order cost.
     *
     * @return float The order cost.
     */
    public function getOrderCost(){
        return $this->order_cost;
    }
    
    //--- Setters ---//

    /**
     * Sets The order ID.
     *
     * @param int $id The order ID.
     */
    public function setId($id){
        $this->id = $id;
    }

    /**
     * Sets The table ID.
     *
     * @param int $table_id The table ID.
     */
    public function setTableId($table_id){
        $this->table_id = $table_id;
    }

    /**
     * Sets The order status.
     *
     * @param string $order_status The order status.
     */
    public function setOrderStatus($order_status){
        $this->order_status = $order_status;
    }

    /**
     * Sets The customer name.
     *
     * @param string $customer_name The customer name.
     */
    public function setCustomerName($customer_name){
        $this->customer_name = $customer_name;
    }

    /**
     * Sets The order picture.
     *
     * @param string $order_picture The order picture.
     */
    public function setOrderPicture($order_picture){
        $this->order_picture = $order_picture;
    }

    /**
     * Sets The order cost.
     *
     * @param float $order_cost The order cost.
     */
    public function setOrderCost($order_cost){
        $this->order_cost = $order_cost;
    }

    /**
     * Prints the info of the query as a table.
     */
    public function printSingleEntityAsTable(){
        echo "<table border='2'>";
        echo '<caption>Order Data</caption>';
        echo "<th>[ORDER_ID]</th><th>[TABLE_ID]</th><th>[STATUS]</th><th>[CUSTOMER]</th><th>[PICTURE]</th><th>[COST]</th>";
        echo "<tr align='center'>";
        echo "<td>[".$this->getId()."]</td>";
        echo "<td>[".$this->getTableId()."]</td>";
        echo "<td>[".$this->getOrderStatus()."]</td>";
        echo "<td>[".$this->getCustomerName()."]</td>";
        echo "<td>[".$this->getOrderPicture()."]</td>";
        echo "<td>[$".$this->getOrderCost()."]</td>";
        echo "</tr>";
        echo "</table>" ;
    }

    /**
     * Prints the info of the query as a table.
     * @param array $entitiesList Array of the Employees objects.
     */
    public static function printEntitiesAsTable($entitiesList){
        echo "<table border='2'>";
        echo '<caption>Orders List</caption>';
        echo "<th>[ORDER_ID]</th><th>[TABLE_ID]</th><th>[STATUS]</th><th>[CUSTOMER]</th><th>[PICTURE]</th><th>[COST]</th>";
        foreach($entitiesList as $entity){
            echo "<tr align='center'>";
            echo "<td>[".$entity->getId()."]</td>";
            echo "<td>[".$entity->getTableId()."]</td>";
            echo "<td>[".$entity->getOrderStatus()."]</td>";
            echo "<td>[".$entity->getCustomerName()."]</td>";
            echo "<td>[".$entity->getOrderPicture()."]</td>";
            echo "<td>[$".$entity->getOrderCost()."]</td>";
            echo "</tr>";
        }
        echo "</table><br>" ;
    }

    /**
     * Prints the info of a standard class as a table.
     * @param array $entitiesList Array of the standard objects.
     */
    public static function printStdEntitiesAsTable($entitiesList){
        echo "<table border='2'>";
        echo '<caption>Orders List</caption>';
        echo "<th>[ORDER_ID]</th><th>[TABLE_ID]</th><th>[STATUS]</th><th>[CUSTOMER]</th><th>[PICTURE]</th><th>[COST]</th><th>[WAITING_TIME]</th>";
        foreach($entitiesList as $entity){
            echo "<tr align='center'>";
            echo "<td>[".$entity->id."]</td>";
            echo "<td>[".$entity->table_id."]</td>";
            echo "<td>[".$entity->order_status."]</td>";
            echo "<td>[".$entity->customer_name."]</td>";
            echo "<td>[".$entity->order_picture."]</td>";
            echo "<td>[$".$entity->order_cost."]</td>";
            echo "<td>[".$entity->waiting_time." Minutes]</td>";
            echo "</tr>";
        }
        echo "</table><br>" ;
    }

    //--- Create Table into DB ---//

    //--- CRUD ---//

    /**
     * Creates a new order in the database.
     *
     * @param Order $order The order to be created.
     * @return bool True if the order was created, false otherwise.
     */
    public static function insertOrder($order){
        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery('INSERT INTO orders (table_id, order_status, customer_name, order_picture, order_cost) 
        VALUES (:table_id, :order_status, :customer_name, :order_picture, :order_cost)');
        $query->bindValue(':table_id', $order->getTableId());
        $query->bindValue(':order_status', $order->getOrderStatus());
        $query->bindValue(':customer_name', $order->getCustomerName());
        $query->bindValue(':order_picture', $order->getOrderPicture());
        $query->bindValue(':order_cost', $order->getOrderCost());
        $query->execute();

        return $objDataAccess->getLastInsertedID();
    }

    /**
     * Gets all the orders from the database.
     *
     * @return array An array of all the orders.
     */
    public static function getAll(){
        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery('SELECT * FROM orders');
        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, 'Order');
    }

    /**
     * Gets the order with the given ID.
     *
     * @param int $id The ID of the order to be retrieved.
     * @return Order The order with the given ID.
     */
    public static function getOrderById($id){
        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery('SELECT * FROM orders WHERE id = :id');
        $query->bindParam(':id', $id);
        $query->execute();

        return $query->fetchObject('Order');
    }

    /**
     * Gets the order with the given table bassed on its id.
     * 
     * @param Table $table The table to get all its orders.
     * @return array An array of all the orders of the table.
     */
    public static function getOrdersByTable($table){
        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery('SELECT * FROM orders WHERE table_id = :table_id');
        $query->bindParam(':table_id', $table);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC, 'Order');
    }

    /**
     * Gets all the orders bassed on an employee id.
     * 
     * @param Employee $employee The employee to get all its orders.
     * @return array An array of all the orders of the employee.
     */
    public static function getOrdersByEmployee($employee){
        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery('SELECT o.id, o.table_id, o.order_status 
        FROM orders AS o
        LEFT JOIN tables AS t ON o.table_id = t.id
        LEFT JOIN employees AS e ON t.employee_id = :id');
        $query->bindValue(':id', $employee->getId());
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC, 'Order');
    }

    /**
     * TODO: Check if this is the better way to handle this.
     */
    public static function getOrdersByUserType($type){
        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery('SELECT o.id, o.table_id, o.order_status 
        FROM orders AS o
        LEFT JOIN tables AS t ON o.table_id = t.id
        LEFT JOIN employees AS e ON t.employee_id = e.id
        LEFT JOIN users AS u ON e.user_id = u.id
        WHERE u.user_type = :type;');
        $query->bindParam(':type', $type);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC, 'Order');
    }

    /**
     * Updates the order with the given ID.
     *
     * @param Order $order The order to be updated.
     * @return bool True if the order was updated, false otherwise.
     */
    public static function updateOrder($order){
        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery('UPDATE orders 
        SET order_status = :order_status, order_cost = :order_cost 
        WHERE id = :id');
        $query->bindValue(':id', $order->getId());
        $query->bindValue(':order_status', $order->getOrderStatus());
        $query->bindValue(':order_cost', $order->getOrderCost());
        $query->execute();

        return $query->rowCount() > 0;
    }

    /**
     * Updates the picture of the order with the given ID.
     * 
     * @param int $order_id The order to be updated.
     * @param string $picturePath The order picture to be updated.
     * @return bool True if the order picture was updated, false otherwise.
     */
    public static function updatePicture($order){
        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery('UPDATE orders SET order_picture = :order_picture WHERE id = :id');
        $query->bindValue(':id', $order->getId());
        $query->bindValue(':order_picture', $order->getOrderPicture());
        $query->execute();

        return $query->rowCount() > 0;
    }

    /**
     * Deletes the order with the given ID.
     *
     * @param int $id The ID of the order to be deleted.
     * @return bool True if the order was deleted, false otherwise.
     */
    public static function deleteOrderById($id){
        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery('DELETE FROM orders WHERE id = :id');
        $query->bindParam(':id', $id);
        $query->execute();
        
        return $objDataAccess->rowCount() > 0;
    }

    /**
     * Gets the order with the given table ID.
     *
     * @param int $table_id The ID of the table.
     * @return Order The order with the given table ID.
     */
    public static function getByTableId($table_id){
        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery('SELECT * FROM orders WHERE table_id = :table_id');
        $query->bindParam(':table_id', $table_id);
        $query->execute();

        return $query->fetchObject('Order');
    }

    /**
     * Gets the max waiting time of the order, bassed on the table code and
     * order id.
     * @param int $order_id The order id.
     * @param string $table_code The table code.
     * @return int The max waiting time of the order.
     */
    public static function getMaxTimeOrderByTableCode($order_id, $table_code){
        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery(
            'SELECT 
            MAX(d.time_to_finish) AS time_order 
            FROM dish AS d
            LEFT JOIN orders as o
            ON d.dish_order_associated = :order_id
            LEFT JOIN tables AS t
            ON o.table_id = t.id
            WHERE t.table_code = :table_code');
        $query->bindParam(':table_code', $table_code);
        $query->bindParam(':order_id', $order_id);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Gets all orders with their waiting time.
     * @return array An array of all the orders with their waiting time.
     */
    public static function getOrdersWithTime(){
        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery(
            'SELECT 
            o.id,
            o.table_id,
            o.order_status,
            o.customer_name,
            o.order_picture,
            o.order_cost,
            MAX(d.time_to_finish) AS waiting_time
            FROM dish AS d
            LEFT JOIN orders as o
            ON d.dish_order_associated = o.id
            GROUP BY o.id
            order by waiting_time DESC;');
        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, "stdClass");
    }

    /**
     * Gets the order with the given status.
     *
     * @param string $order_status The status of the order.
     * @return array An array of all the orders with the given status.
     */
    public static function getByStatus($order_status){
        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery('SELECT * FROM orders WHERE order_status = :order_status');
        $query->bindParam(':order_status', $order_status);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, 'Order');
    }

    /**
     * Gets the order with the given status and table ID.
     *
     * @param string $order_status The status of the order.
     * @param int $table_id The ID of the table.
     * @return Order The order with the given status and table ID.
     */
    public static function getByStatusAndTableId($order_status, $table_id){
        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery("SELECT * FROM orders WHERE order_status = :order_status AND table_id = :table_id");
        $query->bindParam(':order_status', $order_status);
        $query->bindParam(':table_id', $table_id);
        $query->execute();

        return $query->fetchObject('Order');
    }
}
?>