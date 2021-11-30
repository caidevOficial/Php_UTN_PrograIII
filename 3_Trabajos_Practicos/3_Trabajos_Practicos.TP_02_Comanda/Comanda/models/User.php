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

class User{
    
    //--- Attributes ---//
    public $id;
    public $username;
    public $password;
    public $isAdmin;
    public $user_type;
    public $status;
    public $date_init;
    public $date_end;

    //--- Default Constructor ---//
    public function __construct(){}

    /**
     * Creates a User object.
     *
     * @param string $username The username of the user.
     * @param string $password The password of the user.
     * @param int $employeeId The id of the employee that is associated with the user.
     * @param bool $isAdmin The admin status of the user.
     * @return User The created user.
     */
    public static function createUser($username, $password, $isAdmin, $user_type, $status, $dateInit){
        $user = new User();
        $user->setUsername($username);
        $user->setPassword($password);
        $user->setIsAdmin($isAdmin);
        $user->setUserType($user_type);
        $user->setStatus($status);
        $user->setDateInit($dateInit);
        return $user;
    }

    //--- Getters ---//

    /**
     * Get the user with the given id.
     * @return int The user id.
     */
    public function getId(){
        return $this->id;
    }

    /**
     * Get the user with the given username.
     * @return string The user username.
     */
    public function getUsername(){
        return $this->username;
    }

    /**
     * Get the user with the given password.
     * @return string The user password.
     */
    public function getPassword(){
        return $this->password;
    }

    /**
     * Get the user with the given employee id.
     * @return int The user employee id.
     */
    public function getEmployeeId(){
        return $this->employee_id;
    }

    /**
     * Get the user with the given isAdmin.
     * @return bool The user isAdmin.
     */
    public function getIsAdmin(){
        return $this->isAdmin;
    }

    /**
     * Get the user with the given user_type.
     * @return string The user user_type.
     */
    public function getUserType(){
        return $this->user_type;
    }

    /**
     * Get the user with the given status.
     * @return string The user status.
     */
    public function getStatus(){
        return $this->status;
    }

    /**
     * Get the user with the given dateInit.
     * @return string The user dateInit.
     */
    public function getDateInit(){
        return $this->date_init;
    }

    /**
     * Get the user with the given dateEnd.
     * @return string The user dateEnd.
     */
    public function getDateEnd(){
        return $this->date_end;
    }

    //--- Setters ---//

    /**
     * Set the user id.
     * @param int $id The user id.
     */
    public function setId($id){
        $this->id = $id;
    }

    /**
     * Set the user's username.
     * @param string $username The new username.
     */
    public function setUsername($username){
        $this->username = $username;
    }

    /**
     * Set the user's password.
     * @param string $password The new password.
     */
    public function setPassword($password){
        $this->password = $password;
    }

    /**
     * Set the user's employee id.
     * @param int $employeeId The new employee id.
     */
    public function setEmployeeId($employeeId){
        $this->employee_id = $employeeId;
    }

    /**
     * Set the user's admin status.
     * @param bool $isAdmin The new admin status.
     */
    public function setIsAdmin($isAdmin){
        $this->isAdmin = $this->validateBool($isAdmin);
    }

    /**
     * Set the user's user_type.
     * @param string $user_type The new user_type.
     */
    public function setUserType($user_type){
        $this->user_type = $user_type;
    }

    /**
     * Set the user's status.
     * @param string $status The new status.
     */
    public function setStatus($status){
        $this->status = $status;
    }
    
    /**
     * Set the user's dateInit.
     * @param string $dateInit The new dateInit.
     */
    public function setDateInit($dateInit){
        $this->date_init = $dateInit;
    }

    /**
     * Set the user's dateEnd.
     * @param string $dateEnd The new dateEnd.
     */
    public function setDateEnd($dateEnd){
        $this->date_end = $dateEnd;
    }

    //--- Other Methods ---//

    /**
     * Check if the user is an admin.
     * @return bool True if the user is an admin, false otherwise.
     */
    public function isAdmin(){
        return $this->getIsAdmin();
    }

    /**
     * Converts the string 'True' or 'False' to a boolean like 1 for true and 0 for false.
     *
     * @param string $bool The string to be converted to a boolean value in numeric format.
     * @return int The converted boolean value in numeric format.
     */
    private function validateBool($bool){
        return strtolower($bool) == "true";
    }

    /**
     * Prints the info of the query as a table.
     */
    public function printSingleEntityAsTable(){
        echo "<table border='2'>";
        echo '<caption>Users Data</caption>';
        echo "<th>[USERNAME]</th><th>[PASSWORD]</th><th>[IS_ADMIN]</th><th>[USER_TYPE]</th><th>[STATUS]</th><th>[CREATED_AT]</th>";
        echo "<tr align='center'>";
        echo "<td>[".$this->getUsername()."]</td>";
        echo "<td>[".$this->getPassword()."]</td>";
        echo "<td>[".$this->getIsAdmin()."]</td>";
        echo "<td>[".$this->getUserType()."]</td>";
        echo "<td>[".$this->getStatus()."]</td>";
        echo "<td>[".$this->getDateInit()."]</td>";
        echo "</tr>";
        echo "</table>" ;
    }

