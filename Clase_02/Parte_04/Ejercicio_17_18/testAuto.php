<?php
/**
 * En testAuto.php:
* Crear dos objetos “Auto” de la misma marca y distinto color.
* ● Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio.
* ● Crear un objeto “Auto” utilizando la sobrecarga restante.
* ● Utilizar el método “AgregarImpuesto” en los últimos tres objetos, agregando $ 1500
* al atributo precio.
* ● Obtener el importe sumado del primer objeto “Auto” más el segundo y mostrar el
* resultado obtenido.
* ● Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o
* no.
* ● Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3, 5)
* 
* @author Facu Falcone
*/

require "Auto.php";

$auto1 = new Auto("Rojo", "","Ford","");
$auto2 = new Auto("Negro", "","Ford","");

$auto3 = new Auto("Blanco", 600000, "Ford","");
$auto4 = new Auto("Blanco", 500000, "Ford","");
$auto5 = new Auto("Blanco", 550000, "Fiat", "25/02/1990");

$auto3->AgregarImpuesto(1500);
$auto4->AgregarImpuesto(1500);
$auto5->AgregarImpuesto(1500);

$sumPrices = Auto::Add($auto1, $auto2);
$same1and2 = $auto1->Equals($auto2);
$same1and5 = $auto1->Equals($auto5);
echo "El resultado de la suma de los precios de auto 1 y auto 2 es: $sumPrices <br>";
echo "El resultado de comparar auto 1 y auto 2 es: $same1and2 <br>";
echo "El resultado de comparar auto 1 y auto 5 es: $same1and5 <br>";

?>