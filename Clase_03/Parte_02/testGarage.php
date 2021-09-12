<?php

    require 'Garage.php';
    //include "Auto.php";

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