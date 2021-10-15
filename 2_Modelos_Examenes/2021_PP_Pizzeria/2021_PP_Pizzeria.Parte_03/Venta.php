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


class Venta{
    public $_date;
    public $_userEmail;
    public $_pizzaFlavor;
    public $_pizzaType;
    public $_pizzaAmount;

    public function __construct(){
        
    }

    //--- Getters ---//
    
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
     * Get the value of _pizzaFlavor.
     * @return string _pizzaFlavor
     */
    public function getPizzaFlavor(){
        return $this->_pizzaFlavor;
    }

    /**
     * Get the value of _pizzaType.
     * @return string _pizzaType
     */
    public function getPizzaType(){
        return $this->_pizzaType;
    }

    /**
     * Get the value of _pizzaAmount.
     * @return int The amount of pizzas ordered.
     */
    public function getPizzaAmount(){
        return $this->_pizzaAmount;
    }

    //--- Setters ---//

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
     * Set the value of _pizzaFlavor.
     * @param string $pizzaFlavor The flavor of the pizza ordered.
     */
    public function setPizzaFlavor($pizzaFlavor){
        if (!empty($pizzaFlavor)) {
            $this->_pizzaFlavor = $pizzaFlavor;
        }
    }

    /**
     * Set the value of _pizzaType.
     * @param string $pizzaType The type of the pizza ordered.
     */
    public function setPizzaType($pizzaType){
        if (!empty($pizzaType)) {
            $this->_pizzaType = $pizzaType;
        }
    }

    /**
     * Sets the amount of pizzas ordered.
     * @param int $pizzaAmount The amount of pizzas ordered.
     */
    public function setPizzaAmount($pizzaAmount){
        if (!empty($pizzaAmount) && is_numeric($pizzaAmount)) {
            $this->_pizzaAmount = $pizzaAmount;
        }
    }

    //--- Methods ---//

    /**
     * Sets the values of the object Venta.
     * @param string $vEmail User email.
     * @param Pizza $pizza Pizza object.
     * @return Venta object with the values setted.
     */
    public static function CreateVenta($vEmail, $pizza){
        $venta = new Venta();
        $venta->setDate(date('Y-m-d H:i:s'));
        $venta->setUserEmail($vEmail);
        $venta->setPizzaFlavor($pizza->getSabor());
        $venta->setPizzaType($pizza->getTipo());
        $venta->setPizzaAmount($pizza->getCantidad());
        return $venta;
    }
    
    //--- PDO Methods ---//

    /**
     * Inserts a new Venta into the database.
     * @param DataAccess $DAO  The Data Access Object.
     * @return bool  True if the insert was successful, false otherwise.
     */
    public function insertIntoDB($DAO){
        $sql = "INSERT INTO venta (fecha, correo_usuario, sabor_pizza, tipo_pizza, cantidad_pizza) VALUES (:fecha, :email, :sabor, :tipo, :cantidad);";
        $query = $DAO->getQuery($sql);
        $query->bindValue(':fecha', $this->_date, PDO::PARAM_STR);
        $query->bindValue(':email', $this->getUserEmail(), PDO::PARAM_STR);
        $query->bindValue(':sabor', $this->getPizzaFlavor(), PDO::PARAM_STR);
        $query->bindValue(':tipo', $this->getPizzaType(), PDO::PARAM_STR);
        $query->bindValue(':cantidad', $this->getPizzaAmount(), PDO::PARAM_INT);
        $query->execute();

        return $DAO->ReturnLastIDInserted();
    }

