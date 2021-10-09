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
    
    public function getDate(){
        return $this->_date;
    }

    public function getUserEmail(){
        return $this->_userEmail;
    }

    public function getPizzaFlavor(){
        return $this->_pizzaFlavor;
    }

    public function getPizzaType(){
        return $this->_pizzaType;
    }

    public function getPizzaAmount(){
        return $this->_pizzaAmount;
    }

    //--- Setters ---//

    public function setDate($date){
        if (!empty($date)) {
            $this->_date = $date;
        }
    }

    public function setUserEmail($userEmail){
        if (!empty($userEmail)) {
            $this->_userEmail = $userEmail;
        }
    }

    public function setPizzaFlavor($pizzaFlavor){
        if (!empty($pizzaFlavor)) {
            $this->_pizzaFlavor = $pizzaFlavor;
        }
    }

    public function setPizzaType($pizzaType){
        if (!empty($pizzaType)) {
            $this->_pizzaType = $pizzaType;
        }
    }

    public function setPizzaAmount($pizzaAmount){
        if (!empty($pizzaAmount) && is_numeric($pizzaAmount)) {
            $this->_pizzaAmount = $pizzaAmount;
        }
    }

    public static function CreateVenta($vEmail, $pizza){
        $venta = new Venta();
        $venta->setDate(date("Y-m-d"));
        $venta->setUserEmail($vEmail);
        $venta->setPizzaFlavor($pizza->getSabor());
        $venta->setPizzaType($pizza->getTipo());
        $venta->setPizzaAmount($pizza->getCantidad());
        return $venta;
    }
    
    //--- PDO Methods ---//


    public function insertIntoDB($DAO){
        $sql = "INSERT INTO venta (fecha, correo_usuario, sabor_pizza, tipo_pizza, cantidad_pizza) VALUES (:fecha, :email, :sabor, :tipo, :cantidad);";
        $query = $DAO->getQuery($sql);
        $query->bindValue(':fecha', $this->getDate(), PDO::PARAM_STR);
        $query->bindValue(':email', $this->getUserEmail(), PDO::PARAM_STR);
        $query->bindValue(':sabor', $this->getPizzaFlavor(), PDO::PARAM_STR);
        $query->bindValue(':tipo', $this->getPizzaType(), PDO::PARAM_STR);
        $query->bindValue(':cantidad', $this->getPizzaAmount(), PDO::PARAM_INT);
        $query->execute();

        return $DAO->ReturnLastIDInserted();
    }


}

?>