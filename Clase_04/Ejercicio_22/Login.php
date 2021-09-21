<?php

require_once 'usuario.php';

$option = $_GET['task'];
$name = $_POST['name'];
$password = $_POST['password'];
$email = $_POST['email'];

var_dump($option);

switch ($option) {
    case 'login':
        if(Usuario::ValidateUser($email, $password)){
            echo "Verificado";
        }else{
            echo "Error en los Datos";
        }
        break;
}
?>