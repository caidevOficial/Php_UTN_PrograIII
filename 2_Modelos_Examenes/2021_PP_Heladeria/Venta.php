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

class Venta{

    //--- ATTRIBUTES ---//
    public $_date;
    public $_userEmail;
    public $_flavor;
    public $_type;
    public $_amount;

    //--- CONSTRUCTOR ---//

    /**
     * Constructor of the class
     */
    public function __construct(){}

    //--- GETTERS ---//
    
    /**
     * Get the value of _date.
     * @return date _date
     */
    public function getDate(){
        $this->_date = str_replace(" ", "__", $this->_date);
        $this->_date = str_replace(":", "_", $this->_date);
        return $this->_date;
    }

    /**
     * Get the value of _userEmail.
     * @return string _userEmail
     */
    public function getUserEmail(){
        return $this->_userEmail;
    }

    /**
     * Get the value of _flavor.
     * @return string _flavor
     */
    public function getFlavor(){
        return $this->_flavor;
    }

    /**
     * Get the value of _type.
     * @return string _type
     */
    public function getType(){
        return $this->_type;
    }

    /**
     * Get the value of _amount.
     * @return int The amount of products ordered.
     */
    public function getAmount(){
        return $this->_amount;
    }

    //--- SETTERS ---//

    /**
     * Set the value of _date.
     * @param date $date The date of the order.
     */
    public function setDate($date){
        if (!empty($date)) {
            $this->_date = $date;
        }
    }

    /**
     * Set the value of _userEmail.
     * @param string $userEmail The email of the user who made the order.
     */
    public function setUserEmail($userEmail){
        if (!empty($userEmail)) {
            $this->_userEmail = $userEmail;
        }
    }

    /**
     * Set the value of _flavor.
     * @param string $myObjectFlavor The flavor of the pizza ordered.
     */
    public function setFlavor($myObjectFlavor){
        if (!empty($myObjectFlavor)) {
            $this->_flavor = $myObjectFlavor;
        }
    }

    /**
     * Set the value of _type.
     * @param string $myObjectType The type of the pizza ordered.
     */
    public function setType($myObjectType){
        if (!empty($myObjectType)) {
            $this->_type = $myObjectType;
        }
    }

    /**
     * Sets the amount of products ordered.
     * @param int $myObjectAmount The amount of objects ordered.
     */
    public function setAmount($myObjectAmount){
        if (!empty($myObjectAmount) && is_numeric($myObjectAmount)) {
            $this->_amount = $myObjectAmount;
        }
    }

    //--- METHODS ---//

    /**
     * Sets the values of the object Venta.
     * @param string $vEmail User email.
     * @param Helado $myObject Object instance.
     * @return Venta object with the values setted.
     */
    public static function CreateVenta($vEmail, $myObject){
        $venta = new Venta();
        $venta->setDate(date('Y-m-d H:i:s'));
        $venta->setUserEmail($vEmail);
        $venta->setFlavor($myObject->getFlavor());
        $venta->setType($myObject->getType());
        $venta->setAmount($myObject->getAmount());
        return $venta;
    }
    
    //--- PDO METHODS ---//


    /**
     * Inserts a new Sale into the database.
     * @param DataAccess $DAO  The Data Access Object.
     * @return bool  True if the insert was successful, false otherwise.
     */
    public function insertIntoDB($DAO){
        $sql = "INSERT INTO venta (fecha, usuario, sabor, tipo, cantidad) VALUES (:sdate, :email, :flavor, :stype, :amount);";
        $query = $DAO->getQuery($sql);
        $query->bindValue(':sdate', $this->_date, PDO::PARAM_STR);
        $query->bindValue(':email', $this->getUserEmail(), PDO::PARAM_STR);
        $query->bindValue(':flavor', $this->getFlavor(), PDO::PARAM_STR);
        $query->bindValue(':stype', $this->getType(), PDO::PARAM_STR);
        $query->bindValue(':amount', $this->getAmount(), PDO::PARAM_INT);
        $query->execute();

        return $DAO->ReturnLastIDInserted();
    }

    /**
     * Sum the amount of products sold. 
     * @param DataAccess $DAO The Data Access Object.
     */
    public static function getSoldAmount($DAO){
        $query = $DAO->getQuery("SELECT SUM(v.cantidad) AS Unidades_Vendidas FROM venta AS v");
		$query->execute();
        
        echo 'Unidades Vendidas: <strong>['.$query->fetch(PDO::FETCH_ASSOC)['Unidades_Vendidas'].']</strong> unidades.<br>';
    }

    /**
     * Prints the info of the query as a table.
     * @param array $arrayVentas Array of the Venta objects.
     */
    private static function printDataAsTable($arrayVentas){
        echo "<table>";
        echo "<th>[Fecha]</th><th>[Usuario]</th><th>[Sabor]</th><th>[Tipo]</th><th>[Cantidad]</th>";
        foreach($arrayVentas as $venta){
            echo "<tr align='center'>";
            echo "<td>[".$venta->_date."]</td>";
            echo "<td>[".$venta->getUserEmail()."]</td>";
            echo "<td>[".$venta->getFlavor()."]</td>";
            echo "<td>[".$venta->getType()."]</td>";
            echo "<td>[".$venta->getAmount()."]</td>";
            echo "</tr>";
        }
        echo "</table>" ;
    }

    /**
     * Prints the info of the query as a table.
     * @param Venta $sale Sale to show as a table.
     */
    public static function printSingleSaleAsTable($sale){
        echo "<table>";
        echo "<th>[Fecha]</th><th>[Usuario]</th><th>[Sabor]</th><th>[Tipo]</th><th>[Cantidad]</th>";
        echo "<tr align='center'>";
        echo "<td>[".$sale->_date."]</td>";
        echo "<td>[".$sale->getUserEmail()."]</td>";
        echo "<td>[".$sale->getFlavor()."]</td>";
        echo "<td>[".$sale->getType()."]</td>";
        echo "<td>[".$sale->getAmount()."]</td>";
        echo "</tr>";
        echo "</table>" ;
    }

