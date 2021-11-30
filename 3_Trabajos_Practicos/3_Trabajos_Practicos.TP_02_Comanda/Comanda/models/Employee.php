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

require_once './models/Order.php';
require_once './db/DataAccess.php';

 class Employee{

    public $id;
    public $user_id;
    public $employee_area_id;
    public $name;
    public $date_init;
    public $date_end;

    public function __construct(){}

    /**
     * Creates an object of type Employee
     *
     * @param int $user_id The user id.
     * @param int $employee_area_id The employee area id.
     * @param string $name The employee name.
     * @param datetime $date_init The employee init date.
     * @return Employee The employee object.
     */
    public static function createEmployee($user_id, $employee_area_id, $name, $date_init){
        $anEmployee = new Employee();
        $anEmployee->setUserId($user_id);
        $anEmployee->setEmployeeAreaId($employee_area_id);
        $anEmployee->setName($name);
        $anEmployee->setDateInit($date_init);

        return $anEmployee;
    }

    //--- Getters ---//

    public function getId(){
        return $this->id;
    }

    public function getEmployeeAreaID(){
        return $this->employee_area_id;
    }

    public function getUserId(){
        return $this->user_id;
    }

    public function getName(){
        return $this->name;
    }

    public function getDateInit(){
        return $this->date_init;
    }

    public function getDateEnd(){
        return $this->date_end;
    }

    //--- Setters ---//

    public function setId($id){
        $this->id = $id;
    }

    public function setEmployeeAreaID($employee_area_id){
        $this->employee_area_id = $employee_area_id;
    }

    public function setUserId($user_id){
        $this->user_id = $user_id;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function setDateInit($date_init){
        $this->date_init = $date_init;
    }

    public function setDateEnd($date_end){
        $this->date_end = $date_end;
    }

    //--- Methods ---//

    /**
     * Prints the info of the query as a table.
     */
    public function printSingleEntityAsTable(){
        echo "<table border='2'>";
        echo '<caption>Employee Data</caption>';
        echo "<th>[NAME]</th><th>[USER_ID]</th><th>[AREA]</th><th>[DATE_INIT]</th>";
        echo "<tr align='center'>";
        echo "<td>[".$this->getName()."]</td>";
        echo "<td>[".$this->getUserId()."]</td>";
        echo "<td>[".$this->getEmployeeAreaID()."]</td>";
        echo "<td>[".$this->getDateInit()."]</td>";
        echo "</tr>";
        echo "</table>" ;
    }

    /**
     * Prints the info of the query as a table.
     * @param array $entitiesList Array of the Employees objects.
     */
    public static function printEntitiesAsTable($entitiesList){
        echo "<table border='2'>";
        echo '<caption>Employees List</caption>';
        echo "<th>[ID]</th><th>[NAME]</th><th>[USER_ID]</th><th>[AREA]</th><th>[DATE_INIT]</th>";
        foreach($entitiesList as $entity){
            echo "<tr align='center'>";
            echo "<td>[".$entity->getId()."]</td>";
            echo "<td>[".$entity->getName()."]</td>";
            echo "<td>[".$entity->getUserId()."]</td>";
            echo "<td>[".$entity->getEmployeeAreaID()."]</td>";
            echo "<td>[".$entity->getDateInit()."]</td>";
            echo "</tr>";
        }
        echo "</table><br>" ;
    }

    /**
     * Inserts an employee into the database.
     * @param Employee $employee The employee to be inserted.
     * @return int The id of the inserted employee.
     */
    public static function insertEmployee($employee){
        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery("INSERT INTO `employees` (`user_id`, `employee_area_id`, `name`, `date_init`)
        VALUES (:user_id, :employee_area_id, :name, :date_init);");
        $query->bindValue(':user_id', $employee->getUserId());
        $query->bindValue(':employee_area_id', $employee->getEmployeeAreaID());
        $query->bindValue(':name', $employee->getName());
        $query->bindValue(':date_init', $employee->getDateInit());
        try {
            $query->execute();
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
        
        return $objDataAccess->getLastInsertedID();
    }

    /**
     * Gets an employee by its ID.
     *
     * @param int $id The ID of the employee to get.
     * @return Employee $anEmployee The employee object.
     */
    public static function getEmployeeById($id){
        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery("SELECT * FROM `employees` WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        
        return $query->fetchObject('Employee');
    }

    /**
     * Gets all the employees from the database.
     *
     * @return array $employees The employees if there are any, null otherwise.
     */
    public static function getAllEmployees(){
        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery("SELECT * FROM `employees`");
        $query->execute();
        $employees = $query->fetchAll(PDO::FETCH_CLASS, 'Employee');

        return $employees;
    }

    public static function deleteEmployee($id){
        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery("DELETE FROM `employees` WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        return $query->rowCount();
    }

    /**
     * Updates an employee in the database.
     *
     * @param Employee $employee The employee to update.
     * @return int $affectedRows The number of affected rows.
     */
    public static function updateEmployee($employee){
        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery("UPDATE `employees` SET user_id = :user_id, employee_area_id = :employee_area_id, name = :name WHERE id = :id");
        $query->bindValue(':user_id', $employee->getUserId());
        $query->bindValue(':employee_area_id', $employee->getEmployeeAreaID());
        $query->bindValue(':name', $employee->getName());
        $query->bindValue(':id', $employee->getId());
        $query->execute();

        return $query->rowCount();
    }

 }
?>