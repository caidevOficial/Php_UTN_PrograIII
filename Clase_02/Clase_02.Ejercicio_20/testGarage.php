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

    require 'Garage.php';
    
    $garage = new Garage("Garage Php");
    $auto1 = new Auto("Ford", "Fiesta", "Azul", "25/02/1990");
    $auto2 = new Auto("Ford", "Focus", "Rojo", "05/02/1996");
    $auto3 = new Auto("Ford", "Mustang", "Negro", "25/02/1990");

    $addFirstCar = $garage->Add($auto1);
    $addSecondCar = $garage->Add($auto2);
    $addThirdCar = $garage->Add($auto3);
    $addRepeatThirdCar = $garage->Add($auto3);

    echo "Primer auto agregado: " . $addFirstCar . "<br>";
    echo "Segundo auto agregado: " . $addSecondCar . "<br>";
    echo "Tercer auto agregado: " . $addThirdCar . "<br>";
    echo "Cuarto auto agregado: " . $addRepeatThirdCar . "<br>"; 

    echo "<br><br>Original List";
    $garage->MostrarGarage();
    $garage->Remove($auto3);
    $garage->Remove($auto3);
    echo "<br><br>List After delete";
    $garage->MostrarGarage();

    echo "<br><br>Garage Saved to CSV";
    Garage::GarageToCSV($garage);

    echo "<br><br>Garage Loaded From CSV";
    Garage::CSVToGarage()->MostrarGarage();
    
?>