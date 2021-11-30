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

 class Area {
        public $area_id;
        public $area_description;
        public static $AREA_JOBS = array(
            'Camarera' => 1,
            'Cocinero' => 2,
            'Barman' => 3,
            'Admin' => 4
        );

        //--- Default constructor ---//

        /**
         * Area constructor.
         */
        public function __construct(){}

        //--- Getters ---//

        /**
         * Gets the area id.
         * @return int
         */
        public function getAreaId(){
            return $this->area_id;
        }

        /**
         * Gets the area description.
         * @return string
         */
        public function getAreaDescription(){
            return $this->area_description;
        }

        /**
         * Gets the area id of the job position.
         *
         * @param string $job
         * @return int The area id of the job position.
         */
        public Static function getAreaByJobs($job){
            return intval(self::$AREA_JOBS[$job]);
        }

        //--- Setters ---//

        /**
         * Sets the area id.
         * @param int $area_id
         */
        public function setAreaId($area_id){
            $this->area_id = $area_id;
        }

        /**
         * Sets the area description.
         * @param string $area_description
         */
        public function setAreaDescription($area_description){
            $this->area_description = $area_description;
        }

        //--- Create Area Table ---//

        //--- Insert Area ---//

        /**
         * Inserts an area.
         * @return bool True if the area was inserted, false otherwise.
         */
        public function insertArea(){
            $objDataAccess = DataAccess::getInstance();
            $sql = "INSERT INTO area (area_description) VALUES (:area_description);";
            $query = $objDataAccess->prepareQuery($sql);
            $query->bindValue(':area_description', $this->getAreaDescription());
            $query->execute();

            return $objDataAccess->getLastInsertedID();
        }

        //--- Update Area ---//

        /**
         * Updates an area.
         * @param Area $area The area to update.
         * @return bool True if the area was updated, false otherwise.
         */
        public static function updateArea($area){
            $objDataAccess = DataAccess::getInstance();
            $sql = "UPDATE area SET area_description = ':area_description' WHERE area_id = :area_id;";
            $query = $objDataAccess->prepareQuery($sql);
            $query->bindValue(':area_id', $area->getAreaId());
            $query->bindValue(':area_description', $area->getAreaDescription());
            return $query->execute();
        }

        //--- Delete Area ---//

        /**
         * Deletes an area.
         * @param Area $area The area to delete.
         * @return bool True if the area was deleted, false otherwise.
         */
        public static function deleteArea($area){
            $objDataAccess = DataAccess::getInstance();
            $sql = "DELETE FROM area WHERE area_id = :area_id";
            $query = $objDataAccess->prepareQuery($sql);
            $query->bindValue(':area_id', $area->getAreaId());
            return $query->execute();
        }

        //--- Get Area ---//

        /**
         * Gets an area.
         * @param int $area_id The area id.
         * @return Area The area.
         */
        public static function getAreaById($area_id){
            $objDataAccess = DataAccess::getInstance();
            $query = $objDataAccess->prepareQuery("SELECT * FROM area WHERE area_id = :area_id;");
            $query->bindParam(':area_id', $area_id);
            $query->execute();
            $area = $query->fetchObject('Area');
            if(is_null($area)){
                throw new Exception("The area doesn't exist.");
            }
            
            return $area;
        }

        /**
         * Gets the area contained in the database bassed by its description.
         *
         * @param string $area_name The area description.
         * @return Area The area.
         */
        public static function getAreaByName($area_name){
            $objDataAccess = DataAccess::getInstance();
            $query = $objDataAccess->prepareQuery("SELECT area_id, area_description FROM area WHERE area_description = :area_description;");
            $query->bindParam(':area_description', $area_name);
            $query->execute();
            $area = $query->fetchObject('Area');
            
            return $area;
        }

        //--- Get All Areas ---//

        /**
         * Gets all areas.
         * @return array An array of areas.
         */
        public static function getAllAreas(){
            $objDataAccess = DataAccess::getInstance();
            $sql = "SELECT * FROM area;";
            $query = $objDataAccess->prepareQuery($sql);
            $query->execute();
            $areas = $query->fetchAll(PDO::FETCH_CLASS, 'Area');
            return $areas;
        }

        //--- Get Areas By Description ---//

        /**
         * Gets areas by description.
         * @param string $area_description The area description.
         * @return array An array of areas.
         */
        public static function getAreasByDescription($area_description){
            $objDataAccess = DataAccess::getInstance();
            $sql = "SELECT * FROM area WHERE area_description = ':area_description';";
            $query = $objDataAccess->prepareQuery($sql);
            $query->bindParam(':area_description', $area_description);
            $query->execute();
            $areas = $query->fetchAll(PDO::FETCH_CLASS, 'Area');
            return $areas;
        } 
 }
?>