    /**
     * Get the amount of products sold by a specific type.
     * @param DataAccess $DAO The Data Access Object.
     * @param string $type The type of the product.
     */
    private static function getAllSalesByType($DAO, $type){
        $query = $DAO->getQuery("SELECT 
        v.fecha AS _date,
        v.usuario AS _userEmail,
        v.sabor AS _flavor,
        v.tipo AS _type,
        v.cantidad AS _amount
        FROM venta AS v
        WHERE v.sabor = :pType
        ORDER BY _date;");
        $query->bindValue(':pType', $type, PDO::PARAM_STR);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, "Venta");
    }

    /**
     * Prints the amount of products sold by an specific type.
     * @param DataAccess $DAO The Data Access Object.
     * @param string $type The type of the product.
     */
    public static function PrintsAllSalesByType($DAO, $type){
        $arrayVentas = array();
        $arrayVentas = Venta::getAllSalesByType($DAO, $type);
        echo 'Productos vendidos sabor: <strong>['.$type.']</strong>';
        Venta::printDataAsTable($arrayVentas);
    }

    /**
     * Get the amount of products sold between two dates ordered by a specific flavor.
     * @param DataAccess $DAO The Data Access Object.
     * @param string $date1 The first date.
     * @param string $date2 The second date.
     */
    private static function getAllSalesBetweenDates($DAO, $date1, $date2){
        $query = $DAO->getQuery("SELECT 
        v.fecha AS _date,
        v.usuario AS _userEmail,
        v.sabor AS _flavor,
        v.tipo AS _type,
        v.cantidad AS _amount
        FROM venta AS v
        WHERE fecha BETWEEN :d1 AND :d2
        ORDER BY _flavor;");
        $query->bindValue(':d1', $date1, PDO::PARAM_STR);
        $query->bindValue(':d2', $date2, PDO::PARAM_STR);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, "Venta");
    }

    /**
     * Prints the info of products sold between two dates ordered by a specific flavor.
     * @param DataAccess $DAO The Data Access Object.
     * @param string $date1 The first date.
     * @param string $date2 The second date.
     */
    public static function PrintsAllSalesBetweenDates($DAO, $date1, $date2){
        $arrayVentas = array();
        $arrayVentas = Venta::getAllSalesBetweenDates($DAO, $date1, $date2);
        echo 'Unidades vendidas entre <strong>['.$date1.']</strong> y <strong>['.$date2.']</strong> <strong>[Ordenadas por Sabor ASC]</strong>:';
        Venta::printDataAsTable($arrayVentas);
    }

    /**
     * Get the products purchased by a specific user.
     * @param DataAccess $DAO The Data Access Object.
     * @param string $user The user email.
     */
    private static function getAllSalesByUser($DAO, $user){
        $query = $DAO->getQuery("SELECT 
        v.fecha AS _date,
        v.usuario AS _userEmail,
        v.sabor AS _flavor,
        v.tipo AS _type,
        v.cantidad AS _amount
        FROM venta AS v
        WHERE usuario = :email
        ORDER BY _date;");
        $query->bindValue(':email', $user, PDO::PARAM_STR);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, "Venta");
    }

    /**
     * Prints the info of the products purchased by a specific user.
     * @param DataAccess $DAO The Data Access Object.
     * @param string $user The user email.
     */
    public static function PrintsAllSalesByUser($DAO, $user){
        $arrayVentas = array();
        $arrayVentas = Venta::getAllSalesByUser($DAO, $user);
        echo 'Unidades vendidas a: <strong>['.$user.']</strong>:';
        Venta::printDataAsTable($arrayVentas);
    }

    /**
     * Updates an specific Sale, bassed on it's id.
     * @param DataAccess $DAO The Data Access Object.
     * @param int $id The id of the sale to modify.
     * @param Venta $venta The new Venta object to take it's data.
     */
    public static function updateVentaByID($DAO, $id, $venta){
        $query = $DAO->getQuery("UPDATE venta
        SET 
        usuario = :email,
        tipo = :pType,
        sabor = :pFlavor,
        cantidad = :pAmount
        WHERE id = :vID;");
        $query->bindValue(':email', $venta->getUserEmail(), PDO::PARAM_STR);
        $query->bindValue(':pType', $venta->getType(), PDO::PARAM_STR);
        $query->bindValue(':pFlavor', $venta->getFlavor(), PDO::PARAM_STR);
        $query->bindValue(':pAmount', $venta->getAmount(), PDO::PARAM_INT);
        $query->bindValue(':vID', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->rowCount();
    }

    /**
     * Gets and specific Sale bassed on it's id.
     * @param DataAccess $DAO The Data Access Object.
     * @param int $id The id of the Sale to search for.
     * @return Venta A Venta class if exist, null otherwise.
     */
    public static function getVentaByID($DAO, $id){
        $query = $DAO->getQuery("SELECT 
        fecha AS _date,
        usuario AS _userEmail,
        sabor AS _flavor,
        tipo AS _type,
        cantidad AS _amount
        FROM venta
        WHERE id = :id;");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, "Venta");
    }

    /**
     * Deletes a register of Venta bassed on it's id.
     * @param DataAcces $DAO The Data Access Object.
     * @param int $id ID of the Sale to be deleted.
     * @return 
     */
    public static function deleteVentaByID($DAO, $id){
        $query = $DAO->getQuery("DELETE FROM venta
        WHERE id = :id;");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->rowCount();
    }

    
}

?>