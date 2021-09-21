<?php

class DataAccess{
    private static $DAO;
    private $PDOObject;
 
    /**
     * Constructor of the class 'DataAccess'.
     */
    private function __construct()
    {
        try { 
                $this->PDOObject = new PDO('mysql:host=localhost;dbname=cdcol;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
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