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

class User{

    public $id;
    public $username;
    public $type;
    public $password;

    public function __construct(){}

    /**
     * Creates an instance of the entity.
     *
     * @param string $username The username of the user.
     * @param string $password The password of the user.
     * @param string $type The type of the user.
     * @return User The instance of the entity.
     */
    public static function createEntity($username, $password, $type='Customer'){
        $user = new User();
        $user->setUsername($username);
        $user->setPassword($password);
        $user->setType($type);
        
        return $user;
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
     * Gets the username of the entity.
     *
     * @return string The username of the entity.
     */
    public function getUsername(){
        return $this->username;
    }

    /**
     * Gets the type of the entity.
     *
     * @return string The type of the entity.
     */
    public function getType(){
        return $this->type;
    }

    /**
     * Gets the password of the entity.
     *
     * @return string The password of the entity.
     */
    public function getPassword(){
        return $this->password;
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
     * Sets the username of the entity.
     *
     * @param string $username The username of the entity.
     */
    public function setUsername($username){
        $this->username = $username;
    }

    /**
     * Sets the type of the entity.
     *
     * @param string $type The type of the entity.
     */
    public function setType($type){
        $this->type = $type;
    }

    /**
     * Sets the password of the entity.
     *
     * @param string $password The password of the entity.
     */
    public function setPassword($password){
        $this->password = $password;
    }

    //--- Methods ---//

    /**
     * Checks if the user is an admin.
     *
     * @return bool True if the user is an admin, false otherwise.
     */
    public function isAdmin(){
        return $this->type == "Admin";
    }

    /**
     * Checks if the user is a client.
     *
     * @return bool True if the user is a client, false otherwise.
     */
    public function isClient(){
        return $this->type == "Customer";
    }
    
    /**
     * Prints the info of the query as a table.
     * @param array $listObjects Array of the objects.
     */
    public static function printDataAsTable($listObjects){
        echo "<table border='2'>";
        echo '<caption>Users List</caption>';
        echo "<th>[ID]</th><th>[USERNAME]</th><th>[TYPE]</th><th>[PASSWORD]</th>";
        foreach($listObjects as $object){
            echo "<tr align='center'>";
            echo "<td>[".$object->getId()."]</td>";
            echo "<td>[".$object->getUsername()."]</td>";
            echo "<td>[".$object->getType()."]</td>";
            echo "<td>[".$object->getPassword()."]</td>";
            echo "</tr>";
        }
        echo "</table>" ;
    }

    /**
     * Prints the info of the query as a table.
     */
    public function printSingleEntityAsTable(){
        echo "<table border='2'>";
        echo '<caption>Users List</caption>';
        echo "<th>[ID]</th><th>[USERNAME]</th><th>[TYPE]</th><th>[PASSWORD]</th>";
        echo "<tr align='center'>";
        echo "<td>[".$this->getId()."]</td>";
        echo "<td>[".$this->getUsername()."]</td>";
        echo "<td>[".$this->getType()."]</td>";
        echo "<td>[".$this->getPassword()."]</td>";
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
        $sql = "INSERT INTO `users` (username, type, password) VALUES (:username, :type, :password);";
        $query = $objDataAccess->prepareQuery($sql);
        
        $username = $entity->getUsername();
        $type = $entity->getType();
        $password = $entity->getPassword();
        $hashPssw = password_hash($password, PASSWORD_DEFAULT);

        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':type', $type, PDO::PARAM_STR);
        $query->bindParam(':password', $hashPssw, PDO::PARAM_STR);
        $query->execute();

        return $objDataAccess->getLastInsertedId();
    }

    /**
     * Updates an entity.
     * @return int The number of rows affected.
     */
    public static function updateEntity($entity){
        $objDataAccess = DataAccess::getInstance();
        $sql = "UPDATE `users` SET username = :username, type = :type, password = :password WHERE id = :id;";
        $query = $objDataAccess->prepareQuery($sql);
        $query->bindParam(':id', $entity->getId());
        $query->bindParam(':username', $entity->getUsername());
        $query->bindParam(':type', $entity->getType());
        $query->bindParam(':password', $entity->getPassword());
        $query->execute();

        return $query->rowCount();
    }

    /**
     * Deletes an entity.
     * @return int The number of rows affected.
     */
    public static function deleteEntity($entity){
        $objDataAccess = DataAccess::getInstance();
        $sql = "DELETE FROM `users` WHERE id = :id;";
        $query = $objDataAccess->prepareQuery($sql);
        $query->bindParam(':id', $entity->getId());
        $query->execute();

        return $query->rowCount();
    }

    /**
     * Gets an entity by id.
     * @return User The entity.
     */
    public static function getEntityById($id){
        $objDataAccess = DataAccess::getInstance();
        $sql = "SELECT * FROM `users` WHERE id = :id;";
        $query = $objDataAccess->prepareQuery($sql);
        $query->bindParam(':id', $id);
        $query->execute();

        $entity = $query->fetchObject('User');
        if(is_null($entity)){
            throw new Exception("The entity doesn't exist.");
        }
        
        return $entity;
    }

    /**
     * Gets an entity by username.
     * @param string $username The username of the entity.
     * @return User The entity if exist, An exception otherwise.
     */
    public static function getEntityByUsername($username){
        $objDataAccess = DataAccess::getInstance();
        $sql = "SELECT * FROM `users` WHERE username = :username;";
        $query = $objDataAccess->prepareQuery($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->execute();

        $entity = $query->fetchObject('User');
        if (is_null($entity)) {
            throw new Exception("The entity doesn't exist.");
        }

        return $entity;
    }

    public static function getAllEntities(){
        $objDataAccess = DataAccess::getInstance();
        $sql = "SELECT * FROM `users`";
        $query = $objDataAccess->prepareQuery($sql);
        $query->execute();

        $entities = $query->fetchAll(PDO::FETCH_CLASS, 'User');
        return $entities;
    }

    public static function getEntitiesByCrypto($crypto_name){
        $objDataAccess = DataAccess::getInstance();
        $sql = "SELECT DISTINCT u.id, u.username, u.type, u.password
        FROM `users` AS u
        INNER JOIN `sales` as s ON u.username = s.user
        WHERE s.crypto_name = :crypto_name;";
        $query = $objDataAccess->prepareQuery($sql);
        $query->bindParam(':crypto_name', $crypto_name, PDO::PARAM_STR);
        $query->execute();

        $entities = $query->fetchAll(PDO::FETCH_CLASS, 'User');
        return $entities;
    }
}