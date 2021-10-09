<?php
/* 
 * MIT License
 *
 * Copyright (C) 2021 <FacuFalcone - CaidevOficial>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Facundo Falcone <CaidevOficial> 
*/

class DataAccess{
    private static $DAO;
    private $PDOObject;
 
    /**
     * Constructor of the class 'DataAccess'.
     */
    private function __construct()
    {
        try { 
                $this->PDOObject = new PDO('mysql:host=localhost;dbname=pizzeria;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                $this->PDOObject->exec("SET CHARACTER SET utf8");
            } 
        catch (PDOException $e) { 
            print "Error!: " . $e->getMessage(); 
            die();
        }
    }
 
    /**
     * Get the query result.
     * @param string $sql The query to be executed.
     */
    public function GetQuery($sql){ 
        return $this->PDOObject->prepare($sql); 
    }

    /**
     * Get the id of the last register inserted in the db.
     * @return int id of the last register inserted in the db.
     */
     public function ReturnLastIDInserted(){ 
        return $this->PDOObject->lastInsertId(); 
    }
 
    /**
     * Get the instance of the class 'DataAccess'.
     * If the instance doesn't exist, it creates a new one using Singleton.
     * @return $DAO
     */
    public static function GetDAO(){ 
        if (!isset(self::$DAO)) {          
            self::$DAO = new DataAccess(); 
        } 
        return self::$DAO;        
    }
 
     // Evita que el objeto se pueda clonar
    public function __clone(){ 
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR); 
    }
}
?>