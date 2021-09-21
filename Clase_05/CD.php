<?php
/* MIT License
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
**/

require_once 'DataAccess.php';

/**
 * Class CD.
 * @author FacuFalcone - CaidevOficial
 */
class CD
{
    private $id;
    private $titulo;
    private $cantante;
    private $año;

    /**
     * Constructor of the class 'CD'.
     */
    public function __construct(){
        
    }

    /**
     * Gets all the cds from the database.
     * @return array An array of cds.
     */
    public static function GetAllTheCDs(){
        $DAO = DataAccess::GetDAO();
        $select = "SELECT id AS id, titel AS titulo, interpret AS cantante, jahr AS año";
        $from = " FROM cds";
        $query = $select . $from;
        $result = $DAO->GetQuery($query);
        $result->execute();
        
        return $result->fetchAll(PDO::FETCH_CLASS, 'CD');
    }
}
?>