    /**
     * Prints the info of the query as a table.
     * @param array $entitiesList Array of the Users objects.
     */
    public static function printEntitiesAsTable($entitiesList){
        echo "<table border='2'>";
        echo '<caption>Users List</caption>';
        echo "<th>[ID]</th><th>[USERNAME]</th><th>[PASSWORD]</th><th>[IS_ADMIN]</th><th>[USER_TYPE]</th><th>[STATUS]</th><th>[CREATED_AT]</th>";
        foreach($entitiesList as $entity){
            echo "<tr align='center'>";
            echo "<td>[".$entity->getId()."]</td>";
            echo "<td>[".$entity->getUsername()."]</td>";
            echo "<td>[".$entity->getPassword()."]</td>";
            echo "<td>[".$entity->getIsAdmin()."]</td>";
            echo "<td>[".$entity->getUserType()."]</td>";
            echo "<td>[".$entity->getStatus()."]</td>";
            echo "<td>[".$entity->getDateInit()."]</td>";
            echo "</tr>";
        }
        echo "</table><br>" ;
    }

    /**
     * Prints All the users in the db.
     */
    public static function PrintsAllEntitiesFromTheDB(){
        $listEntities = array();
        $listEntities = User::getAllUsers();
        User::printEntitiesAsTable($listEntities);
    }

    //--- Create User Table ---//

    //--- PDO Methods ---//
    /**
     * Insert a new row into the Usuario table.
     * @param User $user The user to retrieve its data.
     * @return int The id of the inserted row.
     */
    public static function insertUser($user){
        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery("INSERT INTO users (username, password, isAdmin, user_type, status, date_init) 
        VALUES (:username, :password, :isAdmin, :user_type, :status, :date_init)");
        $passwordHash = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        $query->bindValue(':username', $user->getUsername(), PDO::PARAM_STR);
        $query->bindValue(':password', $passwordHash);
        $query->bindValue(':isAdmin', $user->getIsAdmin(), PDO::PARAM_INT);
        $query->bindValue(':user_type', $user->getUserType(), PDO::PARAM_STR);
        $query->bindValue(':status', $user->getStatus(), PDO::PARAM_STR);
        $query->bindValue(':date_init', $user->getDateInit(), PDO::PARAM_STR);
        $query->execute();

        return $objDataAccess->getLastInsertedID();
    }

    /**
     * Inserts in the table 'historical_logins' every time that a user logs in.
     * @param User $user The user to retrieve its data.
     * @return int The id of the inserted row.
     */
    public static function insertHistoricalLogin($user){
        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery("INSERT INTO historical_logins (user_id, username, date_login) 
        VALUES (:user_id, :username, :date_login)");
        $query->bindValue(':user_id', $user->getId(), PDO::PARAM_INT);
        $query->bindValue(':username', $user->getUsername(), PDO::PARAM_STR);
        $query->bindValue(':date_login', date("Y-m-d H:i:s"), PDO::PARAM_STR);
        $query->execute();

        return $objDataAccess->getLastInsertedID();
    }

    /**
     * Gets all the rows from the Usuario table.
     * @return PDOStatement All the rows.
     */
    public static function getAllUsers(){

        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery("SELECT * FROM users");
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_CLASS, 'User');
    }

    /**
     * Gets the row from the Usuario table corresponding to the given user object.
     * @param User $user The user object.
     * @return User The user object Obtained.
     */
    public static function getUser($employee){

        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery("SELECT * FROM users AS u
        JOIN employees AS e
        ON :id = u.id");
        $query->bindValue(':id', $employee->getUserId(), PDO::PARAM_INT);
        $query->execute();

        return $query->fetchObject('User');
    }

    
    /**
     * Get the user with the given id.
     * @param int $id The id of the user to get.
     * @return User The user with the given id.
     */
    public static function getUserById($id){
        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery("SELECT * FROM users WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $user = $query->fetchObject('User');
        if(is_null($user)){
            throw new Exception("User not found");
        }
        return $user;
    }

    /**
     * Get the user with the given username.
     * @param string $username The username of the user to get.
     * @return User The user with the given username.
     */
    public static function getUserByUsername($username){
        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery("SELECT * FROM users WHERE username = :username");
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetchObject('User');
        if(is_null($user)){
            throw new Exception("User not found");
        }
        return $user;
    }

    /**
     * Modifies the row in the Usuario table corresponding to the given user object.
     * @param User $user The user object to modify.
     * @return PDOStatement The Query.
     */
    public static function modifyUser($user){

        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery("UPDATE users SET username = :username, password = :password WHERE id = :id");
        try {
            $query->bindValue(':username', $user->getUsername(), PDO::PARAM_STR);
            $query->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
            $query->bindValue(':id', $user->getId(), PDO::PARAM_INT);
            $query->execute();
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }

        return $query->getRowCount() > 0;
    }

    /**
     * Makes a logic delete in the Usuario table corresponding to the given user object.
     * @param User $user The user object to delete.
     */
    public static function deleteUser($user){

        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery("DELETE FROM users WHERE id = :id");
        $query->bindValue(':id', $user->getId(), PDO::PARAM_INT);
        $query->execute();

        return $query->getRowCount() > 0;
    }
}
?>