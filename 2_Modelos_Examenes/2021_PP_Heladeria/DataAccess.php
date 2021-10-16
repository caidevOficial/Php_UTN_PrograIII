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

class DataAccess{
    private static $DAO;
    private $PDOObject;
 
    /**
     * Constructor of the class 'DataAccess'.
     */
    private function __construct()
    {
        try { 
                $this->PDOObject = new PDO('mysql:host=localhost;dbname=heladeria;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
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