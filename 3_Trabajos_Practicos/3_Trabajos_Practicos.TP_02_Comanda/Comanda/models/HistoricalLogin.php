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

class HistoricalLogin{
    public $id;
    public $user_id;
    public $username;
    public $date_login;

    public function __construct() {}

    public static function createHistoricalLogin($user_id, $username, $date_login){
        $historicalLogin = new HistoricalLogin();
        $historicalLogin->setUserId($user_id);
        $historicalLogin->setUsername($username);
        $historicalLogin->setDateLogin($date_login);
        
        return $historicalLogin;
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
     * Gets the user_id of the entity.
     *
     * @return int The user_id of the entity.
     */
    public function getUserId(){
        return $this->user_id;
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
     * Gets the date_login of the entity.
     *
     * @return string The date_login of the entity.
     */
    public function getDateLogin(){
        return $this->date_login;
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
     * Sets the user_id of the entity.
     *
     * @param int $user_id The user_id of the entity.
     */
    public function setUserId($user_id){
        $this->user_id = $user_id;
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
     * Sets the date_login of the entity.
     *
     * @param string $date_login The date_login of the entity.
     */
    public function setDateLogin($date_login){
        $this->date_login = $date_login;
    }

    //--- Methods ---//

    /**
     * Prints the info of a standard class as a table.
     * @param array $entitiesList Array of the standard objects.
     */
    public static function printEntitiesAsTable($entitiesList){
        echo "<table border='2'>";
        echo '<caption>Logins List</caption>';
        echo "<th>[LOGIN_ID]</th><th>[USER_ID]</th><th>[USERNAME]</th><th>[DATE]</th>";
        foreach($entitiesList as $entity){
            echo "<tr align='center'>";
            echo "<td>[".$entity->getId()."]</td>";
            echo "<td>[".$entity->getUserId()."]</td>";
            echo "<td>[".$entity->getUsername()."]</td>";
            echo "<td>[".$entity->getDateLogin()."]</td>";
            echo "</tr>";
        }
        echo "</table><br>" ;
    }

    /**
     * Reads the file and insert the content into the db.
     *
     * @param string $filename The name of the file to read.
     * @return array The array of the historical logins. 
     */
    public static function ReadCsv($filename="./Reports_Files/historical_logins.csv"){
        $file = fopen($filename, "r");
        $array = array();
        try {
            if (!is_null($file) && self::deleteTable() > 0){
                echo "<h2>Table deleted successfully</h2><h3>Now the data of the file will be inserted.</h3>";
            }
            while (!feof($file)) {
                $line = fgets($file);
                
                if (!empty($line)) {
                    $line = str_replace(PHP_EOL, "", $line);
                    $loginsArray = explode(",", $line);
                    $hLogin = HistoricalLogin::createHistoricalLogin($loginsArray[0], $loginsArray[1], $loginsArray[2]);
                    array_push($array, $hLogin);
                    HistoricalLogin::insertHistoricalLogin($hLogin);
                }
            }
        } catch (\Throwable $th) {
            echo "Error while reading the file";
        }finally{
            fclose($file);
            return $array;
        }
    }

    /**
     * Writes the content of the db into a file.
     *
     * @param array $entitiesList The list of entities to write.
     * @param string $filename The name of the file to write.
     * @return boolean True if the file was written, false otherwise.
     */
    public static function WriteCsv($entitiesList, $filename = './Reports_Files/historical_logins.csv'):bool{
        $success = false;
        $directory = dirname($filename, 1);
        
        try {
            if(!file_exists($directory)){
                mkdir($directory, 0777, true);
            }
            $file = fopen($filename, "w");
            if ($file) {
                foreach ($entitiesList as $entity) {
                    $line = $entity->getUserId() . "," . $entity->getUserName() . "," . $entity->getDateLogin() . PHP_EOL;
                    fwrite($file, $line);
                    $success = true;
                }
            }
        } catch (\Throwable $th) {
            echo "Error saving the file<br>";
        }finally{
            fclose($file);
        }

        return $success;
    }

    //--- PDO Methods ---//

    /**
     * Insert the entity into the database.
     *
     * @param HistoricalLogin $historicalLogin The entity to insert.
     * @return int The id of the inserted entity.
     */
    public static function insertHistoricalLogin($historicalLogin){
        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery("INSERT INTO `historical_logins` (user_id, username, date_login) 
        VALUES (:user_id, :username, :date_login);");
        $query->bindValue(':user_id', $historicalLogin->getUserId(), PDO::PARAM_INT);
        $query->bindValue(':username', $historicalLogin->getUsername(), PDO::PARAM_STR);
        $query->bindValue(':date_login', $historicalLogin->getDateLogin(), PDO::PARAM_STR);
        $query->execute();

        return $objDataAccess->getLastInsertedId();
    }

    /**
     * Gets the entity with the specified id.
     *
     * @param int $id The id of the entity to get.
     * @return HistoricalLogin The entity with the specified id.
     */
    public static function getHistoricalLoginById($id){
        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery("SELECT * FROM `historical_logins` WHERE id = :id;");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, 'HistoricalLogin');
    }

    /**
     * Gets all the entities from the db.
     * 
     * @return array An array with all the entities.
     */
    public static function getAll(){
        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery("SELECT * FROM `historical_logins`;");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, 'HistoricalLogin');
    }

    /**
     * Deletes the entity with the specified id from the db.
     * 
     * @param int $id The id of the entity to delete.
     * @return bool True if the entity was deleted, false otherwise.
     */
    public static function deleteHLById($id){
        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery("DELETE FROM `historical_logins` WHERE id = :id;");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        return $query->rowCount() > 0;
    }

    /**
     * Deletes all the data from the db.
     *
     * @return int The number of rows deleted.
     */
    public static function deleteTable(){
        $objDataAccess = DataAccess::getInstance();
        $query = $objDataAccess->prepareQuery("DELETE FROM `historical_logins` WHERE 1=1;");
        $query->execute();

        return $query->rowCount() > 0;
    }
}
?>