    /**
     * Sum the amount of pizzas sold. 
     * @param DataAccess $DAO The Data Access Object.
     */
    public static function getPizzasSoldAmount($DAO){
        $query = $DAO->getQuery("SELECT SUM(v.cantidad_pizza) AS Pizzas_Vendidas FROM venta AS v");
		$query->execute();
        
        echo 'Pizzas Vendidas: <strong>['.$query->fetch(PDO::FETCH_ASSOC)['Pizzas_Vendidas'].']</strong> unidades.<br>';
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
            echo "<td>[".$venta->getPizzaFlavor()."]</td>";
            echo "<td>[".$venta->getPizzaType()."]</td>";
            echo "<td>[".$venta->getPizzaAmount()."]</td>";
            echo "</tr>";
        }
        echo "</table>" ;
    }

    /**
     * Get the amount of pizzas sold by a specific flavor.
     * @param DataAccess $DAO The Data Access Object.
     * @param string $flavor The flavor of the pizza.
     */
    private static function getAllVentasByFlavor($DAO, $flavor){
        $query = $DAO->getQuery("SELECT 
        fecha AS _date,
        correo_usuario AS _userEmail,
        sabor_pizza AS _pizzaFlavor,
        tipo_pizza AS _pizzaType,
        cantidad_pizza AS _pizzaAmount
        FROM venta
        WHERE sabor_pizza = :flavor
        ORDER BY _date;");
        $query->bindValue(':flavor', $flavor, PDO::PARAM_STR);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, "Venta");
    }

    /**
     * Prints the amount of pizzas sold by an specific flavor.
     * @param DataAccess $DAO The Data Access Object.
     * @param string $flavor The flavor of the pizza.
     */
    public static function PrintsAllVentasByFlavor($DAO, $flavor){
        $arrayVentas = array();
        $arrayVentas = Venta::getAllVentasByFlavor($DAO, $flavor);
        echo 'Pizzas vendidas sabor: <strong>['.$flavor.']</strong>';
        Venta::printDataAsTable($arrayVentas);
    }

    /**
     * Get the amount of pizzas sold between two dates ordered by a specific flavor.
     * @param DataAccess $DAO The Data Access Object.
     * @param string $date1 The first date.
     * @param string $date2 The second date.
     */
    private static function getAllVentasBetweenDates($DAO, $date1, $date2){
        $query = $DAO->getQuery("SELECT 
        fecha AS _date,
        correo_usuario AS _userEmail,
        sabor_pizza AS _pizzaFlavor,
        tipo_pizza AS _pizzaType,
        cantidad_pizza AS _pizzaAmount
        FROM venta
        WHERE fecha BETWEEN :d1 AND :d2
        ORDER BY _pizzaFlavor;");
        $query->bindValue(':d1', $date1, PDO::PARAM_STR);
        $query->bindValue(':d2', $date2, PDO::PARAM_STR);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, "Venta");
    }

    /**
     * Prints the info of pizzas sold between two dates ordered by a specific flavor.
     * @param DataAccess $DAO The Data Access Object.
     * @param string $date1 The first date.
     * @param string $date2 The second date.
     */
    public static function PrintsAllVentasBetweenDates($DAO, $date1, $date2){
        $arrayVentas = array();
        $arrayVentas = Venta::getAllVentasBetweenDates($DAO, $date1, $date2);
        echo 'Pizzas vendidas entre <strong>['.$date1.']</strong> y <strong>['.$date2.']</strong> <strong>[Ordenadas por Sabor ASC]</strong>:';
        Venta::printDataAsTable($arrayVentas);
    }

    /**
     * Get the pizzas purchased by a specific user.
     * @param DataAccess $DAO The Data Access Object.
     * @param string $user The user email.
     */
    private static function getAllVentasByUser($DAO, $user){
        $query = $DAO->getQuery("SELECT 
        fecha AS _date,
        correo_usuario AS _userEmail,
        sabor_pizza AS _pizzaFlavor,
        tipo_pizza AS _pizzaType,
        cantidad_pizza AS _pizzaAmount
        FROM venta
        WHERE correo_usuario = :email
        ORDER BY _date;");
        $query->bindValue(':email', $user, PDO::PARAM_STR);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, "Venta");
    }

    /**
     * Prints the info of the pizzas purchased by a specific user.
     * @param DataAccess $DAO The Data Access Object.
     * @param string $user The user email.
     */
    public static function PrintsAllVentasByUser($DAO, $user){
        $arrayVentas = array();
        $arrayVentas = Venta::getAllVentasByUser($DAO, $user);
        echo 'Pizzas vendidas a: <strong>['.$user.']</strong>:';
        Venta::printDataAsTable($arrayVentas);
    }
}

?>