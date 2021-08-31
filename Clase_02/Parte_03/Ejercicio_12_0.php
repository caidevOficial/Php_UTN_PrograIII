<?php
/**
 * Ejercicio 12.0
 * Aplicación Nº 12.0 (Saludar)
 * Realizar el desarrollo de una función que 
 * reciba un Nombre y te salude
 * Ejemplo: Se recibe la palabra "Facu" y luego queda “Hola Facu, mi rey”.
 * 
 * @author Facundo Falcone.
 */

 /**
  * Function that greets the user.
  *
  * @param string $nombre The name of the user.
  * @return void
  */
 function saludar($nombre){
    echo "Hola $nombre, mi rey";
}

echo saludar("Facu");

?>