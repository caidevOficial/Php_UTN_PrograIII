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

include "Auto.php";

$CarsList = array();

$auto1 = new Auto("Rojo", "Ford");
$auto2 = new Auto("Blanco", "Fiat");

$auto3 = new Auto("Blanco", "Ford", 600000);
$auto4 = new Auto("Blanco", "Ford", 500000);
$auto5 = new Auto("Blanco", "Fiat", 550000, "05/02/1996");

$auto3->AgregarImpuesto(1500);
$auto4->AgregarImpuesto(1500);
$auto5->AgregarImpuesto(1500);
array_push($CarsList, $auto1, $auto2, $auto3, $auto4, $auto5);
$sumPrices = Auto::Add($auto1, $auto2);
$same1and2 = $auto1->Equals($auto2);
$same1and5 = $auto1->Equals($auto5);

echo "El resultado de la suma de los precios de auto 1 y auto 2 es: $sumPrices <br>";
echo "El resultado de comparar auto 1 y auto 2 es: $same1and2 <br>";
echo "El resultado de comparar auto 1 y auto 5 es: $same1and5 <br>";

for ($i=0; $i < count($CarsList); $i+=2) {
    if ($i%2 == 0) {
        Auto::MostrarAuto($CarsList[$i]);
        echo "<br>";
    }
}
var_dump($CarsList);
if(Auto::PersistenceCSV($CarsList, "autos.csv")>0){
    echo "Se ha guardado el archivo correctamente";
}else{
    echo "No se ha podido guardar el archivo";
}
echo "<br>";
echo "<br>";
echo "<br>";

echo "Autos leidos del archivo: <br>";
$autosLeidos = Auto::ReadCSV();

foreach ($autosLeidos as $auto) {
    Auto::MostrarAuto($auto);
    echo "<br>";
}

?>