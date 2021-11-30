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

 class Table {
        public $id;
        public $table_code;
        public $employee_id;
        public $state;

        public function __construct() {}

        public static function createTable($table_code, $employee_id, $state) {
            $table = new Table();
            $table->setTableCode($table_code);
            $table->setEmployeeId($employee_id);
            $table->setState($state);

            return $table;
        }

        //--- Getters ---//

        /**
        * Gets the id of the table
        *
        * @return int id of the table
        */
        public function getId(){
            return $this->id;
        }

        /**
         * Gets the code of the table
         * 
         * @return string code of the table
         */
        public function getTableCode(){
            return $this->table_code;
        }

        /**
         * Gets the id of the employee that is assigned to the table
         * @return int id of the employee
         */
        public function getEmployeeId(){
            return $this->employee_id;
        }

        /**
         * Gets the state of the table
         * @return string state of the table
         */
        public function getState(){
            return $this->state;
        }

        //--- Setters ---//
    
        /**
        * Sets the id of the table
        *
        * @param int $id id of the table
        */
        public function setId($id){
            $this->id = $id;
        }

        /**
         * Sets the code of the table
         * 
         * @param string $table_code code of the table
         */
        public function setTableCode($table_code){
            $this->table_code = $table_code;
        }
    
        /**
        * Sets the id of the employee that is assigned to the table
        *
        * @param int $employee_id id of the employee
        */
        public function setEmployeeId($employee_id){
            $this->employee_id = $employee_id;
        }

        /**
         * Sets the state of the table
         * @param string $state state of the table
         * @return void
         */
        public function setState($state){
            $this->state = $state;
        }

        //--- Methods ---//

        /**
         * Prints the info of the query as a table.
         */
        public function printSingleEntityAsTable(){
            echo "<table border='2'>";
            echo '<caption>Table Data</caption>';
            echo "<th>[TABLE_ID]</th><th>[TABLE_CODE]</th><th>[EMPLOYEE_ID]</th><th>[STATUS]</th>";
            echo "<tr align='center'>";
            echo "<td>[".$this->getId()."]</td>";
            echo "<td>[".$this->getTableCode()."]</td>";
            echo "<td>[".$this->getEmployeeId()."]</td>";
            echo "<td>[".$this->getState()."]</td>";
            echo "</tr>";
            echo "</table>" ;
        }

        /**
         * Prints the info of the query as a table.
         * @param array $entitiesList Array of the Employees objects.
         */
        public static function printEntitiesAsTable($entitiesList){
            echo "<table border='2'>";
            echo '<caption>Tables List</caption>';
            echo "<th>[TABLE_ID]</th><th>[TABLE_CODE]</th><th>[EMPLOYEE_ID]</th><th>[STATUS]</th>";
            foreach($entitiesList as $entity){
                echo "<tr align='center'>";
                echo "<td>[".$entity->getId()."]</td>";
                echo "<td>[".$entity->getTableCode()."]</td>";
                echo "<td>[".$entity->getEmployeeId()."]</td>";
                echo "<td>[".$entity->getState()."]</td>";
                echo "</tr>";
            }
            echo "</table><br>" ;
        }

        /**
         * Gets all the tables for the specified employee.
         * 
         * @param int $employee_id id of the employee
         * @return array of tables
         */
        public static function getTablesByEmployeeId($employee_id){
            $objDataAccess = DataAccess::getInstance();
            $query = $objDataAccess->prepareQuery('SELECT * FROM tables WHERE employee_id = :employee_id');
            $query->bindParam(':employee_id', $employee_id);
            $query->execute();

            return $query->fetchAll(PDO::FETCH_CLASS, 'Table');
        }

        /**
         * Gets all the tables.
         * 
         * @return array of tables
         */
        public static function getAllTables(){
            $objDataAccess = DataAccess::getInstance();
            $query = $objDataAccess->prepareQuery('SELECT * FROM tables');
            $query->execute();

            return $query->fetchAll(PDO::FETCH_CLASS, 'Table');
        }

        /**
         * Gets the table with the specified id.
         * 
         * @param int $id id of the table
         * @return Table table
         */
        public static function getTableById($id){
            $objDataAccess = DataAccess::getInstance();
            $query = $objDataAccess->prepareQuery('SELECT * FROM tables WHERE id = :id');
            $query->bindParam(':id', $id);
            $query->execute();

            return $query->fetchObject('Table');
        }

        /**
         * Inserts a Table into the db.
         * 
         * @param Table $table table to be inserted
         * @return int id of the table inserted
         */
        public static function insertTable($table){
            $objDataAccess = DataAccess::getInstance();
            $query = $objDataAccess->prepareQuery('INSERT INTO tables (table_code, employee_id, state) 
            VALUES (:table_code, :employee_id, :state)');
            $query->bindValue(':table_code', $table->getTableCode());
            $query->bindValue(':employee_id', $table->getEmployeeId());
            $query->bindValue(':state', $table->getState());
            $query->execute();

            return $objDataAccess->getLastInsertedId();
        }

        /**
         * Updates a table in the db.
         *
         * @param Table $table
         * @return bool true if the update was successful, false otherwise
         */
        public static function updateTable($table){
            $objDataAccess = DataAccess::getInstance();
            $query = $objDataAccess->prepareQuery('UPDATE tables SET employee_id = :employee_id, state = :state WHERE id = :id');
            $query->bindValue(':employee_id', $table->getEmployeeId(), PDO::PARAM_INT);
            $query->bindValue(':state', $table->getState(), PDO::PARAM_STR);
            $query->bindValue(':id', $table->getId(), PDO::PARAM_INT);
            $query->execute();

            return $query->rowCount() > 0;
        }

        /**
         * Gets the first tabble from the database that its status is 'Cerrada', false otherwise.
         * 
         * @return Table The table that have its status 'Cerrada' or false if there is no table with that status.
         */
        public static function getClosedTable(){
            $objDataAccess = DataAccess::getInstance();
            $query = $objDataAccess->prepareQuery('SELECT * FROM tables WHERE state = "Cerrada" LIMIT 1;');
            $query->execute();

            return $query->fetchObject('Table');
        }

        /**
         * Gets the table associated with the specified order id.
         * @param int $order_id id of the order
         * @return Table The table associated with the specified order id.
         */
        public static function getTableByOrderId($order_id){
            $objDataAccess = DataAccess::getInstance();
            $query = $objDataAccess->prepareQuery(
                'SELECT * FROM tables
                WHERE id = (SELECT table_id FROM orders WHERE id = :order_id)');
            $query->bindParam(':order_id', $order_id);
            $query->execute();
        
            return $query->fetchObject('Table');
        }

        /**
         * If exist a table 'Cerrada', updates its status to '$status' and 
         * returns true if the row count is greater than 0. False otherwise.
         *
         * @param string $status The status to be updated to the table.
         * @return int The id of the table updated, false otherwise.
         */
        public static function initTableStatus($status = 'Cerrada'){
            $objDataAccess = DataAccess::getInstance();
            //! Gets an empty table.
            $freeTable = self::getClosedTable();
            if($freeTable){
                $query = $objDataAccess->prepareQuery('UPDATE tables SET state = :state WHERE id = :id;');
                $query->bindParam(':state', $status, PDO::PARAM_STR);
                $query->bindValue(':id', $freeTable->getId(), PDO::PARAM_INT);
                $query->execute();
                return $freeTable->getId();
            }
            return 0;
        }

        /**
         * Updates the status of the table with the specified id to '$status'.
         *
         * @param Table $table The table to be updated.
         * @param string $status The status to be updated to the table.
         * @return bool true if the update was successful, false otherwise
         */
        public static function updateTableStatus($table, $status){
            $objDataAccess = DataAccess::getInstance();
            $query = $objDataAccess->prepareQuery('UPDATE tables SET state = :state WHERE id = :id;');
            $query->bindParam(':state', $status, PDO::PARAM_STR);
            $query->bindValue(':id', $table->getId(), PDO::PARAM_INT);
            $query->execute();
            return $query->rowCount() > 0;
        }

        /**
         * Deletes a table from the db.
         *
         * @param Table $table
         * @return bool true if the delete was successful, false otherwise
         */
        public static function deleteTable($table){
            $objDataAccess = DataAccess::getInstance();
            $query = $objDataAccess->prepareQuery('DELETE FROM tables WHERE id = :id');
            $query->bindValue(':id', $table->getId());
            $query->execute();

            return $query->rowCount() > 0;
        }
 }
?>